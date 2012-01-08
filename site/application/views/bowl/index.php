<div id="content">	 
	<div id="leaderboard">
		<div id="leaderboard-title">Leaderboard</div>
		<div id="leaderboard-container">
			<div id ="leaderboard-scroll">
				<table id="leaderboardTable" class="tablesorter"> 
					<thead> 
						<tr> 
							<th>Place</th>
							<th>Total Points</th> 
							<th>Name</th> 
							<th>Remaining Points</th> 
							<th>Most Confident</th> 
							<th>Least Confident</th> 
							<th>Tie Breaker</th> 
						</tr> 
					</thead> 
					<tbody> 
						<?php 
							$place = 1;
							if($results):
								foreach($results as $result):
						?>
						<tr>
							<td><?php echo $place ?></td>
							<td align="center"><span id="total_points"><?php echo $result['total_points']; ?></span></td>
							<td><a class='ajax' href="./bowl/user_picks/<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></td> 
							<td><?php echo $result['remaining_points']; ?></td>
							<td><?php echo $result['most_confident']; ?></td> 
							<td><?php echo $result['least_confident']; ?></td> 
							<td><?php echo $result['tie_breaker']; ?></td>  
						</tr> 
						<?php 
									$place++;	
								endforeach;
							endif;
						?>
					</tbody> 
				</table> 
			</div>
			<div style="float: left; clear:both; height: 5px;"></div>
			<div id="pager" class="pager">
				<form>
					<img src="images/first.png" class="first"/>
					<img src="images/prev.png" class="prev"/>
					<input type="text" class="pagedisplay" size="5"/>
					<img src="images/next.png" class="next"/>
					<img src="images/last.png" class="last"/>
					<select class="pagesize">
						<option value="15" selected="selected">15</option>
						<option value="25">25</option>
						<option value="216">All</option>
					</select>
				</form>
			</div>
			<div style="float: left; clear:both; height: 5px;"></div>
		</div>
		
		<div id="bowl-game-title">Bowl Game Results</div>
			<div id="bowl-game-container">
				<table id="myTable" class="tablesorter"> 
					<thead> 
						<tr> 
							<th>Bowl Game</th> 
							<th>Location</th> 
							<th>Date</th> 
							<th>Network</th> 
							<th>Team 1 (% Picked)</th> 
							<th>Team 2 (% Picked)</th> 
							<th>Avg. Conf.</th>
							<th>Score</th>
						</tr> 
					</thead> 
					<tbody> 
						<?php foreach($bowls as $bowl): ?>	
							<tr> 
								<td><a class='ajax' href="./bowl/bowl_picks/<?php echo $bowl['id']; ?>"><?php echo $bowl['bowl']; ?></a></td> 
								<td><?php echo $bowl['location']; ?></td> 
								<td><?php echo $bowl['date']; ?></td> 
								<td><?php echo $bowl['network']; ?></td> 
								<?php if($bowl['won'] == $bowl['team_1']): ?>
									<td class="winner">
										<?php 
											echo $bowl['team_1']; 
											echo ' <span id="percent">(' . $bowl['team_1_percent'] . '%) </span>';
										?>
									</td> 
								<?php else: ?>
								<td>
									<?php 
										echo $bowl['team_1'];
										echo ' <span id="percent">(' . $bowl['team_1_percent'] . '%) </span>';
									?>
								</td> 
								<?php endif; ?>
								<?php if($bowl['won'] == $bowl['team_2']): ?>
									<td class="winner">
										<?php 
											echo $bowl['team_2']; 
											echo ' <span id="percent">(' . $bowl['team_2_percent'] . '%) </span>';
										?>
									</td> 
								<?php else: ?>
									<td>
										<?php 
											echo $bowl['team_2'];
											echo ' <span id="percent">(' . $bowl['team_2_percent'] . '%) </span>';
										?>
									</td> 
								<?php endif; ?>
								<td align="center"><?php echo $bowl['avg_confidence']; ?></td>
								<td>
									<?php 
										if($bowl['won']){
											if($bowl['won'] == $bowl['team_1']){
												echo $bowl['winning_score'] . '-' . $bowl['losing_score'];
											} else {
												echo $bowl['losing_score'] . '-' . $bowl['winning_score'];
											}	
										} else {
											echo '-';
										}
									?>
								</td>
							</tr> 
						<?php endforeach; ?>
					</tbody> 
				</table> 
			</div>
			
			
			<script>
				$(document).ready(function() { 
					// call the tablesorter plugin 
					$("#leaderboardTable").tablesorter({ 
						// sort on the first column and third column, order asc 
						sortList: [[0,0]]				
					})
					.tablesorterPager({container: $("#pager"), size:15 })
				}); 
				$(".ajax").colorbox({transition:"fade"});
			</script>
