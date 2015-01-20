<?php
require('class.dbconnection.php');

class tweetQueue {

	private $db;
	private $db_options;
	private $table = 'tweet_queue';
	private $twitter_api_limit = 2400;

	public function __construct(){
		$this->db = new dbConnection();
		$this->db_options = $this->db->get();
		$this->db->connect();
	}

	public function insert($recipient, $message){
		if(!isset($recipient) || !isset($message)) die('No values.');

		try {
			$data = $this->db_options['data'];
			$sql = "INSERT INTO `$data`.`$this->table` (`tid`, `dtime`, `duser`, `dmessage`) VALUES (NULL, CURRENT_TIMESTAMP, '$recipient', '$message')";
			$result = $this->db->prepare($sql);
			$result->execute();
		} catch(PDOException $e){
			die('SQL error: '.$e);
		}

		return $result;
	}

	public function delete($tid){
		if(!isset($tid)) die('No ID specified.');

		try {
			$data = $this->db_options['data'];
			$sql = "DELETE FROM `$data`.`$this->table` WHERE `$this->table`.`tid` = $tid";
			$result = $this->db->prepare($sql);
			$result->execute();
		} catch(PDOException $e){
			die('SQL error: '.$e);
		}

		return $result;
	}

	public function select($tid = null){
		try {
			$data = $this->db_options['data'];
			$sql = "SELECT * FROM `$data`.`$this->table`";
			if($tid != null) $sql = "SELECT * FROM `$data`.`$this->table` WHERE `tid` = $tid";
			$result = $this->db->prepare($sql);
			$result->execute();
		} catch(PDOException $e){
			die('SQL error: '.$e);
		}

		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function queueTime($tid){
		try {
			$result = $this->select($tid);
			if(!empty($result)){
				$tweet_time = $result[0]['dtime'];
				try {
					$sql = "SELECT COUNT(*) FROM `$this->table` WHERE `dtime` <= '$tweet_time' AND `tid` != '$tid'";
					$result = $this->db->prepare($sql);
					$result->execute();
					$count = $result->fetch(PDO::FETCH_NUM)[0];
				} catch(PDOException $e){
					die('SQL error: ' . $e);
				}

				$time_queue = floor(($count / ($this->twitter_api_limit / 24 / 60)) + ($this->twitter_api_limit / 24 / 60));
			}
		} catch(PDOException $e){
			die('SQL error: ' . $e);
		}
	}

	public function getNext(){
		try {
			$sql = "SELECT * FROM `$this->table` ORDER BY `dtime` ASC LIMIT 3";
			$result = $this->db->prepare($sql);
			$result->execute();
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e){
			die('SQL error: ' . $e);
		}

		return $rows;
	}

}