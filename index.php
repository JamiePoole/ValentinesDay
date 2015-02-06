<?php
require_once('require.php');
$_ut->startSession();
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Twitter Crush</title>
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
	<meta name="msapplication-TileColor" content="#f2206c">
	<meta name="msapplication-TileImage" content="assets/img/icons/mstile-144x144.png">
	<meta name="msapplication-config" content="assets/img/icons/browserconfig.xml">
	<meta name="theme-color" content="#f2206c">
	<link type="text/css" href="assets/css/style.css" rel="stylesheet">
	<script src="//use.typekit.net/sbe5mrr.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<script src="assets/js/modernizr.custom.js"></script>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.slimscroll.min.js"></script>
	<script src="assets/js/jquery.fullPage.min.js"></script>
	<script src="assets/js/odometer.min.js"></script>
	<script src="assets/js/script.js"></script>	
</head>
<body>

	<div id="fullpage">

		<div class="section intro-page" data-anchor="intro">
			<div class="artwork">
				<img src="assets/img/intro-birds.svg">
			</div>
			<div class="page">
				<h1 class="heading">Tweet the love</h1>
				<h2 class="sub-heading">Anonymously tell your crush how you really feel.</h2>
				<h3>And the love doesn't end there. For each tweet we're donating £1 to Save the Children.</h3>
			</div>
			<a class="scroll-btn animated fadeInDown" href="#"><span class="wa-hidden">Next</span></a>
		</div><!--// .intro-page -->

		<div class="section send-page" data-anchor="send">
			<div class="page">
				<div id="tweet-form">
					<form id="send-tweet" novalidate>
						<input type="hidden" name="nonce_token" value="<?php echo $_SESSION['token']; ?>" />
						<div class="form-error"></div>
						<div class="form-control">
							<span class="form-prepend">@</span>
							<input type="text" id="tweet-target" name="tweet_target" placeholder="twitterhandle" />
							<textarea id="tweet-message" maxlength="120" name="tweet_message" placeholder="Roses are red, tweets are nice..." rows="3"></textarea>
						</div>
						<div id="char-count"></div>
						<button type="submit" id="submit-tweet">
							<span class="animated">Send</span>
						</button>
					</form>
					<p class="delay-time"><?php //$_ut->getDelay($_tq->time()); ?></p>
					<div id="response"></div>
				</div>
			</div>
			<div class="tweet-hearts">
				<div class="tweet a"></div>
				<div class="tweet b"></div>
				<div class="tweet c"></div>
				<div class="tweet d"></div>
				<div class="tweet e"></div>
				<div class="tweet f"></div>
				<div class="tweet g"></div>
			</div>
			<a class="scroll-btn animated" href="#"><span class="wa-hidden">Next</span></a>
		</div><!--// .send-page -->

		<div class="section share-page" data-anchor="share">
			<div class="page">
				<h1 class="heading">
					<span class="odometer-pre">£</span><span id="odometer" class="odometer">0</span>
				</h1>
				<h2 id="thanks" class="sub-heading">
					For each tweet we're donating £1 to Save the Children<br>
					Scroll up to send a tweet
				</h2>
				<div class="share">
					<a class="share-btn fb-btn" href="#"><span class="wa-hidden">Share on Facebook</span></a> 
					<a class="share-btn tw-btn" href="#"><span class="wa-hidden">Share on Twitter</span></a> 
					<a class="share-btn gp-btn" href="#"><span class="wa-hidden">Share on Google +</span></a>
				</div>
			</div>
			<div class="artwork animated">
				<img src="assets/img/bird-bubble.svg">
			</div>
			<a class="scroll-btn animated" href="#"><span class="wa-hidden">Next</span></a>
		</div>

		<div class="section info-page" data-anchor="info">
			<div class="page">
				<div class="copy">
					<p>Show your Twitter crush how much they mean to you by sending them something really nice, something from the heart, and let us deliver the message for you. Nobody will know who sent it. Promise. Our Twitter Cupid will deliver your message by tweeting your crush on your behalf.</p>
					<p>For each lovely tweet that gets sent we’re spreading the love even further and donating £1 to Save the Children.</p>
					<p><strong>A project by</strong></p>
				</div>
				<div class="logos">
					<img class="us" src="assets/img/360i-logo.svg" width="80" height="80">
					<img class="savethechildren" src="assets/img/savethechildern-logo.svg" width="383" height="60">
				</div>
			</div><!--// .page -->
			<a class="scroll-btn animated up" href="#"><span class="wa-hidden">Next</span></a>
		</div><!--// .info-page -->

	</div><!--// #fullpage -->
	
	<div class="page-border top"></div>
	<div class="page-border right"></div>
	<div class="page-border bottom"></div>
	<div class="page-border left"></div>

	

</body>
</html>