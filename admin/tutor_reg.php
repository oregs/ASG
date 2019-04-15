<?php 
require 'components/authenticate.php';
?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>
<html lang = "eng">
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.lwMultiSelect.css" />
		<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"/>
	</head>
	<style>
.jumbotron h1 {
  font-size: 40px;
}
</style>
	<body style = "background-color:#d3d3d3;">
		<?php include 'controllers/form/navigation.php'; ?>
<div class = "col-lg-10 well" style="background: white; position:relative; left:8%;">
	<div id="wrapper" class="wrapper" style = "margin-top:30px;">
		<div class = "alert alert-info" style="text-align:center; font-size:20px;">Accounts/Lecturer</div>
			<div class = "col-lg-1"></div>
					<div class="table_responsive">
						<div align="right">
							<button id = "add_tutor" type = "button" class = "btn btn-primary"><span class = "glyphicon glyphicon-plus"></span> Add new</button>
							<button id = "show_tutor" type = "button" style = "display:none;" class = "btn btn-success"><span class = "glyphicon glyphicon-circle-arrow-left"></span> Back</button>
						</div>
						<br />
						<div id="alert_message"></div>
					<div id = "tutor_table">
						<table id="tutor_data" class ="table table-bordered table-striped">
							<thead class ="alert-success">
								<tr>
									<th>SN</th>
									<th>Staff ID</th>
									<th>Full Name</th>
									<th>Phone</th>
									<th>Email</th>
									<th>Assigned Courses</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
					</div>
			</div>
					<div id="tutor_form" style = "display:none;">
						<div class = "col-lg-3"></div>
						<div class = "col-lg-6">
							<form method = "POST" action = "components/save_tutor_query.php" enctype = "multipart/form-data" id="regForm">
								<div class = "form-group">	
									<label>Firstname:</label>
									<input type = "text" name="firstname" id="fname" required = "required" class = "form-control" />
									 <span class="text-danger font-weight-bold" id="fname_error"></span>
								</div>		
								<div class = "form-group">	
									<label>Lastname:</label>
									<input type = "text" required = "required" name="lastname" id="lname" class = "form-control" />
									 <span class="text-danger font-weight-bold" id="lname_error"></span>
								</div>
								<div class = "form-group">
									<label>Staff ID:</label>
									<input type = "text" required = "required" name="staffId" id="staffId" class = "form-control" />
									 <span class="text-danger font-weight-bold" id="staffId_error"></span>
								</div>	
								<div class = "form-group">	
									<label>Phone:</label>
									<input type = "text" required = "required" name="phone" id="phone" class = "form-control" />
									 <span class="text-danger font-weight-bold" id="phone_error"></span>
								</div>
								<div class = "form-group">	
									<label>Email:</label>
									<input type = "text" required = "required" name="email" id="email" class = "form-control" />
									 <span class="text-danger font-weight-bold" id="email_error"></span>
								</div>
								
								<div class = "form-group">	
									<label>Password:</label>
									<input type = "password" maxlength="12" name="password" id="password" required = "required" class = "form-control" />
									 <span class="text-danger font-weight-bold" id="password_error"></span>
								</div>	
								
								<div class = "form-group">	
									<button class = "btn btn-primary" name="save_tutor"><span class = "glyphicon glyphicon-save"></span> Submit</button>
								</div>
							</form>		
						</div>	
					</div>
</div>
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				<div id="content-data"></div>
		</div>

<script src = "../js/popper.min.js"></script>
<script src = "../js/sweetalert.js"></script>
<script src="../js/jquery.lwMultiSelect.js"></script>
<script src = "../js/jquery.dataTables.js"></script>
<!-- <script src="assets/js/bootstrap-multiselect.js"></script> -->

	<script type="text/javascript">

$(document).ready(function(){

	fetch_data();
	
	 function fetch_data()
	 {
	 	var dataTable = $('#tutor_data').DataTable({
	 	"processing": true,
	 	"serverSide": true,
	 	"order":[],
	 	"ajax":{
	 		url:"components/tutor_query.php",
	 		type:"POST"
	 	}

	 	});
	}
});
</script>
<!-- script js for get view data -->
<script>
	$(document).on('click', '#getView', function(e){
		e.preventDefault();
		var per_courseID = $(this).data('id');
		$('#content-data').html('');
		$.ajax({
			url:'controllers/form/view_course.php',
			type:'POST',
			data:'id='+per_courseID,
			dataType:'html'
		}).done(function(data){
			$('#content-data').html('');
			$('#content-data').html(data);
		})
	});
</script>	
<!-- script js for get edit data -->
<script>
	$(document).on('click', '#getEdit', function(e){
		e.preventDefault();
		var per_id = $(this).data('id');
		$('#content-data').html('');
		$.ajax({
			url:'controllers/form/edit_profile_form.php',
			type:'POST',
			data:'id='+per_id,
			dataType:'html'
		}).done(function(data){
			$('#content-data').html('');
			$('#content-data').html(data);
		})
	});
</script>
<script>
		$(document).ready(function(){
			$('#add_tutor').click(function(){
				$(this).hide();
				$('#show_tutor').show();
				$('#tutor_table').slideUp();
				$('#tutor_form').slideDown();
				$('#show_tutor').click(function(){
					$(this).hide();
					$('#add_tutor').show();
					$('#tutor_table').slideDown();
					$('#tutor_form').slideUp();
				});
			});       	
    });
	</script>
	<!-- Validating Form Registration -->
  <script type="text/javascript">
    $(function(){
        $('#fname_error').hide();
        $('#lname_error').hide();
        $('#phone_error').hide();
        $('#staffId_error').hide();
        $('#email_error').hide();
        $('#password_error').hide();

        var error_fname = false;
        var error_lname = false;
        var error_phone = false;
        var error_staffId = false;
        var error_email = false;
        var error_password = false;
        
        $('#fname').focusout(function(){
            check_fname();
        });
        $('#lname').focusout(function(){
            check_lname();
        });
        $('#phone').focusout(function(){
            check_phone();
        });
        $('#email').focusout(function(){
             check_email();
        });
        $('#password').focusout(function(){
             check_password();
        });
        $('#staffId').focusout(function(){
             check_staffId();
        });

        function check_fname(){
            var firstname_pattern = /^[a-zA-Z]*$/;
            var firstname = $('#fname').val();
            if(firstname_pattern.test(firstname) && firstname !== ""){
                $('#fname_error').hide();
                $('#fname').css("border-color", "green");
            }
            else{
              $('#fname_error').html("**Should contain only Characters");
              $('#fname_error').show();
              $('#fname').css("border-color", "red");
              error_fname = true;
            }
        }

        function check_lname(){
            var lastname_pattern = /^[a-zA-Z]*$/;
            var lastname = $('#lname').val();
            if(lastname_pattern.test(lastname) && lastname !== ""){
                $('#lname_error').hide();
                $('#lname').css("border-color", "green");
            }
            else{
                $('#lname_error').html("**Should contain only Characters");
                $('#lname_error').show();
                $('#lname').css("border-color", "red");
                error_lname = true;
            }
        }
        function check_password(){
            var password = $('#password').val();
            if(password !== ""){
                $('#password_error').hide();
                $('#password').css("border-color", "green");
            }
            else{
              $('#password_error').html("**Please fill the password field");
              $('#password_error').show();
              $('#password').css("border-color", "red");
              error_password = true;
            }
        }

        function check_phone(){
            var phone_pattern = /^\d{11}$/;
            var phone = $('#phone').val();
            if(phone_pattern.test(phone) && phone !== ""){
                $('#phone_error').hide();
                $('#phone').css("border-color", "green");
            }
            else{
              $('#phone_error').html("**Should contain only Numeric and 11 digit long");
              $('#phone_error').show();
              $('#phone').css("border-color", "red");
              error_phone = true;
            }
        }

        function check_staffId(){
        	$('#staffId').on('blur', function(){
        		var staffId = $('#staffId').val();

            if(staffId !== ""){
                $.ajax({
                	url:'components/validating.php',
                	type:'POST',
                	data:{action:'check', staffId:staffId},
                	success:function(response){
                		if (response == 'exist') {
                			$('#staffId_error').html("**Staff ID already exist");
              				$('#staffId_error').show();
              				$('#staffId').css("border-color", "red");
              				error_staffId = true;
                		}
                		else
                		{
                			$('#staffId_error').hide();
                			$('#staffId').css("border-color", "green");
                		}
                	}

                });
     		}
            else{
              $('#staffId_error').html("**Please fill the staffId field");
              $('#staffId_error').show();
              $('#staffId').css("border-color", "red");
              error_staffId = true;
            }
		});
        }

        function check_email(){
        	$('#email').on('blur', function(){
	            var email_pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
	            var email = $('#email').val();
	            if(email_pattern.test(email) && email !== ""){
	            	$.ajax({
	                	url:'components/validating.php',
	                	type:'POST',
	                	data:{email_check:'verify', email:email},
	                	success:function(response){
	                		if (response == 'exist') {
	                			$('#email_error').html("**Email already exist");
	              				$('#email_error').show();
	              				$('#email').css("border-color", "red");
	              				error_email = true;
	                		}
	                		else
	                		{
	                			$('#email_error').hide();
	                			$('#email').css("border-color", "green");
	                		}
	                	}

	                });
	            }
	            else{
	              $('#email_error').html("**Incorrect email");
	              $('#email_error').show();
	              $('#email').css("border-color", "red");
	              error_email = true;
	            }
	        });
        }

        $('#regForm').submit(function(){
          error_fname = false;
          error_lname = false;
          error_phone = false;
          error_password = false;
          error_email = false;
          error_staffId = false;

          check_fname();
          check_lname();
          check_phone();
          check_password();
          check_email();
          check_staffId();


          if(error_fname === false && error_lname === false && error_phone === false && error_email === false && error_password === false && error_staffId === false){
              alert("Registration Successfully");
              return true;
          }
          else{
              alert("Please fill the field Correctly");
              return false;
          }
        });
    });
  </script>
	</body>
</html>
<?php
//Delete
if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$sqldelete = "DELETE FROM tutor WHERE id=$id";
	$result_delete = mysqli_query($db, $sqldelete);
	if($result_delete){
		echo '<script>window.location.href="tutor_reg.php"</script>';
	}
	else{
	echo '<script>alert("Data not deleted, Ensure to delete every data related to this User")</script>';	
	}
}
?>