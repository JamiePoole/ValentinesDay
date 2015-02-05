<?php
class dbConnection extends PDO {

	protected static $instance;

	private $options = array();
	private $db;

	public function __construct(){
		$settings = parse_ini_file('conf/settings.ini', true);

		$this->options['host'] = $settings['database']['host'];
		$this->options['data'] = $settings['database']['data'];
		$this->options['user'] = $settings['database']['user'];
		$this->options['pass'] = $settings['database']['pass'];

		try {
			parent::__construct('mysql:host='.$this->options['host'].';dbname='.$this->options['data'], $this->options['user'], $this->options['pass']);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		} catch(PDOException $e){
			die('Database connection error.');
		}
	}

	public function set($variable = null, $value = ''){
		if($variable != null && isset($this->options[$variable]))
			$this->options[$variable] = $value;
	}
	
	public function get($variable = null){
		if($variable != null && isset($this->options[$variable]))
			return $this->options[$variable];
		else
			return $this->options;
	}

	public static function getInstance(){
		if(!self::$instance)
			self::$instance = new self();
		return self::$instance;
	}

}