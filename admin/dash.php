<?php
// Get Row results
$queue = $_at->getEntries(false, 'tweet_queue', 'dtime', 'DESC', 5);
$flagged = $_at->getEntries(false, 'tweet_flagged', 'dtime', 'DESC', 5);
$archive = $_at->getEntries(false, 'tweet_archive', 'dtime', 'DESC', 5);
$senders = $_at->getEntries(false, 'tweet_sender', 'tid', 'DESC', 5);
$log = $_at->getEntries(false, 'log', 'etime', 'DESC', 5);

// Twitter Limits
$limits = $_at->getTwitterLimit();

// Get Row counts
$counts['queue'] = $_at->getEntries(true, 'tweet_queue');
$counts['flagged'] = $_at->getEntries(true, 'tweet_flagged');
$counts['archive'] = $_at->getEntries(true, 'tweet_archive');
$counts['senders'] = $_at->getEntries(true, 'tweet_sender');
$counts['log'] = $_at->getEntries(true, 'log');
?>
<section id="main-section">
	<div id="content">
		<header id="main-header">
			<h1>Dashboard</h1>
			<p>Overview of activity will go here.</p>
		</header>
		<section id="col1" class="col">
			<div id="queue" class="overview">
				<h3 class="title">Queue (<?php echo $counts['queue']; ?>)</h3>
				<?php if($counts['queue'] > 0): ?>
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Time</th>
							<th>User</th>
						</tr>
					</thead>
					<?php foreach($queue as $tweet){
						echo '<tr>';
						echo '<td class="index" title="'.$tweet['dmessage'].'">'.$tweet['tid'].'</td>';
						echo '<td>'.$_at->getTime($tweet['dtime'], 1).'</td>';
						echo '<td>'.$tweet['duser'].'</td>';
						echo '</tr>';
					} ?>
				</table>
				<?php else: ?>
					<p>There is nothing in the queue.</p>
				<?php endif; ?>
			</div>
			<div id="flagged" class="overview">
				<h3 class="title">Flagged (<?php echo $counts['flagged']; ?>)</h3>
				<?php if($counts['flagged'] > 0): ?>
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Time</th>
							<th>User</th>
						</tr>
					</thead>
					<?php foreach($flagged as $tweet){
						echo '<tr>';
						echo '<td class="index" title="'.$tweet['dmessage'].'">'.$tweet['tid'].'</td>';
						echo '<td>'.$_at->getTime($tweet['dtime'], 1).'</td>';
						echo '<td>'.$tweet['duser'].'</td>';
						echo '</tr>';
					} ?>
				</table>
				<?php else: ?>
					<p>There is nothing flagged.</p>
				<?php endif; ?>
			</div>
			<div id="archive" class="overview">
				<h3 class="title">Archive (<?php echo $counts['archive']; ?>)</h3>
				<?php if($counts['archive'] > 0): ?>
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Time</th>
							<th>User</th>
							<th>Delivered</th>
						</tr>
					</thead>
					<?php foreach($archive as $tweet){
						echo '<tr>';
						echo '<td class="index" title="'.$tweet['dmessage'].'">'.$tweet['tid'].'</td>';
						echo '<td>'.$_at->getTime($tweet['dtime'], 1).'</td>';
						echo '<td>'.$tweet['duser'].'</td>';
						echo '<td>';
						echo ($tweet['delivered']) ? '&#9745' : '&#9746';
						echo '</td>';
						echo '</tr>';
					} ?>
				</table>
				<?php else: ?>
					<p>There is nothing in the archive.</p>
				<?php endif; ?>
			</div>
		</section>
		<section id="col2" class="col">
			<div id="senders" class="overview">
				<h3 class="title">Senders (<?php echo $counts['senders']; ?>)</h3>
				<?php if($counts['senders'] > 0): ?>
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Sent from</th>
							<th>Recipient</th>
						</tr>
					</thead>
					<?php foreach($senders as $tweet){
						echo '<tr>';
						echo '<td>'.$tweet['tid'].'</td>';
						echo '<td>'.$tweet['ip'].'</td>';
						echo '<td>'.$tweet['recipient'].'</td>';
						echo '</tr>';
					} ?>
				</table>
				<?php else: ?>
					<p>There is no sender information.</p>
				<?php endif; ?>
			</div>
			<div id="log" class="overview">
				<h3 class="title">Log (<?php echo $counts['log']; ?>)</h3>
				<?php if($counts['log'] > 0): ?>
				<table>
					<thead>
						<tr>
							<th>Code</th>
							<th>Time</th>
							<th>Location</th>
						</tr>
					</thead>
					<?php foreach($log as $error){
						echo '<tr>';
						echo '<td class="index" title="'.htmlspecialchars($error['message']).'">'.$error['code'].'</td>';
						echo '<td>'.$_at->getTime($error['etime'], 1).'</td>';
						echo '<td>'.$error['file'].'</td>';
						echo '</tr>';
					} ?>
				</table>
				<?php else: ?>
					<p>There is nothing in the log.</p>
				<?php endif; ?>
			</div>
			<div id="stats" class="overview">
				<h3 class="title">Statistics</h3>
				<p>Overview of Statistics here.</p>
			</div>
		</section>
		<section id="row2" class="main-column">
			<div id="twitter_limits" class="full-view">
				<?php if($limits): ?>
					<table>
						<thead>
							<tr>
								<th>Twitter API Call</th>
								<th>Limit</th>
								<th>Remaining</th>
								<th>Reset</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($limits->resources as $resource => $items){ ?>
								<tr>
									<td colspan="4">
										<?php echo $resource; ?>
									</td>
								</tr>
								<?php foreach ($items as $item => $values){ ?>
									<tr>
										<td><?php echo $item; ?></td>
										<td><?php echo $values->limit; ?></td>
										<td><?php echo $values->remaining; ?></td>
										<td><?php echo date("m.d.y", $values->reset); ?></td>
									</tr>
								<?php } ?>
							<?php } ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</section>
	</div>
</section>