<?php
class util {

	protected static $instance;

	private $db;

	public static function getInstance(dbConnection $db){
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
		if($time > 0)
			return printf("There is currently a %s minute delay delivering messages.", $time);
		else
			return false;
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