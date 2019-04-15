<?php require_once 'components/authenticate.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>

<html lang = "eng">
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content = "width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"/>
	</head>

<style>
.jumbotron h1 {
  font-size: 40px;
}
</style>

	<body style = "background-color:#d3d3d3;">
		<?php include 'controllers/form/navigation.php'; ?>
<div class = "col-lg-10 well col-sm-offset-1">
	<div id="wrapper" class="wrapper" style = "margin-top:30px;">
		<div class = "alert alert-info" style="text-align:center; font-size:20px;">Result / Assignment Archive</div>
			<div class = "col-lg-1"></div>
					<div class="table_responsive">
						<div align="right">
							<a href="assignment_submission_archive.php" type="button" name="add" id="add" class="btn btn-info">View Assignment Archive</a>
						</div>
						<br />
						<div id="alert_message"></div>
						<?php include 'controllers/form/score_sheet_table.php'; ?>
					</div>
			</div>
</div>
		<br />
		<br />
		<br />
	
<script src = "../js/jquery.dataTables.js"></script>
<script>
$(document).ready(function(){
	$('#table').DataTable({
		"order":[]
	});
});
</script>
</body>
</html>
