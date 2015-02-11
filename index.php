<?php
require_once('require.php');
$_ut->startSession();
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="canonical" href="http://www.mytwittercrush.com">

	<title>My Twitter Crush</title>
	<meta name="description" content="Anonymously tell your crush how you really feel. For each tweet we're donating £1 to Save the Children.">

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

	<meta property="og:title" content="My Twitter Crush">
	<meta property="og:type" content="website">
	<meta property="og:url" content="http://www.mytwittercrush.com">
	<meta property="og:image" content="http://www.mytwittercrush.com/assets/img/icons/favicon-194x194.png">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="194">
	<meta property="og:image:height" content="194">
	<meta property="og:description" content="Anonymously tell your crush how you really feel. For each tweet we're donating £1 to Save the Children.">
	<meta property="fb:app_id" content="1416098885351185">

	<link type="text/css" href="assets/css/style.css" rel="stylesheet">
	<script src="assets/js/respond.min.js"></script>
	<script src="//use.typekit.net/sbe5mrr.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<script src="assets/js/modernizr.custom.js"></script>
	<script src="assets/js/snap.svg-min.js"></script>
</head>
<body>

	<!-- Google Tag Manager -->
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-W2THBQ"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-W2THBQ');</script>
	<!-- End Google Tag Manager -->

	<!-- Facebook SDK -->
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '1416098885351185',
	      xfbml      : true,
	      version    : 'v2.2'
	    });
	  };
	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>
	<!-- End Facebook SDK -->

	<div id="fullpage">

		<div class="section intro-page" data-anchor="intro">
			<div class="artwork">
				<svg id="birds" width="100%" height="100%"></svg>
			</div>
			<div class="page">
				<h1 class="heading">Tweet the love</h1>
				<h2 class="sub-heading">
					Anonymously tell your crush how you really feel.<br>
					And the love doesn't end there. For each tweet we're donating £1 to Save the Children.
				</h2>
			</div>
			<a class="scroll-btn animated fadeInDown" href="#"><span class="wa-hidden">Next</span></a>
		</div><!--// .intro-page -->

		<div class="section send-page" data-anchor="send">
			<div class="page">
				<div id="tweet-form">
					<form id="send-tweet" action="post.php" methos="post">
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
					<p class="delay-time"><?php $_ut->getDelay($_tq->time()); ?></p>
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
			<!-- <div class="page-break"></div> -->
			<div class="page">
				<h1 class="heading">
					<span class="odometer-pre">£</span><span id="odometer" class="odometer">0</span>
				</h1>
				<h2 id="thanks" class="sub-heading">
					For each tweet we're donating £1 to Save the Children.<br>
					Scroll up to send a tweet and check out previous ones <a href="https://twitter.com/mytweetercrush" target="_blank">here</a>.
				</h2>
				<div class="share">
					<a class="share-btn fb-btn" href="">
						<span class="wa-hidden">Share on Facebook</span>
					</a> 
					<a class="share-btn tw-btn" href="https://twitter.com/share" 
						data-url="http://www.mytwittercrush.com" 
						data-hashtags="somehashtag" 
						onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
						<span class="wa-hidden">Share on Twitter</span>
					</a>
					<a class="share-btn gp-btn" href="https://plus.google.com/share?url=http://www.mytwittercrush.com" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
						<span class="wa-hidden">Share on Google +</span>
					</a>
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
					<p>Show your Twitter crush how much they mean to you by sending them something nice, something from the heart. Our tweeting Cupid will deliver your message by tweeting your crush on your behalf. Nobody will know it's you who sent it. Promise.</p>
					<p>For each lovely tweet that gets sent we're spreading the love even further and donating £1 until we reach our goal of £5000.</p>
					<p><strong>A project by</strong></p>
				</div>
				<div class="logos">
					<img class="us" src="assets/img/360i-logo.svg" width="80" height="80">
					<img class="savethechildren" src="assets/img/savethechildern-logo.svg" height="60" width="383">
				</div>
			</div><!--// .page -->
			<a class="scroll-btn animated up" href="#"><span class="wa-hidden">Next</span></a>
		</div><!--// .info-page -->

	</div><!--// #fullpage -->
	
	<div class="page-border top"></div>
	<div class="page-border right"></div>
	<div class="page-border bottom"></div>
	<div class="page-border left"></div>

	<!-- Twitter Widgets  -->
	<script>window.twttr = (function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0],
	    t = window.twttr || {};
	  if (d.getElementById(id)) return;
	  js = d.createElement(s);
	  js.id = id;
	  js.src = "https://platform.twitter.com/widgets.js";
	  fjs.parentNode.insertBefore(js, fjs);
	  t._e = [];
	  t.ready = function(f) {
	    t._e.push(f);
	  };
	  return t;
	}(document, "script", "twitter-wjs"));</script>
	<!-- End Twitter Widgets  -->

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.slimscroll.min.js"></script>
	<script src="assets/js/jquery.fullPage.min.js"></script>
	<script src="assets/js/odometer.min.js"></script>
	<script src="assets/js/script.js"></script>	

</body>
</html>