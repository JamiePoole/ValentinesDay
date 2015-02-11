<?php
require('twitteroauth/autoloader.php');
use Abraham\TwitterOAuth\TwitterOAuth;

class sendTweet {

	protected static $instance;

	public $consumer_key;
	public $consumer_secret;
	public $access_token;
	public $access_secret;

	private $tweet_data;
	private $ut;
	private $gi;

	public function __construct(tweetData $td, util $ut, generateImage $gi){
		$this->tweet_data = $td;
		$this->ut = $ut;
		$this->gi = $gi;
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

	private function parseName($name, $handle){
		$name = explode(' ', $name);
		$fname = $name[0];
		if(preg_match("/^[A-Za-z0-9\-]+$/", $fname) === 1)
			return $fname;
		return $handle;
	}

	public function postTweet($recipient, $message){
		// Get values
		$recipient = filter_var($recipient, FILTER_SANITIZE_STRING);
		$message = filter_var($message, FILTER_SANITIZE_STRING);
		$token = $this->ut->getSession();

		// Twitter Connection
		$twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_secret);
		
		// Validate values
		if(isset($recipient) && trim($recipient) != ''){
			if(isset($message) && trim($message) != ''){
				// Get User
				$user = $this->getUser($recipient);
				// Parse first name - if fail, use @handle
				$name = (($user !== false) ? $this->parseName($user->name, $recipient) : $recipient);

				// Generate Image
				$dir = dirname(dirname(__FILE__)) . '/images/';
				$this->gi->setDetails($name, $message);
				$image = $this->gi->paintImage();
				$file = $this->gi->saveImage($image, $dir, $token);

				// Generate Tweet
				$message = htmlspecialchars_decode($message);
				$tweet = '@'.$recipient.' '.$message;
				$param = array('status'	=> $tweet);

				// If Image Generated Upload and add to Parameters
				if(isset($file['filename']) && isset($file['filetype'])){
					$media = $twitter->upload('media/upload', array('media' => $dir.$file['filename'].'.'.$file['filetype']));
					if(isset($media->media_id_string)){
						$mediaID = $media->media_id_string;
						$param['media_ids'] = $mediaID;
					}
				}

				// Send Tweet
				$twitter->post('statuses/update', $param);

				// Check for Twitter Response
				if(!isset($twitter->errors)){
					if(isset($media->media_id_string))
						$fileDesc = ' with file ' . $file['filename'] . '.' . $file['filetype'] . ' attached';
					else
						$fileDesc = null;
					// Success
					$this->ut->log((object)array(
						'code'	=> 103,
						'message' => 'Tweet "' . $message . '" sent successfully to '. $recipient . $fileDesc,
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
				return $user_object;
			} else {
				foreach($twitter->errors as $error){
					$this->ut->log((object)array(
						'code'	=> $error->code,
						'message' => $error->message
					));
				}
			}
		}

		return false;
	}

	public static function getInstance(tweetData $td, util $ut, generateImage $gi){
		if(!self::$instance)
			self::$instance = new self($td, $ut, $gi);
		return self::$instance;
	}

}