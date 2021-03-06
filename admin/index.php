
<?php require_once('require.php');

// Run actions
if(isset($_GET['action']) && !empty($_GET['action'])){
	// DELETE
	if($_GET['action'] == 'delete'){
		$col = null;
		$id = null;
		// Check variables
		if(isset($_GET['page']) && isset($_GET['id']) && ctype_digit($_GET['id'])){
			switch($_GET['page']){
				case 'queue':
					$col = 'tweet_queue';
					$id = 'tid';
				break;
				case 'flagged':
					$col = 'tweet_flagged';
					$id = 'tid';
				break;
				case 'archive':
					$col = 'tweet_archive';
					$id = 'tid';
				break;
				case 'recipients':
					$col = 'tweet_recipients';
					$id = 'uid';
				break;
				case 'senders':
					$col = 'tweet_sender';
					$id = 'id';
				break;
				case 'log':
					$col = 'log';
					$id = 'eid';
				break;
				default:
					return;
				break;
			}
			$result = $_at->deleteEntry($col, $id, $_GET['id']);
			if($result) $_at->setMessages(array('title' => 'Success', 'message' => 'Entry deleted successfully.'));
			else $_at->setMessages(array('title' => 'Failure', 'message' => 'Deletion failed.'));
		}

	}
}
?>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Twitter Crush :: Admin</title>

	<link rel="apple-touch-icon" sizes="57x57" href="../assets/img/icons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="../assets/img/icons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../assets/img/icons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/icons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../assets/img/icons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="../assets/img/icons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="../assets/img/icons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="../assets/img/icons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="../assets/img/icons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="../assets/img/icons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="../assets/img/icons/favicon-194x194.png" sizes="194x194">
	<link rel="icon" type="image/png" href="../assets/img/icons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="../assets/img/icons/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="../assets/img/icons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="../assets/img/icons/manifest.json">
	<link rel="shortcut icon" href="../assets/img/icons/favicon.ico">
	<meta name="msapplication-TileColor" content="#f2206c">
	<meta name="msapplication-TileImage" content="../assets/img/icons/mstile-144x144.png">
	<meta name="msapplication-config" content="../assets/img/icons/browserconfig.xml">
	<meta name="theme-color" content="#f2206c">

	<link type="text/css" href="../assets/css/admin-style.css" rel="stylesheet">

	<script src="//use.typekit.net/sbe5mrr.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>

	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<script src="../assets/js/modernizr.custom.js"></script>
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/jquery.slimscroll.min.js"></script>
	<script src="../assets/js/jquery.fullPage.min.js"></script>
</head>
<body class="admin">
	<div id="container" class="clearfix">
		<?php if($_at->hasMessages()): ?>
			<div id="messages">
				<h3><?php echo $_at->getMessages()['title']; ?></h3>
				<p><?php echo $_at->getMessages()['message']; ?></p>
			</div>
		<?php endif; ?>
		<nav id="main-navigation">
			<ul>
				<li><a href="index.php?page=dash">Home</a></li>
				<li><a href="index.php?page=queue">Queue</a></li>
				<li><a href="index.php?page=flagged">Flagged</a></li>
				<li><a href="index.php?page=archive">Archive</a></li>
				<li><a href="index.php?page=recipients">Recipients</a></li>
				<li><a href="index.php?page=senders">Senders</a></li>
				<li><a href="index.php?page=log">Log</a></li>
				<li><a href="index.php?page=stats">Statistics</a></li>
			</ul>
		</nav>
		<?php
		if(isset($_GET['page']) && !empty($_GET['page'])){
			$page = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['page']);
			if(file_exists($page . '.php'))
				include($page . '.php');
			else
				include('dash.php');
		} else {
			include('dash.php');
		}
		?>
	</div>
	<script src="../assets/js/admin.js"></script>
</body>
</html>