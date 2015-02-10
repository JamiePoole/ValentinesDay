<?php
require('twitteroauth/twitteroauth.php');
class sendTweet {

	protected static $instance;

	public $consumer_key;
	public $consumer_secret;
	public $access_token;
	public $access_secret;

	private $tweet_data;
	private $ut;

	public function __construct(tweetData $td){
		$this->tweet_data = $td;
	}

	public function setOAuth($ckey, $csec, $atok, $asec){
		if($ckey)
			$this->consumer_key = $ckey;
		if($csec)
			$this->consumer_secret = $csec;
		if($atok)
			$this->access_token = $atok;
		if($asec)
			$this->access_secret = $asec;
	}

	public function postTweet($recipient, $message){
		// Get values
		$recipient = filter_var($recipient, FILTER_SANITIZE_STRING);
		$message = filter_var($message, FILTER_SANITIZE_STRING);
		// $token = $_SESSION['token'];

		// Twitter Connection
		$twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_secret);
		
		// Validate values
		if(isset($recipient) && trim($recipient) != ''){
			if(isset($message) && trim($message) != ''){
				// Generate Image
				$this->gi->setDetails($recipient, $message);
				$image = $this->gi->paintImage();
				$filename = $this->gi->saveImage($image, $token);

				// Generate Tweet
				$tweet = '@'.$recipient.' '.$message;
				$twitter->post('statuses/update', array('status' => $tweet));

				// Check for Twitter Response
				if(!isset($twitter->errors)){
					// Success
					$this->ut->log((object)array(
						'code'	=> 103,
						'message' => 'Tweet "' . $message . '" sent successfully to '. $recipient
					));
				} else {
					// Fail
					foreach($twitter->errors as $error){
						$this->ut->log((object)array(
							'code'	=> $error->code,
							'message' => $error->message
						));
					}
				}
			}
		} else {
			// Validation Fail
			$this->ut->log((object)array(
				'code'	=> 3,
				'message' => 'Tweet failed. No recipient specified'
			));
			die('Tweet failed. No recipient specified');
		}
	}

	public function getUser($user){
		$user = filter_var($user, FILTER_SANITIZE_STRING);
		$twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_secret);
		if(isset($user) && trim($user) != ''){
			$user_object = $twitter->get('users/show', array('screen_name' => $user));
			if(!isset($twitter->errors)){
				$this->tweet_data->saveUser($user, $user_object);
			} else {
				foreach($twitter->errors as $error){
					$this->ut->log((object)array(
						'code'	=> $error->code,
						'message' => $error->message
					));
				}
			}
		}
	}

	public static function getInstance(tweetData $td){
		if(!self::$instance)
			self::$instance = new self($td);
		return self::$instance;
	}

}