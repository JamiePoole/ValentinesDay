<?php
require_once('require.php');
session_start();
$_SESSION['token'] = uniqid();
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
		<div id="tweet-form">
			<form id="send-tweet" method="post" action="post.php">
				<input type="hidden" name="nonce_token" value="<?php echo $_SESSION['token']; ?>" />
				<label for="tweet-target">Who is your Twitter Romance?</label><br />
				<input type="text" id="tweet-target" name="tweet_target" />
				<br />
				<br />
				<label for="tweet-message">Send Message to your <span id="target-name">Twitter Romance</span></label><br />
				<input type="text" id="tweet-message" name="tweet_message" />
				<input type="submit" id="submit-tweet" />
			</form>

			<span><?php $_ut->getDelay($_tq->time()); ?></span>
		</div>
		<div id="tweet-image">
			<a href="#" id="tweet-image-upload">Generate an Image!</a>
		</div>
	</section>

</body>
</html>