<?php
// require_once('twitteroauth/twitteroauth.php');
// require_once('class.dbconnection.php');
// require_once('class.util.php');
// require_once('class.sendtweet.php');
// require_once('class.tweetdata.php');
// require_once('class.tweetqueue.php');
// require_once('class.createimage.php');

spl_autoload_register(function($className){
    $namespace = str_replace("\\", "/", __NAMESPACE__);
    $className = strtolower(str_replace("\\", "/", $className));
    $class = dirname(__FILE__) . '/lib/' . (empty($namespace) ? "" : $namespace ."/") . "{$className}.php";
    include_once($class);
});

$_db = dbConnection::getInstance();
$_ut = util::getInstance($_db);
$_td = tweetData::getInstance($_db);
$_st = sendTweet::getInstance($_td);
$_tq = tweetQueue::getInstance($_db, $_td);
$_ci = createImage::getInstance();
$_ct = cronTasks::getInstance($_st, $_tq);