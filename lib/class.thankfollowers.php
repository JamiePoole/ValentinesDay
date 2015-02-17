<?php
require('twitteroauth/autoloader.php');
use Abraham\TwitterOAuth\TwitterOAuth;

class thankFollowers {

	protected static $instance;

	public $ckey, $csec, $atok, $asec;

	private $db;
	private $ut;
	private $gi;

	public function __construct(dbConnection $db, util $ut, generateImage $gi){
		$this->db = $db;
		$this->ut = $ut;
		$this->gi = $gi;

		$this->setOAuth();
	}

	public function setOAuth(){
		$settings = parse_ini_file('conf/settings.ini', true);
		$this->ckey = $settings['twitter']['ckey'];
		$this->csec = $settings['twitter']['csec'];
		$this->atok = $settings['twitter']['atok'];
		$this->asec = $settings['twitter']['asec'];
	}

	private function parseName($name, $handle){
		$name = explode(' ', $name);
		$fname = $name[0];
		if(ctype_alpha($fname))
			return $fname;
		return $handle;
	}

	public function postFarewell($screen_name, $full_name = false){
		$full_name = filter_var($full_name, FILTER_SANITIZE_STRING);
		$screen_name = filter_var($screen_name, FILTER_SANITIZE_STRING);

		$twitter = new TwitterOAuth($this->ckey, $this->csec, $this->atok, $this->asec);

		// Validate
		if(isset($screen_name) && trim($screen_name) != ''){
			// Parse first name - if fail, use @handle
			$name = (($full_name !== false) ? $this->parseName($user->name, $full_name) : $full_name);
		
			// Generate Image
			$dir = dirname(dirname(__FILE__)) . '/images/thanks/';
			$this->gi->setDetails($name);
			$image = $this->gi->paintFarewell();
			$file = $this->gi->saveImage($image, $dir, $name);

			// Generate Tweet
			$hashtag = '#tweetthelove';
			$tweet = 'Hi @' . $full_name . '! I just wanted to say thanks for helping me '.$hashtag.' See you next year!';
			$param = array('status'	=> $tweet);

			// If Image Generated
			if(isset($file['filename']) && isset($file['filetype'])){
				$media = $twitter->upload('media/upload', array('media'	=> $dir.$file['filename'].'.'.$file['filetype']));
				if(isset($media->media_id_string)){
					$mediaID = $media->media_id_string;
					$param['media_ids'] = $mediaID;
				}
			}

			// Send Tweet
			$twitter->post('statuses/update', $param);

			// Check Twitter Response
			if(!isset($twitter->errors) || $twitter->getLastHttpCode() == 200){
				if(isset($media->media_id_string))
					$fileDesc = ' with file ' . $file['filename'] . '.' . $file['filetype'] . ' attached';
				else
					$fileDesc = null;
				// Success
				$this->ut->log((object)array(
					'code'	=> 105,
					'message' => 'Thank you sent to ' . $full_name . $fileDesc,
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
		} else {
			// Validation Fail
			$this->ut->log((object)array(
				'code'	=> 3,
				'message' => 'Tweet failed. No recipient specified'
			));
			die('Tweet failed. No recipient specified');
		}
	}

	public function updateFollower($fid){
		if(!isset($fid)){
			$this->ut->log((object)array(
				'code'	=> 1,
				'message'	=> 'No ID Specified',
				'file'		=> __FILE__,
				'line'		=> __LINE__
			));
			die('No ID specified.');
		}

		try {
			$sql = "UPDATE `follower_list` SET `sent` = 1 WHERE `fid` = $fid";
			$result = $this->db->prepare($sql);
			$result->execute();
		} catch(PDOException $e){
			$this->ut->log($e);
		}
	}

	public function nextFollowers(){
		$limit = floor(($this->twitter_api_limit / 24 / 60) * $this->cron_time);
		try {
			$sql = "SELECT * FROM `follower_list` WHERE `sent` = 0 LIMIT $limit";
			$result = $this->db->prepare($sql);
			$result->execute();
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e){
			$this->ut->log($e);
		}

		return $rows;
	}

	public function getFollowers(){
		$twitter = new TwitterOAuth($this->ckey, $this->csec, $this->atok, $this->asec);
		$cursor = -1;

		do {
			$followers = $twitter->get('followers/list', array('cursor' => $cursor, 'count'	=> 200));
			foreach($followers->users as $follower){
				try {
					$name = filter_var($follower->name, FILTER_SANITIZE_STRING);
					$screen_name = filter_var($follower->screen_name, FILTER_SANITIZE_STRING);
					$sql = "INSERT INTO `follower_list` VALUES (null, $follower->id, '$name', '$screen_name', '$follower->lang', 0, $followers->next_cursor)";		
					$result = $this->db->prepare($sql);
					$result->execute();
				} catch(PDOException $e){
					$this->ut->log($e);
				}
			}
			$cursor = $followers->next_cursor;
		} while($cursor != 0);
	}

	public static function getInstance(dbConnection $db, util $ut, generateImage $gi){
		if(!self::$instance)
			self::$instance = new self($db, $ut, $gi);
		return self::$instance;
	}

}