<?php
require('require.php');

$_ut->startSession();
$return = new stdClass();

if((isset($_POST['nonce_token']) && isset($_SESSION['token'])) && ($_POST['nonce_token'] == $_SESSION['token'])){
	
	$background = filter_var($_GET['image_background'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1, 'max_range' => $_ci->countBackgrounds())));
	$recipient = filter_var($_GET['tweet_target'], FILTER_SANITIZE_STRING);
	$recipient = str_replace('@', '', $recipient);
	$message = filter_var($_GET['tweet_message'], FILTER_SANITIZE_STRING);

	$_ci->set($background, $recipient, $message);
	$image = $_ci->makeImage();

	$dir = 'media';
	$dirPath = dirname(__FILE__) . '/' . $dir . '/';
	$id = uniqid();
	$filename = $id.'.jpg';
	$createFolders = false;
	$backgroundColor = null;
	$imageQuality = 95;
	try {
		$image->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);
		$return->status['code'] = 200;
		$return->status['message'] = 'Image saved successfully.';
		$return->image['id'] = $id;
		$return->image['filename'] = $filename;
		$return->image['dir'] = $dirPath;
		$return->image['quality'] = $imageQuality;
		$return->image['url'] = $dir . '/' . $filename;
	} catch(Exception $e){
		die('Failed: '.$e);
	}
} else {
	$return->error['code'] = 1;
	$return->error['message'] = 'Invalid token.';
}

echo json_encode($return);