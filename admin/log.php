<?php
$entries = $_at->getEntries(false, 'log', 'eid', 'DESC');
$count = $_at->getEntries(true, 'log');
?>
<section id="main-section">
	<div id="content">
		<header id="main-header">
			<h1>System Log</h1>
			<p>This is an overview of the system log.</p>
		</header>
		<section id="main-column">
			<div id="entries" class="full-view">
				<h3 class="title">Entries (<?php echo $count?:0; ?>)</h3>
				<?php if($count > 0): ?>
				<table>
					<thead>
						<tr>
							<th>Log ID</th>
							<th>Time</th>
							<th>Code</th>
							<th>Message</th>
							<th>Location</th>
							<th>Position</th>
							<th>Actions</th>
						</tr>
					</thead>
					<?php foreach($entries as $entry){
						echo '<tr>';
						echo '<td>'.$entry['eid'].'</td>';
						echo '<td>'.$entry['etime'].'</td>';
						echo '<td>'.$entry['code'].'</td>';
						echo '<td>'.$entry['message'].'</td>';
						echo '<td>'.$entry['file'].'</td>';
						echo '<td>'.$entry['line'].'</td>';
						echo '<td>Delete</td>';
						echo '</tr>';
					} ?>
				</table>
				<?php else: ?>
					<p>There are no log entries.</p>
				<?php endif; ?>
			</div>
		</section>
	</div>
</section>