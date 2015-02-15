<?php
$statistics = $_sa->getStatistics();
?>
<section id="main-section">
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
							<th>Stastic</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($statistics as $stat => $value){ ?>
							<td><?php echo $stat; ?></td>
							<td><?php echo $value; ?>
						<?php } ?>
					</tbody>
				</table>
				<?php else: ?>
					<p>There are no statistics.</p>
				<?php endif; ?>
			</div>
		</section>
	</div>
</section>