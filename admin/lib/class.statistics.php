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

		$this->ckey = 'mrNaw6XVZ1x1yKporCSiPbthu';
		$this->csec = 'rP3fdm42M0Y8VmVV0NKWXXeQlPDmJcaM0sC1TIrq387TFVRexg';
		$this->atok = '3026657621-u2nKCbxOZ5r1G1hcstOQJJyMSfU9GjkhLiC4cFl';
		$this->asec = 'lamsmGC8hJSZOXu7Tzc9aKah4ggNIziMvGWBD57WaV4Zb';
	}

	// Count Tweets
	private function countTweets($table, $col = null, $mod = null, $search = null){
		try {
			$sql = "SELECT COUNT(*) FROM `$table`";
			if($col && $mod && $search) $sql .= "WHERE `$col` $mod $search";
			$result = $this->db->prepare($sql);
			$result->execute();
			return $result->fetchColumn();
		} catch(PDOException $e){
			$this->ut->log($e);
		}
	}

	public function getStatistics(){
		return array(
			'total_count'		=> $this->countTweets('tweet_archive')
			'total_delivered'	=> $this->countTweets('tweet_archive', 'delivered', 'IS', 1)
		);
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