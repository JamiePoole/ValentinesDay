<?php
require_once('require.php');
$_ut->startSession();
?>

<!doctype html>
<!--[if IE 9]> <html class="ie9" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Twitter Crush</title>

	<link rel="apple-touch-icon" sizes="57x57" href="assets/img/icons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="assets/img/icons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/img/icons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/icons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/img/icons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="assets/img/icons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="assets/img/icons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="assets/img/icons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="assets/img/icons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="assets/img/icons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="assets/img/icons/favicon-194x194.png" sizes="194x194">
	<link rel="icon" type="image/png" href="assets/img/icons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="assets/img/icons/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="assets/img/icons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="assets/img/icons/manifest.json">
	<link rel="shortcut icon" href="assets/img/icons/favicon.ico">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="assets/img/icons/mstile-144x144.png">
	<meta name="msapplication-config" content="assets/img/icons/browserconfig.xml">
	<meta name="theme-color" content="#931658">

	<link type="text/css" href="assets/css/style.css" rel="stylesheet">
	<script src="//use.typekit.net/sbe5mrr.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.slimscroll.min.js"></script>
	<script src="assets/js/jquery.fullPage.min.js"></script>
	<script src="assets/js/jquery.idealforms.min.js"></script>
</head>
<body>

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
				<div id="tweet-form" class="idealsteps-container">
  					<!-- <nav class="idealsteps-nav"></nav> -->
					<form id="send-tweet" class="idealforms" novalidate method="post" action="post.php">
						<div class="idealsteps-wrap">
							<input type="hidden" name="nonce_token" value="<?php echo $_SESSION['token']; ?>" />
							<div class="form-step idealsteps-step">
								<div class="field">
									<label for="tweet-target">
										<span>Twitter name of your crush</span>
									</label>
									<div class="form-control">
										<span class="form-prepend">@</span>
										<input type="text" id="tweet-target" name="tweet_target" />
										<button type="button" class="next">Next</button>
									</div>
									<div class="error"></div>
								</div>
							</div>
							<div class="form-step idealsteps-step">
								<div class="field">
									<label for="tweet-message">
										<span>Tweet to <span id="target-name">twitterhandle</span></span>
									</label>
									<div class="form-control">
										<textarea id="tweet-message" name="tweet_message" rows="3"></textarea>
										<button type="button" class="prev">Back</button> 
										<input type="submit" id="submit-tweet" class="submit" value="Send tweet" />
									</div>
									<div class="error"></div>
								</div>
							</div>
							<div class="form-step idealsteps-step">
								Thanks<br>
								<a href="#share">Share</a>
							</div>
						</div><!--// .idealsteps-wrap -->
					</form><!--// .idealforms -->
					<p class="delay-time"><?php $_ut->getDelay($_tq->time()); ?></p>
				</div>
				<div id="tweet-image"></div>
			</div><!--// .inner -->
		</div><!--// .send-page -->

		<div class="section share-page" data-anchor="share">
			<div class="inner">
				<h1 class="heading">£1,529</h1>
				<h2 class="sub-heading">Has been donated to Save the Children</h2>
				<div class="share">
					<p>Share on <a class="share-btn fb-btn" href="#">Facebook</a> / <a class="share-btn tw-btn" href="#">Twitter</a> / <a class="share-btn gp-btn" href="#">Google +</a></p>
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