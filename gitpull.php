<?php
ignore_user_abort(true);

/* Check if request comes from GitHub IP Range
 * As provided by: https://api.github.com/meta
 */
if(!array_key_exists('REMOTE_ADDR', $_SERVER))
	throw new Exception('Missing remote address.');

$rmIP = ip2long($_SERVER['REMOTE_ADDR']);
$ghIP = ip2long('192.30.252.0');
$ghMask = -1024;
var_dump(($ghIP & $ghMask) === ($rmIP & $ghMask));

if(!empty($_POST['payload'])){
	$payload = json_decode($_POST['payload']);

	shell_exex('git pull');
}
