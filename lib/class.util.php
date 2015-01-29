<?php
class util {

	protected static $instance;

	private $db;
	private $token;

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
		if(!isset($this->token))
			$_SESSION['token'] = uniqid();
		else
			$_SESSION['token'] = $this->token;
	}

	public function closeSession(){
		unset($_SESSION['token']);
		session_write_close();
	}

	public function checkSession($token){
		if((isset($token) && isset($_SESSION['token']))
		 && ($token == $_SESSION['token'])):
			return true;
		else:
			return false;
		endif;
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