<div id="content">	 
	<div id="bowl-game-title">Bowl Game Picks For <?php echo $name; ?> [Tie Breaker: <?php echo $tie_break; ?>]</div>
		<div id="bowl-game-container">
			<div id ="leaderboard-scroll">
				<table id="myTable" class="tablesorter"> 
					<thead> 
						<tr> 
							<th>Bowl Game</th> 
							<th>Location</th> 
							<th>Date</th> 
							<th>Network</th> 
							<th>Team 1</th> 
							<th>Team 2</th> 
							<th>Conf.</th>
						</tr> 
					</thead> 
					<tbody> 
						<?php foreach($results as $result): ?>
						<tr> 
							<td><?php echo $result['bowl']; ?></td> 
							<td><?php echo $result['location']; ?></td> 
							<td><?php echo $result['date']; ?></td> 
							<td><?php echo $result['network']; ?></td> 
							<?php if($result['winner'] == $result['team_1']): ?>
								<td class="correct"><?php echo $result['team_1']; ?></td> 
							<?php else: ?>
								<td><?php echo $result['team_1']; ?></td> 
							<?php endif; ?>
							<?php if($result['winner'] == $result['team_2']): ?>
								<td class="correct"><?php echo $result['team_2']; ?></td> 
							<?php else: ?>
								<td><?php echo $result['team_2']; ?></td> 
							<?php endif; ?>
							<?php if($result['won'] == $result['winner']): ?>
								<td class="winner" align="center">
									<?php echo $result['confidence']; ?>
								</td>
							<?php elseif($result['won'] == NULL): ?>
								<td align="center">
									<?php echo $result['confidence']; ?>
								</td>
							<?php else: ?>
								<td class="loser" align="center">
									<?php echo $result['confidence']; ?>
								</td>
							<?php endif; ?>
						</tr> 
						<?php endforeach; ?>
					</tbody> 
				</table> 
			</div>
		</div>
	</div>
</div>