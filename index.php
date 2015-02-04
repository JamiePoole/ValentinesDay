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
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.fittext.js"></script>
	<script src="assets/js/jquery.fullPage.min.js"></script>
</head>
<body>

	<!-- <div class="home-nav nav-btn animated fadeInDown">
		<a href="#intro">twitter crush</a>
	</div>
	<div class="info-nav nav-btn animated fadeInUp">
		<a href="#info">info</a>
	</div>
	<div class="share-nav nav-btn animated fadeInUp">
		<a href="#info">share</a>
	</div> -->

	<div id="fullpage">

		<div class="section intro-page" data-anchor="intro">
			<h1 class="heading fit-text animated">tweet your twitter crush anonymously</h1>
			<div class="send-nav animated">
				<a href="#send">tweet your crush</a>
			</div>
		</div>

		<div class="section send-page" data-anchor="send">
			<div id="tweet-form">
				<form id="send-tweet" method="post" action="post.php">
					<input type="hidden" name="nonce_token" value="<?php echo $_SESSION['nonce']; ?>" />
					<div class="form-step step-1 active">
						<label for="tweet-target">
							<span class="fit-text">twitter name of your crush</span>
						</label>
						<div class="form-control">
							<span class="form-prepend">@</span>
							<input type="text" id="tweet-target" name="tweet_target" />
							<a class="next-step" href="#">next</a>
						</div>
					</div>
					<div class="form-step step-2">
						<label for="tweet-message">
							<span class="fit-text">tweet to <span id="target-name">twitterhandle</span></span>
						</label>
						<div class="form-control">
							<textarea id="tweet-message" name="tweet_message" rows="3"></textarea>
							<a class="prev-step" href="#">back</a> <input type="submit" id="submit-tweet" value="send tweet" />
						</div>
					</div>
				</form>
				<span><?php // $_ut->getDelay($_tq->time()); ?></span>
			</div>
			<div id="tweet-image"></div>
		</div>

		<div class="section share-page" data-anchor="share">
			Share
		</div>

		<div class="section info-page" data-anchor="info">
			<div class="pic">
				<img src="assets/original/09_1148892.jpg">
			</div>
			<div class="copy">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis quis egestas erat, sagittis dapibus elit. Aliquam a accumsan quam. Vestibulum cursus quam mi, eu hendrerit augue consequat eu. Pellentesque id tristique arcu.</p>
				<p>DISCLAIMER: Donec non enim in risus consequat interdum. Aenean ut ultrices lacus, non maximus massa.</p>
			</div>
		</div>

	</div>
	
	<div class="page-border top"></div>
	<div class="page-border right"></div>
	<div class="page-border bottom"></div>
	<div class="page-border left"></div>

	<script src="assets/js/script.js"></script>	

</body>
</html>