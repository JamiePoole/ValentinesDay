<?php
require_once('lib/class.dbconnection.php');
require_once('lib/class.util.php');
require_once('lib/class.statistics.php');
require_once('lib/class.sendtweet.php');
require_once('lib/class.tweetdata.php');
require_once('lib/class.tweetqueue.php');
require_once('lib/class.crontasks.php');
require_once('lib/class.generateimage.php');

$_db = dbConnection::getInstance();
$_ut = util::getInstance($_db);
$_sa = statistics::getInstance($_db, $_ut);
$_td = tweetData::getInstance($_db);
$_st = sendTweet::getInstance($_td, $_ut);
$_tq = tweetQueue::getInstance($_db, $_td);
$_ct = cronTasks::getInstance($_st, $_tq, $_sa);
$_gi = generateImage::getInstance();