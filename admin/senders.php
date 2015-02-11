<?php
$entries = $_at->getEntries(false, 'tweet_sender', 'tid', 'DESC');
$count = $_at->getEntries(true, 'tweet_sender');
?>
<section id="main-section">
	<div id="content">
		<header id="main-header">
			<h1>Senders</h1>
			<p>This is an overview of the available data <strong>of the computer sending tweets</strong>.</p>
		</header>
		<section id="main-column">
			<div id="entries" class="full-view">
				<h3 class="title">Senders (<?php echo $count?:0; ?>)</h3>
				<?php if($count > 0): ?>
				<table>
					<thead>
						<tr>
							<th>Tweet ID</th>
							<th>Recipient</th>
							<th>IP</th>
							<th>Agent</th>
							<th>Actions</th>
						</tr>
					</thead>
					<?php foreach($entries as $entry){
						echo '<tr>';
						echo '<td>'.$entry['tid'].'</td>';
						echo '<td>'.$entry['recipient'].'</td>';
						echo '<td>'.$entry['ip'].'</td>';
						echo '<td>'.$entry['agent'].'</td>';
						echo '<td>Delete</td>';
						echo '</tr>';
					} ?>
				</table>
				<?php else: ?>
					<p>There are no senders.</p>
				<?php endif; ?>
			</div>
		</section>
	</div>
</section>