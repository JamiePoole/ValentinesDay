<?php
	require_once('lib/lib.php');
	$_ut->startSession();
?>

<!doctype html>
<html>
<head>
	<title>Twitter Romance</title>
	<link type="text/css" href="assets/css/style.css" rel="stylesheet" />
	<script src="//use.typekit.net/sbe5mrr.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/tweenlite.min.js"></script>
	<script type="text/javascript" src="assets/js/tweenlite.css.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.gsap.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.scrollmagic.min.js"></script>
	<script type="text/javascript" src="assets/js/script.js"></script>
</head>
<body>

	<div class="info-wrap">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis quis egestas erat, sagittis dapibus elit. Aliquam a accumsan quam. Vestibulum cursus quam mi, eu hendrerit augue consequat eu. Pellentesque id tristique arcu.</p>
		<p>DISCLAIMER: Donec non enim in risus consequat interdum. Aenean ut ultrices lacus, non maximus massa.</p>
	</div>
	<div class="info-nav animated fadeInDown">
		<a href="#" class="info">Info</a>
	</div>
	
	<div class="intro">
		<h1>Lorem ipsum dolor sit amet</h1>
		<img src="assets/img/envelope.png" height="457" width="622">
	</div>

	<section class="site-main" id="send">
		<div id="tweet-form">
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
			<span><?php $_ut->getDelay($_tq->time()); ?></span>
		</div>
		<div id="tweet-image">
		</div>
	</section>

	<div class="page-border"></div>

</body>
</html>