<?php
require_once('twitteroauth/twitteroauth.php');
require_once('class.dbconnection.php');
require_once('class.util.php');
require_once('class.sendtweet.php');
require_once('class.tweetdata.php');
require_once('class.tweetqueue.php');

$_db = dbConnection::getInstance();
$_ut = util::getInstance($_db);
$_td = tweetData::getInstance($_db);
$_st = sendTweet::getInstance($_td);
$_tq = tweetQueue::getInstance($_db, $_td);