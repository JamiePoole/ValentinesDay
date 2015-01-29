<?php
class cronTasks {

	protected static $instance;

	private $config;
	private $_st;
	private $_tq;

	public function __construct(sendTweet $_st, tweetQueue $_tq){
		$this->_st = $_st;
		$this->_tq = $_tq;
		$this->setConfig();
	}

	public static function getInstance(sendTweet $_st, tweetQueue $_tq){
		if(!self::$instance)
			self::$instance = new self($_st, $_tq);
		return self::$instance;
	}

	public function run(){
		$this->sendTweets();
	}

	private function setConfig(){
		$this->config = array();
		// Twitter oAuth
		$this->config['oauth']['ckey']	= 'P0S5Ph2XqIjWX1dUdx00qIm0c';
		$this->config['oauth']['csec']	= 'TVdvcrDsr1VXInvxvb8vQo5FmjWE0U8eXp912c4IBtWd2u9tA8';
		$this->config['oauth']['atok']	= '2971187889-PsR3dgNJEVxfXLF4CRauAUUbWZJoBkAEaUJUF3X';
		$this->config['oauth']['asec']	= 'El6bNPIwSRBJibwwglmgz6oTrrpkUahKYwnjswINnpnse';
	}

	// Send Tweets in Queue
	private function sendTweets(){
		$this->_st->setOAuth($this->config['oauth']['ckey'], $this->config['oauth']['csec'], $this->config['oauth']['atok'], $this->config['oauth']['asec']);

		$next = $this->_tq->getNext(); 

		foreach($next as $tweet){
			$this->_st->postTweet($tweet['duser'], $tweet['dmessage']);
			$this->_st->getUser($tweet['duser']);
			$this->_tq->delete($tweet['tid']);
		}
	}
}