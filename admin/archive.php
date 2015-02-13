<?php
$entries = $_at->getEntries(false, 'tweet_archive', 'dtime', 'DESC');
$count = $_at->getEntries(true, 'tweet_archive');
?>
<section id="main-section">
	<div id="content">
		<header id="main-header">
			<h1>Tweet Archive</h1>
			<p>This is an archive of all Tweets <strong>submitted to the queue. These may or may not have been delivered</strong>.</p>
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
							<th>Status</th>
						</tr>
					</thead>
					<?php foreach($entries as $tweet){
						echo '<tr>';
						echo '<td>'.$tweet['tid'].'</td>';
						echo '<td>'.$_at->getTime($tweet['dtime'], 1).'</td>';
						echo '<td>'.$tweet['duser'].'</td>';
						echo '<td>'.$tweet['dmessage'].'</td>';
						echo '<td>'.(($tweet['delivered']) ? 'Delivered' : 'Not Sent').'</td>';
						echo '</tr>';
					} ?>
				</table>
				<?php else: ?>
					<p>There are no Tweets in the archive.</p>
				<?php endif; ?>
			</div>
		</section>
	</div>
</section>