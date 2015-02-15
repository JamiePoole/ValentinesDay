<?php
require('twitteroauth/autoloader.php');
use Abraham\TwitterOAuth\TwitterOAuth;

class adminTasks {

	protected static $instance;

	private $db;
	private $ut;
	private $messages;

	private $ckey, $csec, $atok, $asec;

	public function __construct($db, $ut){
		$this->db = $db;
		$this->ut = $ut;
		$this->messages = array();

		$this->ckey = 'mrNaw6XVZ1x1yKporCSiPbthu';
		$this->csec = 'rP3fdm42M0Y8VmVV0NKWXXeQlPDmJcaM0sC1TIrq387TFVRexg';
		$this->atok = '3026657621-u2nKCbxOZ5r1G1hcstOQJJyMSfU9GjkhLiC4cFl';
		$this->asec = 'lamsmGC8hJSZOXu7Tzc9aKah4ggNIziMvGWBD57WaV4Zb';
	}

	public static function getInstance(dbConnection $db, util $ut){
		if(!self::$instance)
			self::$instance = new self($db, $ut);
		return self::$instance;
	}

	/* Return an array of Database entries.
	 * @param	$count		boolean		Return only count value
	 *			$table		string		`table_name`
	 *			$order		string		`column`
	 *			$sort		string		`ASC` or `DESC`
	 *			$limit		int			`limit amount`
	 * 
	 * @return 	$rows		array
	 *			On error returns false
	 */
	public function getEntries($count = false, $table = null, $order = null, $sort = 'DESC', $limit = null){
		try {
			if($count){
				$sql = "SELECT COUNT(*) FROM `$table`";
			} else {
				if($table != null){
					$sql = "SELECT * FROM `$table`";
					if($order) $sql .= " ORDER BY `$order` $sort";
					if($limit) $sql .= " LIMIT $limit";
				}
			}
			$result = $this->db->prepare($sql);
			$result->execute();
			if($count) $rows = $result->fetchColumn();
			else $rows = $result->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e){
			$this->ut->log($e);
		}

		return (isset($rows)) ? $rows : false;
	}

	/* Delete an entry from the database
	 * @param 	$table 		string
	 *			$column 	string 		WHERE
	 *			$id 		int 		Identifier
	 *
	 * @return  $success 	boolean
	 */
	public function deleteEntry($table, $column, $id){
		try {
			$sql = "DELETE FROM `$table` WHERE `$column` = $id";
			$result = $this->db->prepare($sql);
			$result->execute();
			return true;
		} catch(PDOException $e){
			$this->ut->log($e);
			return false;
		}
	}

	/* Add a flagged entry back to the queue
	 * @param 	$tid 		int
	 *
	 * @return  $return 	object
	 */
	public function reQueue($tid){
		$return = new stdClass();

		try {
			// Add to Queue
			$sql = "INSERT INTO `tweet_queue` (`dtime`, `duser`, `dmessage`) SELECT `dtime`, `duser`, `dmessage` FROM `tweet_flagged` WHERE `tid` = $tid";
			$result = $this->db->prepare($sql);
			$result->execute();
			$lastid = $this->db->lastInsertId();

			// Delete from Flagged
			$sql = "DELETE FROM `tweet_flagged` WHERE `tid` = $tid";
			$result = $this->db->prepare($sql);
			$result->execute();

			// Return Data
			$return->tweet['code'] = 102;
			$return->tweet['status'] = 'Tweet successfully added to queue';
			$return->tweet['tid'] = $lastid;
			$return->tweet['target'] = $recipient;
			$return->tweet['message'] = $message;

		} catch(PDOException $e){
			$return->error['code'] = 8;
			$return->error['message'] = 'Unable to add tweet to queue: ' . $e->getMessage();
			$this->ut->log((object)$return->error);
		}

		return $return;
	}

	/* Add a flagged entry back to the queue
	 * @param 	$tid 		int
	 *
	 * @return  $return 	object
	 */
	public function flagTweet($tid){
		$return = new stdClass();

		try {
			// Add to Flagged
			$sql = "INSERT INTO `tweet_flagged` (`dtime`, `duser`, `dmessage`) SELECT `dtime`, `duser`, `dmessage` FROM `tweet_queue` WHERE `tid` = $tid";
			$result = $this->db->prepare($sql);
			$result->execute();
			$lastid = $this->db->lastInsertId();

			// Delete from Queue
			$sql = "DELETE FROM `tweet_queue` WHERE `tid` = $tid";
			$result = $this->db->prepare($sql);
			$result->execute();

			// Return Data
			$return->tweet['code'] = 102;
			$return->tweet['status'] = 'Tweet successfully flagged.';
			$return->tweet['tid'] = $lastid;
			$return->tweet['target'] = $recipient;
			$return->tweet['message'] = $message;

		} catch(PDOException $e){
			$return->error['code'] = 8;
			$return->error['message'] = 'Unable to flag the tweet: ' . $e->getMessage();
			$this->ut->log((object)$return->error);
		}

		return $return;
	}

	public function getTwitterLimit(){
		$twitter = new TwitterOAuth($this->ckey, $this->csec, $this->atok, $this->asec);

		$limits = $twitter->get('application/rate_limit_status');
		return $limits;
	}

	public function getTime($date, $granularity = 2){
		date_default_timezone_set('Europe/London');

		$date = strtotime($date);
		$diff = time() - $date;
		$return = '';
		$periods = array(
			//'decade'	=> 315360000,
			'y'		=> 31536000,
			'mo'	=> 2628000,
			'w'		=> 604800,
			'd'		=> 86400,
			'h'		=> 3600,
			'm'		=> 60,
			's'		=> 1);

		foreach($periods as $abbr => $seconds){
			if($diff >= $seconds){
				$time = floor($diff/$seconds);
				$diff %= $seconds;
				$return = $time . $abbr . ' ago';
				$granularity--;
			}
			if($granularity == '0'){ break; }
		}
		return $return;
	}

	public function setMessages($messages){
		$old = $this->messages;
		$old['title'] = $messages['title'];
		$old['message'] = $messages['message'];
		$this->messages = $old;
	}

	public function hasMessages(){
		if(!empty($this->messages))
			return true;
		return false;
	}

	public function getMessages(){
		return $this->messages;
	}


}