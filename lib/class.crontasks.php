<?php
class cronTasks {

	protected static $instance;

	private $config;
	private $_st;
	private $_tq;
	private $_tf;

	public function __construct(sendTweet $_st, tweetQueue $_tq, thankFollowers $_tf){
		$this->_st = $_st;
		$this->_tq = $_tq;
		$this->_tf = $_tf;
		$this->setConfig();
	}

	public static function getInstance(sendTweet $_st, tweetQueue $_tq, thankFollowers $_tf){
		if(!self::$instance)
			self::$instance = new self($_st, $_tq, $_tf);
		return self::$instance;
	}

	/* This is the main run function
	 * All calls in here are defined in this class
	 */
	public function run(){
		//$this->sendTweets();
		$this->sendFarewell();
	}

	private function setConfig(){
		$this->config = array();
		$settings = parse_ini_file('conf/settings.ini', true);
		
		// Twitter oAuth
		$this->config['oauth']['ckey'] = $settings['twitter']['ckey'];
		$this->config['oauth']['csec'] = $settings['twitter']['csec'];
		$this->config['oauth']['atok'] = $settings['twitter']['atok'];
		$this->config['oauth']['asec'] = $settings['twitter']['asec'];
	}

	// Send Tweets in Queue
	private function sendTweets(){
		$this->_st->setOAuth($this->config['oauth']['ckey'], $this->config['oauth']['csec'], $this->config['oauth']['atok'], $this->config['oauth']['asec']);

		$next = $this->_tq->getNext(); 

		foreach($next as $tweet){
			$this->_st->postTweet($tweet['duser'], $tweet['dmessage']);
			$this->_st->getUser($tweet['duser']);
			$this->_tq->updateSent($tweet['tid']);
			$this->_tq->delete($tweet['tid']);
		}
	}

	// Send to Followers
	private function sendFarewell(){
		$next = $this->_tf->nextFollowers(); 

		foreach($next as $follower){
			$this->_tf->postFarewell($follower['name'], $follower['user'], $follower['fid']);
		}
	}
}