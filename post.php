<?php
require('require.php');

session_start();
$return = new stdClass();

$user['ip'] = $_SERVER['REMOTE_ADDR'];
$user['agent'] = $_SERVER['HTTP_USER_AGENT'];
$user['location'] = (isset($_POST['location'])) ? $_POST['location'] : null;

if(isset($_POST['nonce_token']) && $_ut->checkSession($_POST['nonce_token'])):
	$return = $_tq->validateTweet($_POST);
	if(!isset($return->error)):
		$return = $_tq->insert($return->tweet['target'], $return->tweet['message'], $user);
	endif;
else:
	$return->error['code'] = 1;
	$return->error['message'] = 'Invalid token.';
endif;

echo json_encode($return);

$_ut->closeSession();