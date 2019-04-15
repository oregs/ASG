
<?php require'connect.php'; ?>
<?php require_once 'valid.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>

<html lang = "eng">
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />

	<body style = "background-color:#F8F8F8;">
		
				<!-- Navigation Bar -->
				<?php include 'navigation.php'; ?>
			
		<div class = "container-fluid">
			<?php include 'sidebar.php'; ?>	
		<div class = "col-lg-10 well" style = "margin-top:60px;">
			<div class="content">
				<!-- Grading information -->
				<?php include 'controllers/form/view_scores_form.php'; ?>
			</div>
	</div>
			
	</div>
		
		<br />
		<br />
		<br />
		<nav class = "navbar navbar-default navbar-fixed-bottom">
			<div class = "container-fluid">
				<label class = "navbar-text pull-right">Assignment Submission & Grading System &copy; All rights reserved 2018</label>
			</div>
		</nav>
	</body>
	
	<script src = "js/sidebar.js"></script>
	<script src = "js/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function(){
			$('#table').DataTable();
		});
	</script>		
</html>