<?php
require('lib/class.tweetqueue.php');
$queue = new tweetQueue();

session_start();

if((isset($_POST['nonce_token']) && isset($_SESSION['nonce'])) && ($_POST['nonce_token'] == $_SESSION['nonce'])){

	$recipient = filter_var($_POST['tweet_target'], FILTER_SANITIZE_STRING);
	$recipient = str_replace('@', '', $recipient);
	$message = filter_var($_POST['tweet_message'], FILTER_SANITIZE_STRING);

	if(trim($recipient) != '' && trim($message) != ''){
		$queue->insert($recipient, $message);
		header("Location: http://localhost/ValentinesDay/");
	}

} else {
	die('Invalid token');
}

unset($_SESSION['nonce']);