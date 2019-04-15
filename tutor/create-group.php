<?php include 'components/authenticate.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>  
<html lang = "eng">
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.lwMultiSelect.css" />
		<!-- <link rel = "stylesheet" type = "text/css" href = "../css/bootstrap-multiselect.css" /> -->
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
				<!-- Creating Group Form -->
			<?php include 'controllers/form/create-group-form.php' ?>
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
	
	<script src="../js/jquery.lwMultiSelect.js"></script>
	<!-- <script src="../js/bootstrap-multiselect.js"></script> -->
	<script src = "../js/sidebar.js"></script>
	<script src = "../js/jquery.dataTables.js"></script>
	
	<!-- Receive request from get_course.php and output every student enroll in it.   -->
	<!-- Insert data into the database -->
<script>
	$(document).ready(function(){
		$('#table').DataTable();

		$('#student').lwMultiSelect();
		$('#course').change(function(){
			if($(this).val() != '')
			{
				var action = $(this).attr("id");
				var query = $(this).val();
				var result = '';
				if(action == 'course')
				{
					result = 'student';
				}
				$.ajax({
					url:"components/get_course.php",
		     		method:"POST",
		     		data:{action:action, query:query},
		     		success:function(data){
		     			$('#'+result).html(data);
		     			if(result=='student')
		     			{
		     				$('#student').data('plugin_lwMultiSelect').updateList();
		     			}
		     		}
				})
			}
		});

		$('#group_data').on('submit', function(){

			if($('#course').val() == '')
			{
				alert('Please Select Course');
				return false;
			}
			else if($('#student').val() == '')
			{
				alert("Please Select Student");
				return false;
			}
			else if($('#group_student').val() == '')
			{
				alert("Please Select Student");
				return false;
			}
			else
			{
				$('#student').val();
				var form_data = $(this).serialize();
				$.ajax({
					url:"components/insert_group.php",
					method:"POST",
					data:form_data,
					success:function(data){
						if(data)
						{
							$('#student').html('');
							$('#student').data('plugin_lwMultiSelect').updateList();
							$('#student').data('plugin_lwMultiSelect').removeAll();
							$('#group_data')[0].reset();
							alert('Data Inserted');
						}
					}
				}).then(function(){
					window.location="create-group.php";
				});
			}
	});

		$(document).on('click', '#getView', function(e){
		e.preventDefault();
		var id = $(this).val();
		$('#content-data').html('');
		$.ajax({
			url:'controllers/form/view_group_form.php',
			type:'POST',
			data:'id='+id,
			dataType:'html'
		}).done(function(data){
			$('#content-data').html('');
			$('#content-data').html(data);
		})
	});

	$(document).on('click', '#getAuto', function(){
		$('#content-data').html('');
		$.ajax({
			url:'controllers/form/autogroup_form.php',
			dataType:'html'
		}).done(function(dataType){
			$('#content-data').html('');
			$('#content-data').html(dataType);
		})
	});

});
</script>




























	<!-- <script>
		$(document).ready(function(){
		 $('#course').change(function(){
		    var courseMember = $(this).val();
		    $.ajax({
		     url:"components/get_course.php",
		     method:"POST",
		     dataType:"text",
		     data:{courseMember:courseMember},
		     success:function(data)
		     {
		      $('#student').html(data);
		      $('#student').multiselect('rebuild');
		     }
		    });
		 });
		 $('#add').click(function(){
		 	var groupMember = $('#group').val();
		 	$.ajax({
		 		url:"components/group_student.php",
		 		method:"POST",
		 		dataType:"text",
		 		data:{groupMember:groupMember},
		 		success:function(data){
		 			
		 		}
		 	});
		 });
		});
 </script> -->

</html>
