<?php
require('twitteroauth/autoloader.php');
use Abraham\TwitterOAuth\TwitterOAuth;

class statistics {

	protected static $instance;

	private $ckey, $csec, $atok, $asec;

	public static function getInstance(dbConnection $db, util $ut){
		if(!self::$instance)
			self::$instance = new self($db, $ut);
		return self::$instance;
	}

	public function __construct($db, $ut){
		$this->db = $db;
		$this->ut = $ut;

		$settings = parse_ini_file('../../lib/conf/settings.ini', true);
		$this->ckey = $settings['twitter']['ckey'];
		$this->csec = $settings['twitter']['csec'];
		$this->atok = $settings['twitter']['atok'];
		$this->asec = $settings['twitter']['asec'];
	}

	// Count Tweets
	private function countTweets($table, $col = null, $mod = null, $search = null){
		try {
			$sql = "SELECT COUNT(*) FROM `$table`";
			if($col && $mod && $search) $sql .= "WHERE `$col` $mod `$search`";
			$result = $this->db->prepare($sql);
			$result->execute();
			return $result->fetchColumn();
		} catch(PDOException $e){
			$this->ut->log($e);
		}
	}

	// Location
	private function setRomanticLocation(){

	}

	// Time
	private function setRomanticTime(){

	}

	// Number of Followers
	private function setNumberFollowers(){

	}

	// Kitten Count
	private function setKittenCounter(){

	}


}