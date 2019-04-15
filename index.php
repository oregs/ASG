
<?php require_once 'connect.php'; ?>
<html lang = "eng">
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href="css/login.css" />
    <link href="images/ASG-logo.png" rel="shortcut icon"/>
		<link rel = "stylesheet" type = "text/css" href="css/bootstrap.css" />
	</head>
<style type="text/css">
  body {
    background:  url(images/back.jpeg) no-repeat;
    background-size: 100%;
    overflow: hidden;

}
.jumbotron {
  background: rgba(204, 204, 204, 0.8);
}
</style>
<body style = "background-color:#F8F8F8;">
		
<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
	<div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav">
			<li ><img src = "images/ASG-logo.png" width = "50px" height = "50px" />
				<h4 class = "navbar-text navbar-right">ASG System</h4></li>
		</ul>
		<!-- Button trigger modal -->
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown"><a href="" data-toggle="modal" data-target="#modal-1"><span class="glyphicon glyphicon-log-in"></span> Student Login</a></li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Lecturer Login</a>
        <!-- Form to submit Lecturer Login credentials -->
				<div class="dropdown-menu" style="padding: 15px; padding-bottom: 10px;">
				<form method="post" class="form-horizontal" onsubmit="return lecturer_login();" id="tutorData">
          <!-- Display a login error -->
          <div class="form-group" id="display_msg" style="display:none;">
                <div class="error">
                    <span class="text-danger font-weight-bold" id="display_error"></span>
                </div>
            </div>
				  <input type="text" id="staffId" class="form-control login" name="staffId" placeholder="Username.." />
          <span class="text-danger font-weight-bold" id="staffID_error"></span>
				  <input id="tutorPass" class="form-control login" type="password" name="tutorPass" placeholder="Password.."/>
          <span class="text-danger font-weight-bold" id="tutorPass_error"></span>
				  <button type="submit" class="btn btn-primary btn-block" name="submit"><span class = "glyphicon glyphicon-save"></span> Login</button>
				</form>
				</div>
        <!-- End of Lecturer Form -->
			</li>
		</ul>	
	</div>	
	</div>
</nav>
		
<div class = "container-fluid" style = "margin-top:70px;">
	<div class="jumbotron" style="color:black;">
      	<h1 class="display-4" style="color:#286090;">Hello, welcome to Online Assignment Submission & Grading System !</h1>
	  		<p class="lead">The objective of this system is to
							facilitate interaction between lecturers and students for assessment and
							grading purposes.
			</p>
	  		<hr class="my-4" style="border-color:#286090;">
	  		<p>Login to submit your assignment and have a good experience of our online assignment submission
	  			system.
	  		</p>
		  	<p class="lead">
		    	<a data-toggle="modal" data-target="#modal-1" class="btn btn-primary btn-lg active"><span class="glyphicon glyphicon-user"></span> Login | Register</a>
		  	</p>
 	</div>
 	<div class="modal fade" id="modal-1">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Student Section</h4>
				</div>
				<div class="modal-body">
						  <div class="container-fluid" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;">
									<!-- Nav tabs -->
							<div class="col-lg-12">
									<ul class="nav nav-tabs" style="margin-bottom: 20px;">
										<li class="active"><a href="#Login" data-toggle="tab">Login</a></li>
										<li><a href="#Registration" data-toggle="tab">Registration</a></li>
									</ul>
									<!-- Tab panes -->
								   <div class="tab-content">
                    <!-- Student Login pane -->
										<?php include 'login.php' ?>
                    <!-- Student Registration pane -->
										<?php include 'register.php' ?>
								  </div>
							</div>
						</div>				 	  
				</div>	  
		</div>
	</div>
</div>
</div>
<nav class = "navbar navbar-default navbar-fixed-bottom">
	<div class = "container-fluid">
		<label class = "navbar-text pull-right">Assignment Submission and Grading System &copy; All rights reserved 2018</label>
	</div>
</nav>
<script src = "js/jquery-1.11.1.min.js"></script>
<script src = "js/popper.min.js"></script>
<script src = "js/bootstrap.js"></script>
<script src = "js/sweetalert.js"></script>
<script src = "js/login.js"></script>
<script type="text/javascript">

//Student Login Validation
  function student_login(){
    var matricno = $('#matricno').val();
    var pass = $('#pass').val();

    if(matricno === ''){
      $('#matric_error').html("**Please enter your Matric Number!!!");
      $('#matricno').css("border-color", "red");
      return false;
    }
    else if(pass === ''){
      $('#password_error').html("**Please enter your Password!!!");
      $('#pass').css("border-color", "red");
      return false;
    }
    else{
      $.ajax({
        url:'components/server.php',
        type:"POST",
        data:{matricno:matricno, pass:pass},
        success:function(response){
          if(response == "success"){
            window.location.href="studentmodule.php";
          }
          else{
            $('#msg_error').html("**Invalid Matric Number or Password");
            $('#show_msg').show();
            $('#matric_error').html("");
            $('#matricno').css("border-color", "#A94442");
            $('#password_error').html("");
            $('#pass').css("border-color", "#A94442");
          }
        }
      });
    }
    return false;
  }
  </script>

  <script type="text/javascript">
    //Lecturer Login validation
   function lecturer_login(){
    var staffId = $('#staffId').val();
    var tutorPass = $('#tutorPass').val();

    if(staffId === ''){
      $('#staffID_error').html("**Please enter your Staff ID!!!");
      $('#staffId').css("border-color", "red");
      return false;
    }
    else if(tutorPass === ''){
      $('#tutorPass_error').html("**Please enter your Password!!!");
      $('#tutorPass').css("border-color", "red");
      return false;
    }
    else{
      // alert(tutorPass);
      $.ajax({
        url:'components/tutor_login.php',
        type:"POST",
        data:{staffId:staffId, tutorPass:tutorPass},
        success:function(response){
          if(response == "success"){
            window.location.href="tutor/tutormodule.php";
          }
          else{
            $('#display_error').html("**Invalid Staff ID or Password");
            $('#display_msg').show();
            $('#staffID_error').html("");
            $('#staffId').css("border-color", "#A94442");
            $('#tutorPass_error').html("");
            $('#tutorPass').css("border-color", "#A94442");
          }
        }
      });
    }
    return false;
  }
  </script>

  <!-- Validating Form Registration -->
  <script type="text/javascript">
  	$(function(){
        $('#email_error').hide();
        $('#matricNum_error').hide();
        $('#password1_error').hide();
        $('#password2_error').hide();

        var error_email = false;
        var error_matricNum = false;
        var error_password1 = false;
        var error_password2 = false;
        
        $('#email').focusout(function(){
            check_email();
        });
        $('#matricNum').focusout(function(){
            check_matricNum();
        });
        $('#password_1').focusout(function(){
            check_password();
        });
        $('#password_2').focusout(function(){
             check_confirm_password();
        });

        function check_email(){
            var email_pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
            var email = $('#email').val();
            if(email_pattern.test(email) && email !== ""){
                $('#email_error').hide();
                $('#email').css("border-color", "green");
            }
            else{
              $('#email_error').html("**Incorrect email");
              $('#email_error').show();
              $('#email').css("border-color", "red");
              error_email = true;
            }
        }

        function check_matricNum(){
            var pattern = new RegExp(/^\d{2}\/\d{4}$/);
            var matricNum = $('#matricNum').val();
            if(pattern.test(matricNum) && matricNum !== ""){
                $('#matricNum_error').hide();
                $('#matricNum').css("border-color", "green");
            }
            else{
                $('#matricNum_error').html("**Invalid matric number");
                $('#matricNum_error').show();
                $('#matricNum').css("border-color", "red");
                error_matricNum = true;
            }
        }

        function check_password(){
            var password_1 = $('#password_1').val();
            if(password_1 !== ""){
                $('#password1_error').hide();
                $('#password_1').css("border-color", "green");
            }
            else{
              $('#password1_error').html("**Please fill the password field");
              $('#password1_error').show();
              $('#password_1').css("border-color", "red");
              error_password1 = true;
            }
        }

        function check_confirm_password(){
            var password_1 = $('#password_1').val();
            var password_2 = $('#password_2').val();
            if(password_2 !== "" && password_1 === password_2){
                $('#password2_error').hide();
                $('#password_2').css("border-color", "green");
            }
            else{
              $('#password2_error').html("**Password doesn't match");
              $('#password2_error').show();
              $('#password_2').css("border-color", "red");
              error_password2 = true;
            }
        }

        $('#regData').submit(function(){
          error_email = false;
          error_matricNum = false;
          error_password1 = false;
          error_password2 = false;

          check_email();
          check_matricNum();
          check_password();
          check_confirm_password();

          if(error_email === false && error_matricNum === false && error_password1 === false && error_password2 === false){
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