<?php
ignore_user_abort(true);

/* Check if request comes from GitHub IP Range
 * As provided by: https://api.github.com/meta
 * @return		boolean
 */
function validIP(){
	if(!array_key_exists('REMOTE_ADDR', $_SERVER))
		throw new Exception('Missing remote address.');

	$rmIP = ip2long($_SERVER['REMOTE_ADDR']);
	$ghIP = ip2long('192.30.252.0');
	$ghMask = -1024;

	return ($ghIP & $ghMask) === ($rmIP & $ghMask);
}

/* Check if request contains valid signature
 * matched from the secret key attached to the
 * webhook.
 * @return		boolean
 */
function validSignature($secret, $payload){
	if(!array_key_exists('HTTP_X_HUB_SIGNATURE', $_SERVER))
		throw new Exception('Missing X-Hub-Signature header. Did you configure a secret token in hook settings?');

	return 'sha1=' . hash_hmac('sha1', $payload, $secret, false) === $_SERVER['HTTP_X_HUB_SIGNATURE'];
}

/* Process the Payload data sent by GitHub.
 * Only the POST event is sent so no need to
 * parse different event types.
 * @return		object
 */
function processPayload(){
	$type = $_SERVER['CONTENT_TYPE'];
	if($type === 'application/x-www-form-urlencoded'):
		if(!array_key_exists('payload', $_POST))
			throw new Exception('Missing payload.');
		$payload = filter_input(INPUT_POST, 'payload');
	elseif($type === 'application/json'):
		$payload = file_get_contents('php://input');
	else:
		throw new Exception('Unknown content type.');
	endif;

	$payload = json_decode($payload);

	if($payload === null)
		throw new Exception('Failed to decode JSON: ' . function_exists('json_last_error_msg') ? json_last_error_msg() : json_last_error());

	return $payload;
}

if (validIP()):
	if(array_key_exists('payload', $_POST) && !empty($_POST['payload'])){
		$payload = processPayload();
		$secret = '360iValentine';
		if(validSignature($secret, $payload))
			shell_exex('git pull');
	}

endif;