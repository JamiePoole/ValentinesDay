<?php
require_once('require.php');

$_gi->setDetails(htmlspecialchars($_GET['user']), htmlspecialchars($_GET['message']));
$_gi->paintImage();
header('Content-type: image/jpeg');
imagejpeg($_gi->paintImage(), null, 95);