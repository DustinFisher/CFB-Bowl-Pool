<div id="content">	 
	<div id="bowl-game-title">Bowl Game Picks For <?php echo $bowl_name; ?></div>
		<div id="bowl-game-container">
			<div id ="leaderboard-scroll">
				<table id="gamePicks" class="tablesorter"> 
					<thead> 
						<tr> 
							<th>Name</th> 
							<th>Pick</th> 
							<th>Confidence</th> 
						</tr> 
					</thead> 
					<tbody> 
						<?php foreach($results as $result): ?>
						<tr> 
							<td><?php echo $result['name']; ?></td> 
							<td><?php echo $result['winner']; ?></td> 
							<td><?php echo $result['confidence']; ?></td> 
						</tr> 
						<?php endforeach; ?>
					</tbody> 
				</table>
			</div>
		</div>
	</div>
</div>
	
	<script>
		$(document).ready(function() { 
			// call the tablesorter plugin 
			$("#gamePicks").tablesorter({ 
				// sort on the first column and third column, order asc 
				
				sortList: [[0,0]]				
			})
		}); 
	</script>