<?php
	require('lib/class.tweetqueue.php');
	$queue = new tweetQueue();
	$delay = ($queue->time()) ? 'a' . $queue->time() . 'minute' : 'no';

	session_start();
	$token = uniqid();
	$_SESSION['nonce'] = $token;
?>

<!doctype html>
<html>
<head>
	<title>Twitter Romance</title>
	<link type="text/css" href="assets/css/style.css" rel="stylesheet" />
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/tweenlite.min.js"></script>
	<script type="text/javascript" src="assets/js/tweenlite.css.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.gsap.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.scrollmagic.min.js"></script>
	<script type="text/javascript" src="assets/js/script.js"></script>
</head>
<body>

	<section id="send">
		<form id="send-tweet" method="post" action="post.php">
			<input type="hidden" name="nonce_token" value="<?php echo $_SESSION['nonce']; ?>" />
			<label for="tweet-target">Who is your Twitter Romance?</label><br />
			<input type="text" id="tweet-target" name="tweet_target" />
			<br />
			<br />
			<label for="tweet-message">Send Message to your <span id="target-name">Twitter Romance</span></label><br />
			<input type="text" id="tweet-message" name="tweet_message" />
			<input type="submit" id="submit-tweet" />
		</form>

		<span>There is currently <?php echo $delay; ?> delay delivering Tweets. <sub>(what's this?)</sub></span>

	</section>

</body>
</html>