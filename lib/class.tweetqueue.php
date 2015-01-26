<?php
class tweetQueue {

	protected static $instance;

	private $db;
	private $ut;
	private $db_options;
	private $queue_table = 'tweet_queue';
	private $archv_table = 'tweet_archive';
	private $twitter_api_limit = 2400;
	private $cron_time = 5;
	private $tweet_data;

	public function __construct(dbConnection $db, tweetData $td){
		$this->db = $db;
		$this->ut = new util($db);
		$this->db_options = $this->db->get();
		$this->tweet_data = $td;
	}

	public function insert($recipient, $message){
		if(!isset($recipient) || !isset($message)) die('No values.');

		try {
			$data = $this->db_options['data'];
			$sql = "INSERT INTO `$data`.`$this->queue_table` (`tid`, `dtime`, `duser`, `dmessage`) VALUES (NULL, CURRENT_TIMESTAMP, '$recipient', '$message')";
			$result = $this->db->prepare($sql);
			$result->execute();
			$lastid = $this->db->lastInsertId();

			$sql = "INSERT INTO `$data`.`$this->archv_table` (`tid`, `dtime`, `duser`, `dmessage`) VALUES (NULL, CURRENT_TIMESTAMP, '$recipient', '$message')";
			$result = $this->db->prepare($sql);
			$result->execute();
		} catch(PDOException $e){
			$this->ut->log($e);
		}

		return $lastid;
	}

	public function delete($tid){
		if(!isset($tid)) die('No ID specified.');

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

	public static function getInstance(dbConnection $db, tweetData $td){
		if(!self::$instance)
			self::$instance = new self($db, $td);
		return self::$instance;
	}

}