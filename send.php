<?php
require('lib/lib.php');

$oAuth = array(
	'ckey'	=> 'P0S5Ph2XqIjWX1dUdx00qIm0c',
	'csec'	=> 'TVdvcrDsr1VXInvxvb8vQo5FmjWE0U8eXp912c4IBtWd2u9tA8',
	'atok'	=> '2971187889-PsR3dgNJEVxfXLF4CRauAUUbWZJoBkAEaUJUF3X',
	'asec'	=> 'El6bNPIwSRBJibwwglmgz6oTrrpkUahKYwnjswINnpnse'
);

$_st->setOAuth($oAuth['ckey'], $oAuth['csec'], $oAuth['atok'], $oAuth['asec']);

$next = $_tq->getNext(); 

foreach($next as $tweet){
	$_st->postTweet($tweet['duser'], $tweet['dmessage']);
	$_st->getUser($tweet['duser']);
	$_tq->delete($tweet['tid']);
}