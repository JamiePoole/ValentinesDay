<?php
$statistics = $_sa->getStatistics();
?>
<section id="main-section">
	<div id="content">
		<header id="main-header">
			<h1>Statistics</h1>
			<p>Statistics gathered from data analysis of activity.</p>
		</header>
		<section id="main-column">
			<div id="queue" class="full-view">
				<h3 class="title">Statistics</h3>
				<?php if(count($statistics) > 0): ?>
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