<?php
require_once('lib/class.dbconnection.php');
require_once('lib/class.util.php');
require_once('lib/class.sendtweet.php');
require_once('lib/class.tweetdata.php');
require_once('lib/class.tweetqueue.php');
require_once('lib/class.crontasks.php');

$_db = dbConnection::getInstance();
$_ut = util::getInstance($_db);
$_td = tweetData::getInstance($_db);
$_st = sendTweet::getInstance($_td);
$_tq = tweetQueue::getInstance($_db, $_td);
$_ct = cronTasks::getInstance($_st, $_tq);