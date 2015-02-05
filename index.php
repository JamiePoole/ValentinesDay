<?php
require_once('require.php');
$_ut->startSession();
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Twitter Romance</title>
	<link type="text/css" href="assets/css/style.css" rel="stylesheet">
	<script src="//use.typekit.net/sbe5mrr.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.slimscroll.min.js"></script>
	<script src="assets/js/jquery.fullPage.min.js"></script>
</head>
<body>

	<!-- <div class="home-nav nav-btn animated fadeInDown">
		<a href="#intro">Twitter Crush</a>
	</div> -->
	<div class="info-nav nav-btn animated fadeInUp">
		<a href="#info">Info.</a>
	</div>
	<div class="share-nav nav-btn animated fadeInUp">
		<a href="#share">Share</a>
	</div>

	<div id="fullpage">

		<div class="section intro-page" data-anchor="intro">
			<div class="inner">
				<h1 class="heading">Twitter Crush</h1>
				<h2 class="sub-heading">Tweet your crush anonymously</h2>
				<div class="send-nav">
					<a href="#send">&darr;</a>
				</div>
			</div><!--// .inner -->
		</div><!--// .intro-page -->

		<div class="section send-page" data-anchor="send">
			<div class="inner">
				<div id="tweet-form">
					<form id="send-tweet" method="post" action="post.php">
						<input type="hidden" name="nonce_token" value="<?php echo $_SESSION['token']; ?>" />
						<div class="form-step step-1 active">
							<label for="tweet-target">
								<span>Twitter name of your crush</span>
							</label>
							<div class="form-control">
								<span class="form-prepend">@</span>
								<input type="text" id="tweet-target" name="tweet_target" />
								<a class="next-step" href="#">Next</a>
							</div>
						</div>
						<div class="form-step step-2">
							<label for="tweet-message">
								<span>Tweet to <span id="target-name">twitterhandle</span></span>
							</label>
							<div class="form-control">
								<textarea id="tweet-message" name="tweet_message" rows="3"></textarea>
								<a class="prev-step" href="#">Back</a> <input type="submit" id="submit-tweet" value="Send tweet" />
							</div>
						</div>
					</form>
					<span><?php $_ut->getDelay($_tq->time()); ?></span>
				</div>
				<div id="tweet-image"></div>
			</div><!--// .inner -->
		</div><!--// .send-page -->

		<div class="section share-page" data-anchor="share">
			<div class="inner">
				<h1 class="heading">Thanks</h1>
				<h2 class="sub-heading">We've donated £1 to Save the Children</h2>
				<div class="share">
					<p>Share on <a href="#">Facebook</a> / <a href="#">Twitter</a> / <a href="#">Google +</a></p>
				</div>
			</div>
		</div>

		<div class="section info-page" data-anchor="info">
			<div class="inner">
				<div class="pic">
					<img src="assets/original/09_1148892.jpg">
				</div>
				<div class="copy">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis quis egestas erat, sagittis dapibus elit. Aliquam a accumsan quam. Vestibulum cursus quam mi, eu hendrerit augue consequat eu. Pellentesque id tristique arcu.</p>
					<p>DISCLAIMER: Donec non enim in risus consequat interdum. Aenean ut ultrices lacus, non maximus massa.</p>
				</div>
			</div><!--// .inner -->
		</div><!--// .info-page -->

	</div><!--// #fullpage -->
	
	<div class="page-border top"></div>
	<div class="page-border right"></div>
	<div class="page-border bottom"></div>
	<div class="page-border left"></div>

	<script src="assets/js/script.js"></script>	

</body>
</html>