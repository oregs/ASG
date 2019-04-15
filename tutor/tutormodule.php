<?php include 'components/authenticate.php'; ?>
 <!DOCTYPE html>
<html lang = "eng">
<?php include 'controllers/base/head.php' ?>
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" /> 
	</head>
	<body style = "background-color:#F8F8F8;">
			<!-- Navigation Bar -->
				<?php include 'navigation.php'; ?>
			
		<div class = "container-fluid">
			<?php include 'sidebar.php'; ?>	
		<div class = "col-lg-10 well" style = "margin-top:60px;">
			<div class="content">
				<!-- Grading information -->
				<?php include 'gradingmodule.php'; ?>
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

<script src = "../js/popper.min.js"></script>
<script src = "../js/sweetalert.js"></script>
<script src = "../js/login.js"></script>
<script src = "../js/sidebar.js"></script>
<script src = "../js/jquery.dataTables.js"></script>
<script type = "text/javascript">
$(document).ready(function(){
	$('#table').DataTable();
});
</script>
</body>
</html>