<?php
require('class.dbconnection.php');

class tweetData {

	private $db;
	private $table = 'tweet_recipients';

	public function __construct(){
		$this->db = new dbConnection();
		$this->db->connect();
	}

	public function saveUser($user){
		if(!isset($user)) die('User not specified.');
		try {
			$sql = "INSERT INTO `$this->table` (`uid`, `tobject`) VALUES (NULL, '$user')";
			$result = $this->db->prepare($sql);
			$result->execute();
		} catch(PDOException $e){
			die('SQL error: '.$e);
		}
	}

	public function getUsers(){
		try {
			$sql = "SELECT * FROM `$this->table`";
			$result = $this->db->prepare($sql);
			$return->execute();
		} catch(PDOException $e){
			die('SQL error: ' . $e);
		}

		return $result->fetchAll(PDO::FETCH_ASSOC);
	}
}