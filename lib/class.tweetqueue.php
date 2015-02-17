<?php
require_once('class.censor.php');

class tweetQueue {

	protected static $instance;

	private $db;
	private $ut;
	private $db_options;
	private $queue_table = 'tweet_queue';
	private $archv_table = 'tweet_archive';
	private $sender_table = 'tweet_sender';
	private $flag_table = 'tweet_flagged';
	private $twitter_api_limit = 2400;
	private $cron_time = 5;
	private $tweet_data;

	public function __construct(dbConnection $db, tweetData $td){
		$this->db = $db;
		$this->ut = new util($db);
		$this->db_options = $this->db->get();
		$this->tweet_data = $td;
	}

	public function insert($recipient, $message, $user, $flag = false){
		$return = new stdClass();

		$user_ip = ($user['ip'])?: null;
		$user_agent = ($user['agent'])?: null;
		$user_location = ($user['location'])?: null;

		if(!isset($recipient) || !isset($message) || !isset($user)){
			$return->error['code'] = 7;
			$return->error['message'] = 'Invalid values to insert into queue';
			$return->error['file'] = $user_ip;
			$this->ut->log((object)$return->error);
			return $return;
		}

		try {
			if($flag){
				// It's been flagged
				$data = $this->db_options['data'];
				$sql = "INSERT INTO `$data`.`$this->flag_table` (`tid`, `dtime`, `duser`, `dmessage`) VALUES (NULL, CURRENT_TIMESTAMP, '$recipient', '$message')";
				$result = $this->db->prepare($sql);
				$result->execute();
				$lastid = $this->db->lastInsertId();

				$return->tweet['code'] = 101;
				$return->tweet['status'] = 'Tweet has been flagged';
				$return->tweet['tid'] = $lastid;
				$return->tweet['target'] = $recipient;
				$return->tweet['message'] = $message;
			} else {
				// Add to Queue
				$data = $this->db_options['data'];
				$sql = "INSERT INTO `$data`.`$this->queue_table` (`tid`, `dtime`, `duser`, `dmessage`) VALUES (NULL, CURRENT_TIMESTAMP, '$recipient', '$message')";
				$result = $this->db->prepare($sql);
				$result->execute();
				$lastid = $this->db->lastInsertId();

				// Add to Archive
				$sql = "INSERT INTO `$data`.`$this->archv_table` (`tid`, `dtime`, `duser`, `dmessage`) VALUES ($lastid, CURRENT_TIMESTAMP, '$recipient', '$message')";
				$result = $this->db->prepare($sql);
				$result->execute();

				// Add Sender details
				$sql = "INSERT INTO `$data`.`$this->sender_table` (`tid`, `recipient`, `ip`, `agent`, `location`) VALUES ($lastid, '$recipient', '$user_ip', '$user_agent', '$user_location')";
				$result = $this->db->prepare($sql);
				$result->execute();

				// Return Data
				$return->tweet['code'] = 102;
				$return->tweet['status'] = 'Tweet successfully added to queue';
				$return->tweet['tid'] = $lastid;
				$return->tweet['target'] = $recipient;
				$return->tweet['message'] = $message;
			}

		} catch(PDOException $e){
			$return->error['code'] = 8;
			$return->error['message'] = 'Unable to add tweet to queue' . $e->getMessage();
			$return->error['file'] = $user_ip;
			$this->ut->log((object)$return->error);
		}

		return $return;
	}

	public function delete($tid){
		if(!isset($tid)){
			$this->ut->log((object)array(
				'code' => 1,
				'message' => 'No ID specified',
				'file' => __FILE__,
				'line' => __LINE__
			));
			die('No ID specified.');
		}

		try {
			$data = $this->db_options['data'];
			$sql = "DELETE FROM `$data`.`$this->queue_table` WHERE `$this->queue_table`.`tid` = $tid";
			$result = $this->db->prepare($sql);
			$result->execute();
		} catch(PDOException $e){
			$this->ut->log($e);
		}

		return $result;
	}

	public function updateSent($tid){
		if(!isset($tid)){
			$this->ut->log((object)array(
				'code'	=> 1,
				'message'	=> 'No ID Specified',
				'file'		=> __FILE__,
				'line'		=> __LINE__
			));
			die('No ID specified.');
		}

		try {
			$data = $this->db_options['data'];
			$sql = "UPDATE `$data`.`$this->archv_table` SET `delivered` = 1 WHERE `tid` = $tid";
			$result = $this->db->prepare($sql);
			$result->execute();
		} catch(PDOException $e){
			$this->ut->log($e);
		}
	}

	public function updateFollower($fid){
		if(!isset($fid)){
			$this->ut->log((object)array(
				'code'	=> 1,
				'message'	=> 'No ID Specified',
				'file'		=> __FILE__,
				'line'		=> __LINE__
			));
			die('No ID specified.');
		}

		try {
			$sql = "UPDATE `follower_list` SET `sent` = 1 WHERE `fid` = $fid";
			$result = $this->db->prepare($sql);
			$result->execute();
		} catch(PDOException $e){
			$this->ut->log($e);
		}
	}

	public function select($tid = null){
		try {
			$data = $this->db_options['data'];
			$sql = "SELECT * FROM `$data`.`$this->queue_table`";
			if($tid != null) $sql = "SELECT * FROM `$data`.`$this->queue_table` WHERE `tid` = $tid";
			$result = $this->db->prepare($sql);
			$result->execute();
		} catch(PDOException $e){
			$this->ut->log($e);
		}

		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function time($tid = null){
		if($tid != null){
			try {
				$result = $this->select($tid);
				if(!empty($result)){
					$tweet_time = $result[0]['dtime'];
					try {
						$sql = "SELECT COUNT(*) FROM `$this->queue_table` WHERE `dtime` <= '$tweet_time' AND `tid` != '$tid'";
						$result = $this->db->prepare($sql);
						$result->execute();
						$count = $result->fetch(PDO::FETCH_NUM)[0];
					} catch(PDOException $e){
						$this->ut->log($e);
					}
				}
			} catch(PDOException $e){
				$this->ut->log($e);
			}
		} else {
			try {
				$sql = "SELECT COUNT(*) FROM `$this->queue_table`";
				$result = $this->db->prepare($sql);
				$result->execute();
				$count = $result->fetch(PDO::FETCH_NUM)[0];
			} catch (PDOException $e){
				$this->ut->log($e);
			}

		}

		$time_queue = ceil($count / floor(($this->twitter_api_limit / 24 / 60) * $this->cron_time)) * $this->cron_time;
		return $time_queue;
	}

	public function getNext(){
		$limit = floor(($this->twitter_api_limit / 24 / 60) * $this->cron_time);
		try {
			$sql = "SELECT * FROM `$this->queue_table` ORDER BY `dtime` ASC LIMIT $limit";
			$result = $this->db->prepare($sql);
			$result->execute();
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e){
			$this->ut->log($e);
		}

		return $rows;
	}

	public function nextFollowers(){
		$limit = floor(($this->twitter_api_limit / 24 / 60) * $this->cron_time);
		try {
			$sql = "SELECT * FROM `follower_list` WHERE `sent` = 0 LIMIT $limit";
			$result = $this->db->prepare($sql);
			$result->execute();
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e){
			$this->ut->log($e);
		}

		return $rows;
	}

	public static function getInstance(dbConnection $db, tweetData $td){
		if(!self::$instance)
			self::$instance = new self($db, $td);
		return self::$instance;
	}

	public function validateTweet(array $form, $user){
		// Set Return Object
		$return = new stdClass();

		// Check data
		if(isset($form['nonce_token'])
		&& isset($form['tweet_target'])
		&& isset($form['tweet_message'])){
			$target = $form['tweet_target'];
			$message = $form['tweet_message'];
		} else {
			$return->error['code'] = 4;
			$return->error['message'] = 'Incomplete form data';
			$return->error['file'] = (isset($user['ip'])) ? $user['ip'] : false;
			$this->ut->log((object)$return->error);
			return $return;
		}

		// Filter input
		$target = filter_var($target, FILTER_SANITIZE_STRING);
		$target = str_replace('@', '', $target);
		$message = filter_var($message, FILTER_SANITIZE_STRING);
		$message = preg_replace( "/\r|\n/", " ", $message);

		// Check Empty
		if(trim($target) != ''){
			 if(trim($message) != ''){
		 		// Censor
		 		$c = new CensorWords();
		 		$msg = $c->censorString($message);

		 		// Check if offensive phrase Flag
		 		if($msg['flag']):
		 			$return->tweet['code'] = 9;
		 			$return->tweet['status'] = 'Tweet flagged for moderation';
		 			$return->tweet['message'] = $msg['orig'];
		 		else:
			 		$return->tweet['code'] = 100;
			 		$return->tweet['status'] = 'Tweet validated';
			 		$return->tweet['message'] = $msg['clean'];
			 	endif;

			 	$return->tweet['target'] = $target;
			 	$return->tweet['flag'] = $msg['flag'];

			} else {
				$return->error['code'] = 5;
				$return->error['message'] = 'Please enter a tweet';
				$return->error['file'] = (isset($user['ip'])) ? $user['ip'] : false;
				$this->ut->log((object)$return->error);
				return $return;
			}
		} else {
			$return->error['code'] = 6;
			$return->error['message'] = 'Enter the username of your twitter crush';
			$return->error['file'] = (isset($user['ip'])) ? $user['ip'] : false;
			$this->ut->log((object)$return->error);
			return $return;
		}

		return $return;
	}

}