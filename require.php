<?php
require_once('lib/class.dbconnection.php');
require_once('lib/class.util.php');
require_once('lib/class.sendtweet.php');
require_once('lib/class.tweetdata.php');
require_once('lib/class.tweetqueue.php');
require_once('lib/class.crontasks.php');
require_once('lib/class.generateimage.php');
require_once('lib/class.thankfollowers.php');

$_db = dbConnection::getInstance();
$_ut = util::getInstance($_db);
$_gi = generateImage::getInstance();
$_td = tweetData::getInstance($_db);
$_st = sendTweet::getInstance($_td, $_ut, $_gi);
$_tq = tweetQueue::getInstance($_db, $_td);
$_tf = thankFollowers::getInstance($_db, $_ut, $_gi);

// Define Cron Tasks Last
$_ct = cronTasks::getInstance($_st, $_tq, $_tf);