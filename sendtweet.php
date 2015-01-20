<?php
require('lib/class.sendtweet.php');
require('lib/class.tweetqueue.php');

$oAuth = array(
	'ckey'	=> 'P0S5Ph2XqIjWX1dUdx00qIm0c',
	'csec'	=> 'TVdvcrDsr1VXInvxvb8vQo5FmjWE0U8eXp912c4IBtWd2u9tA8',
	'atok'	=> '2971187889-PsR3dgNJEVxfXLF4CRauAUUbWZJoBkAEaUJUF3X',
	'asec'	=> 'El6bNPIwSRBJibwwglmgz6oTrrpkUahKYwnjswINnpnse'
);

$twitter = new sendTweet();
$twitter->setOAuth($oAuth['ckey'], $oAuth['csec'], $oAuth['atok'], $oAuth['asec']);

$queue = new tweetQueue();
$next = $queue->getNext(); 

foreach($next as $tweet){
	$twitter->postTweet($tweet['duser'], $tweet['dmessage']);
	$queue->delete($tweet['tid']);
}