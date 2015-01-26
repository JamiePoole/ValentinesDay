<?php
require('lib/lib.php');

$_ut->startSession();
$return = new stdClass();

if((isset($_POST['nonce_token']) && isset($_SESSION['nonce'])) && ($_POST['nonce_token'] == $_SESSION['nonce'])){

	$recipient = filter_var($_POST['tweet_target'], FILTER_SANITIZE_STRING);
	$recipient = str_replace('@', '', $recipient);
	$message = filter_var($_POST['tweet_message'], FILTER_SANITIZE_STRING);

	if(trim($recipient) != '' && trim($message) != '' || preg_match('/\s/', $recipient)){
		$tweet = $_tq->insert($recipient, $message);
		
		$return->status['code'] = 200;
		$return->status['message'] = 'Tweet added to the queue successfully.';
		$return->queue['id'] = $tweet;
		$return->queue['time'] = $_tq->time($tweet);
	} else {
		$return->error['code'] = 2;
		$return->error['message'] = 'Invalid data.';
	}

} else {
	$return->error['code'] = 1;
	$return->error['message'] = 'Invalid token.';
}

echo json_encode($return);

$_ut->closeSession();