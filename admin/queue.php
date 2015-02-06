<?php
$queue = $_at->getEntries(false, 'tweet_queue', 'dtime', 'DESC');
$count = $_at->getEntries(true, 'tweet_queue');
?>
<section id="main-section">
	<?php if($_at->hasMessages()): ?>
		<div id="messages">
			<h3>Message Title</h3>
			<p>Message content and description of error/notice.</p>
		</div>
	<?php endif; ?>
	<div id="content">
		<header id="main-header">
			<h1>Tweet Queue</h1>
			<p>This is an overview of Tweets <strong>that have NOT yet been delivered</strong>.</p>
		</header>
		<section id="main-column">
			<div id="queue" class="full-view">
				<h3 class="title">Queue (<?php echo $count; ?>)</h3>
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
					<?php foreach($queue as $tweet){
						echo '<tr>';
						echo '<td>'.$tweet['tid'].'</td>';
						echo '<td>'.$_at->getTime($tweet['dtime'], 1).'</td>';
						echo '<td>'.$tweet['duser'].'</td>';
						echo '<td>'.$tweet['dmessage'].'</td>';
						echo '<td>Delete | Flag</td>';
						echo '</tr>';
					} ?>
				</table>
				<?php else: ?>
					<p>There is nothing in the queue.</p>
				<?php endif; ?>
			</div>
		</section>
	</div>
</section>