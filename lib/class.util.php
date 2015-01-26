<?php
class util {

	protected static $instance;

	private $db;

	public function getInstance(dbConnection $db){
		if(!self::$instance)
			self::$instance = new self($db);
		return self::$instance;
	}

	public function __construct(dbConnection $db){
		$this->db = $db;
	}

	public function startSession(){
		session_start();
		if(!isset($_SESSION['nonce'])){
			$token = uniqid();
			$_SESSION['nonce'] = $token;
		}
	}

	public function closeSession(){
		unset($_SESSION['nonce']);
		session_write_close();
	}

	public function getDelay($time){
		return printf("There is currently %s delay delivering messages.", sprintf(($time < 5) ? 'a %d minute' : 'no', $time));
	}

	public function log($e){
		// DEBUG ERROR MESSAGE
		// try {
		// 	$sql = "INSERT INTO `log` (`eid`, `type`, `urgency`, `code`, `message`, `trace`) VALUES (NULL, '$type', $urgency', '$code', '$message', '$trace')";
		// 	$result = $this->db->prepare($sql);
		// 	$result->execute();
		// } catch(PDOException $e){
		// 	die($e->getMessage());
		// }
	}
}