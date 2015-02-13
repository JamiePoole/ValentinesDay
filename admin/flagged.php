<?php
$entries = $_at->getEntries(false, 'tweet_flagged', 'dtime', 'DESC');
$count = $_at->getEntries(true, 'tweet_flagged');
?>
<section id="main-section">
	<div id="content">
		<header id="main-header">
			<h1>Flagged Tweets</h1>
			<p>This is an overview of Tweets <strong>that have been flagged inappropriate</strong>.</p>
		</header>
		<section id="main-column">
			<div id="entries" class="full-view">
				<h3 class="title">Tweets (<?php echo $count?:0; ?>)</h3>
				<?php if($count > 0): ?>
				<table>
					<thead>
						<tr>
							<th>Tweet ID</th>
							<th>Time</th>
							<th>Recipient</th>
							<th>Message</th>
							<th>Actions</th>
						</tr>
					</thead>
					<?php foreach($entries as $tweet){
						echo '<tr>';
						echo '<td>'.$tweet['tid'].'</td>';
						echo '<td>'.$_at->getTime($tweet['dtime'], 1).'</td>';
						echo '<td>'.$tweet['duser'].'</td>';
						echo '<td>'.$tweet['dmessage'].'</td>';
						echo '<td><a href="index.php?action=delete&page=flagged&id='.$tweet['tid'].'">Delete</a> | Queue</td>';
						echo '</tr>';
					} ?>
				</table>
				<?php else: ?>
					<p>There are no flagged Tweets.</p>
				<?php endif; ?>
			</div>
		</section>
	</div>
</section>