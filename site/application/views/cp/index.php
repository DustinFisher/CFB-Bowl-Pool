	<table id="leaderboardTable" class="tablesorter"> 
		<thead> 
			<tr> 
				<th>Name</th>
				<th>Email</th> 
				<th></th> 
			</tr> 
		</thead> 
		<tbody> 
			<?php foreach($sheets as $sheet): ?>
			<tr>
				<td><?php echo $sheet['name']; ?></td>
				<td><?php echo $sheet['email']; ?></td>
				<?php $url = 'cp/edit_picks/' . $sheet['id'] ?>
				<td><a href="<?php echo site_url($url); ?>">Edit Picks</a></td> 
			</tr> 
			<?php endforeach; ?>
		</tbody> 
	</table> 

<script type="text/javascript">
	$('#add-sheet').click(function(event){
		event.preventDefault();
		$('#upload-form').toggle();
	});
	
	var options = { 
		url:        '/devsite/cp/upload_file/',
        dataType:  'json',          
        success:   processJson  
    }; 
        
    $('.upload_file').ajaxForm(options); 
        
    function processJson(data) {
		if(data.status != 'error'){
			$.jGrowl("Sheet Added Successfully", { life: 2000 });
        }
    }
	
	$(document).ready(function() { 
		// call the tablesorter plugin 
		$("#leaderboardTable").tablesorter({ 
			sortList: [[0,0]],
			headers: { 2: { sorter: false } }
		})
	}); 
</script>
