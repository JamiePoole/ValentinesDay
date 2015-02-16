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
	<meta name="description" content="Anonymously tell your crush how you really feel.">

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
	<meta property="og:image" content="http://www.mytwittercrush.com/assets/img/sharing-image-300x300.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="300">
	<meta property="og:image:height" content="300">
	<meta property="og:description" content="Anonymously tell your crush how you really feel.">
	<meta property="fb:app_id" content="1416098885351185">

	<link type="text/css" href="assets/css/style.css" rel="stylesheet">
	<script src="assets/js/respond.min.js"></script>
	<script src="//use.typekit.net/sbe5mrr.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<script src="assets/js/modernizr.custom.js"></script>
	<script src="assets/js/snap.svg-min.js"></script>
</head>
<body>

	<!-- Google Analytics -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-59532215-1', 'auto');
	  ga('send', 'pageview');
	</script>
	<!-- End Google Analytics -->

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
				<h1 class="heading">Thanks for spreading the love!</h1>
				<?php //<h1 class="heading">Tweet the love</h1> ?>
				<?php //<h1 class="heading">Love overload</h1> ?>
				<h2 class="sub-heading">
					After delivering thousands of romantic tweets this Valentine's we're going to call it a day.
					<br />
					<br />
					Until next year, <br />
					Cupid
					<?php // Anonymously tell your crush how you really feel ?>
					<?php // We'll be back shortly ?>
				</h2>
			</div>
			<a class="scroll-btn animated fadeInDown" href="#"><span class="wa-hidden">Next</span></a>
		</div><!--// .intro-page -->
		<?php /*
		<div class="section send-page" data-anchor="send">
			<div class="page">
				<div id="tweet-form">
					<form id="send-tweet" action="post.php" methos="post">
						<input type="hidden" id="nonce" name="nonce_token" value="<?php echo $_SESSION['token']; ?>" />
						<div class="form-control">
							<span class="form-prepend">@</span>
							<input type="text" id="tweet-target" maxlength="15" name="tweet_target" placeholder="twitterhandle" />
							<textarea id="tweet-message" maxlength="120" name="tweet_message" placeholder="Roses are red, tweets are nice..." rows="3"></textarea>
						</div>
						<div class="form-response">
							<div id="response"></div>
							<div id="char-count"></div>
						</div>
						<button type="submit" id="submit-tweet">
							<span class="animated">Send</span>
						</button>
					</form>
					<p class="delay-time"><?php $_ut->getDelay($_tq->time()); ?></p>
					
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
				<h1 id="thanks" class="heading">Share the love</h1>
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
				<h2 id="thanks-sub" class="sub-heading">
					Or get lost in a feed of love <a href="https://twitter.com/mytweetercrush" target="_blank">here</a>
				</h2>
			</div>
			<div class="artwork animated">
				<img src="assets/img/bird-bubble.svg">
			</div>
			<a class="scroll-btn animated" href="#"><span class="wa-hidden">Next</span></a>
		</div>

		<div class="section info-page" data-anchor="info">
			<!-- <div class="page-break"></div> -->
			<div class="page">
				<h1 class="heading">Hey love birds</h1>
				<div class="copy">
					<p>We just wanted to say that we're not responsible for any of the words in the tweets, we're simply Cupid the messenger in all this. We're moderating best we can but some things might slip through so please be nice and make love not war! DM us if you feel someone has crossed the line.</p>
				</div>
			</div>
			<a class="scroll-btn animated up" href="#"><span class="wa-hidden">Next</span></a>
		</div>
		*/ ?>

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
	<script src="assets/js/script.js"></script>	

</body>
</html>