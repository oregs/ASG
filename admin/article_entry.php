<?php require 'components/authenticate.php';?>
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
.jumbotron h1 {
  font-size: 40px;
}
</style>

	<body style = "background-color:#d3d3d3;">
		<!-- Navigation Bar -->
	<?php include 'controllers/form/navigation.php'; ?>	
		<div class = "col-lg-10 well col-sm-offset-1">
	<div id="wrapper" class="wrapper" style = "margin-top:30px;">
		<div class = "alert alert-info" style="text-align:center; font-size:20px;">Article Entry</div>
			<div class = "col-lg-1"></div>
					<div class="table_responsive">
						<br />
						<div id="alert_message"></div>
						<table id = "table" class="table table-bordered table-striped">
							<thead class = "alert-success">
								<tr>
									<th>S/N</th>
									<th>Staff No.</th>
									<th>Full Name</th>
									<th>Article Title</th>
									<th>Document</th>
									<th>Upload Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
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
									<td> <button type="button" name="remove" value="<?= $article; ?>" class="btn btn-danger btn-xs remove" value=""><span class="glyphicon glyphicon-trash"></span> Delete</button></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
			</div>
</div>

<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<div id="content-data"></div>
	</div>
</div>
<script src = "../js/jquery.dataTables.js"></script>
<script>
	$(document).ready(function(){
		$('#table').DataTable({
			"order":[]
		});
	});
</script>
<script>
    $(document).ready(function(){
        $result = $('<center><label>Deleting...</label></center>');
    $('.remove').click(function(){
                $articleID = $(this).attr('value');
            if(confirm("Are you sure you want to remove this?"))
            {
                $(this).parents('td').empty().append($result);
                $('.remove').attr('disabled', 'disabled');
                setTimeout(function(){
                    window.location = 'components/delete_article_entry.php?articleID=' + $articleID;
                }, 1000);
            }
        });
    });
</script>
</body>
