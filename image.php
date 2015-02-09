<?php
require_once('require.php');

if(!isset($_GET['user']) | !isset($_GET['message'])){
	$_GET['user'] = 'Amy';
	$_GET['message'] = 'I rllly like u! will u be my valentine?!?!?!';
}
$_gi->setDetails(htmlspecialchars($_GET['user']), htmlspecialchars($_GET['message']));
$_gi->paintImage();
header('Content-type: image/png');
header('Content-Disposition: filename="valentines.png"');
imagepng($_gi->paintImage(), null, 8);
exit;