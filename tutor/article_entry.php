<?php include 'components/authenticate.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>  
<html lang = "eng">
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
	</head>

<style>
	th {
		text-align: center;
	}
	tr {
		text-align: center;
	}
</style>

	<body style = "background-color:#F8F8F8;">
		<!-- Navigation Bar -->
	        <?php include 'navigation.php'; ?>
	
		<div class = "container-fluid">
			<?php include 'sidebar.php'; ?>	
		<div class = "col-lg-10 well" style = "margin-top:60px;">
			<div class="content">
				<!-- DataTable -->
			<div class = "alert alert-info">Upload / Article</div>
			<div align="right">
				<button type="button" name="add" id="add" data-toggle="modal" data-target="#myModal" class="btn btn-info">Add</button>
			</div>
					<br/>
					<div id = "grade_table">
						<table id = "table" class="table table-bordered table-striped">
							<thead class = "alert-success">
								<tr>
									<th>S/N</th>
									<th>Staff No.</th>
									<th>Full Name</th>
									<th>Article Title</th>
									<th>Document</th>
									<th>Upload Date</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$tutor_id = intval($_SESSION['tutor_id']);
									$q_article = $db->query("SELECT * FROM article_entry INNER JOIN tutor ON tutor.id=article_entry.tutor_id ORDER BY upload_date DESC");
									while ($row = $q_article->fetch_assoc()) {
										$name = $row['tutor_lname'].' '.$row['tutor_fname'];
										$tutor = $row['tutor_id'];
										$article = $row['article_id'];
										$doc_file = explode("/", $row['doc_upload']);
								?>
								<tr>
									<td><?php echo $row['id']; ?></td>
									<td><?php echo $row['staffId']; ?></td>
									<td><?php echo $name ?></td>
									<td><?php echo $row['article_title']; ?></td>
									<td><a href="../tutor/article_file/<?php echo $doc_file[2] ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-download-alt"></span> download</a></td>
									<td><?php echo $row['upload_date']; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div id ="grade"></div>
			</div>
	</div>
			
	</div>
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				<div id="content-data"></div>
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
	<script src = "../js/popper.min.js"></script>
  <script src = "../js/sweetalert.js"></script>
	<script src = "../js/sidebar.js"></script>
	<script src = "../js/jquery.dataTables.js"></script>
<script>
	$(document).ready(function(){
		$('#table').DataTable({
			"order":[]
		});
		$(document).on('click', '#add', function(){
			$('#content-data').html('');
		$.ajax({
			url:'controllers/form/article_entry_form.php',
			type:'POST',
			dataType:'html'
		}).done(function(data){
			$('#content-data').html('');
			$('#content-data').html(data);
		})
		});
	});
</script>
