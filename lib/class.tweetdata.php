<?php
class tweetData {
	
	protected static $instance;

	private $db;
	private $ut;
	private $table = 'tweet_recipients';

	public function __construct(dbConnection $db){
		$this->db = $db;
		$this->ut = new util($db);
	}

	public function saveUser($user, $user_object){
		try {
			$user_object = mysql_real_escape_string(serialize($user_object));
			$sql = "INSERT INTO `$this->table` (`uid`, `tdate`, `sname`, `tobject`) VALUES (NULL, CURRENT_TIMESTAMP, '$user', '$user_object')";
			$result = $this->db->prepare($sql);
			$result->execute();
		} catch(PDOException $e){
			$this->ut->log($e);
		}
	}

	public function getUsers(){
		try {
			$sql = "SELECT * FROM `$this->table`";
			$result = $this->db->prepare($sql);
			$return->execute();
		} catch(PDOException $e){
			$this->ut->log($e);
		}

		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getInstance(dbConnection $db){
		if(!self::$instance)
			self::$instance = new self($db);
		return self::$instance;
	} 
}