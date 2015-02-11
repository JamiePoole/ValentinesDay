<?php
$entries = $_at->getEntries(false, 'tweet_recipients', 'uid', 'DESC');
$count = $_at->getEntries(true, 'tweet_recipients');
?>
<section id="main-section">
	<div id="content">
		<header id="main-header">
			<h1>Recipients</h1>
			<p>This is an overview of recipients <strong>that have had their Twitter data collected</strong>.</p>
		</header>
		<section id="main-column">
			<div id="entries" class="full-view">
				<h3 class="title">Recipients (<?php echo $count?:0; ?>)</h3>
				<?php if($count > 0): ?>
				<table>
					<thead>
						<tr>
							<th>User ID</th>
							<th>Time</th>
							<th>Recipient</th>
							<th>Twitter Object</th>
							<th>Actions</th>
						</tr>
					</thead>
					<?php foreach($entries as $tweet){
						echo '<tr>';
						echo '<td>'.$tweet['uid'].'</td>';
						echo '<td>'.$_at->getTime($tweet['tdate'], 1).'</td>';
						echo '<td>'.$tweet['sname'].'</td>';
						echo '<td>'.$tweet['tobject'].'</td>';
						echo '<td>Delete</td>';
						echo '</tr>';
					} ?>
				</table>
				<?php else: ?>
					<p>There are no recipients.</p>
				<?php endif; ?>
			</div>
		</section>
	</div>
</section>