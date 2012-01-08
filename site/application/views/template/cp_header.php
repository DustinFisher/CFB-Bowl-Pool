<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GBG 2011 NCAA Bowl Pick'em</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("styles/styles.css"); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("styles/colorbox.css"); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("styles/jgrowl.css"); ?>" />
<script type="text/javascript" src="<?php echo base_url("js/jquery-1.7.1.min.js"); ?>"></script> 
<script type="text/javascript" src="<?php echo base_url("js/jquery.tablesorter.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("js/jquery.tablesorter.pager.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("js/jquery.colorbox-min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("js/jquery.form.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("js/jquery.jgrowl_minimized.js"); ?>"></script>
<?php if($css_files && $js_files): ?>
	<?php foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>
<?php endif; ?>
<style type='text/css'>
body
{
    font-family: Arial;
    font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
    text-decoration: underline;
}
</style>
</head>

<body>
	
	<div id="header">
		<div id="header-content">
			<img id="logo" src="<?php echo base_url('images/GBG.png'); ?>" />
		</div>
	</div>
	<div id="wrapper">
		<div id="content">
			<h1>Bowl Pool Control Panel</h1>
			<p><a href="<?php echo site_url('cp/');?>">Home</a> | <a id="add-sheet" href="#">Add a Sheet</a> | <a href="<?php echo site_url('cp/update_game');?>">Update Game</a> </p>
			
			<div id="upload-form">
				<form method="post" action="" class="upload_file" enctype="multipart/form-data">
					<input type="file" name="userfile" value="" />
					<input type="submit" name="submit" id="submit" value="Add" />
				</form>
			</div>