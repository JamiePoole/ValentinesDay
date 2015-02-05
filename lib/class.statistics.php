<?php
class statistics {

	protected static $instance;

	public static function getInstance(dbConnection $db, util $ut){
		if(!self::$instance)
			self::$instance = new self($db, $ut);
		return self::$instance;
	}

	public function __construct($db, $ut){
		$this->db = $db;
		$this->ut = $ut;
	}

	// Donation Counter
	private function setDonationCounter(){
		
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