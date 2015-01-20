<?php

class dbConnection extends PDO {

	private $options = array();

	public function __construct(){
		$this->options['host'] = 'localhost';
		$this->options['data'] = 'twitter_romance';
		$this->options['user'] = 'root';
		$this->options['pass'] = '';
	}

	public function connect(){
		try {
			parent::__construct('mysql:host='.$this->options['host'].';dbname='.$this->options['data'], $this->options['user'], $this->options['pass']);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		} catch(PDOException $e){
			die('Connection error: ' . $e->getMessage());
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

}