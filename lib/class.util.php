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

	public function getSession(){
		if(isset($this->token))
			return $this->token;
		elseif(isset($_SESSION['token']))
			return $_SESSION['token'];
		else
			return false;
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
		/* int $code;
		 * string $message;
		 * string $file;
		 * int $line;
		 */
		$code = (isset($e->code)) ? $e->code : null;
		$message = (isset($e->message)) ? $e->message : null;
		$file = (isset($e->file)) ? $e->file : null;
		$line = (isset($e->line)) ? $e->line : null;

		try {
			$sql = "INSERT INTO `log` (`eid`, `code`, `message`, `file`, `line`) VALUES (NULL, '$code', '$message', '$file', '$line')";
			$result = $this->db->prepare($sql);
			$result->execute();
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
}