<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>  
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<title>OAS</title><link rel="stylesheet" type="text/css" href="../css/loginxs.css" />
 </script>

<!-- style Sheet -->
<style type="text/css">
  body {
    background:  url(../images/back.jpg) no-repeat;
    background-size: 100%;
    overflow: hidden;
}
.jumbotron {
  background: rgba(204, 204, 204, 0.5);
}
.jumbotron h1 {
  font-size: 40px;
}
.input-group-addon{
  padding-bottom: 0px;
}
</style>

<body>

<div class="jumbotron" id="change" style="">
  <div><center><img src="../images/ASG-logo1.png" width="100px" height="100px" /></center></div>
      <div class="container">
      <h1 align="center" style="color:white;">Assignment Submission & Grading System</h1>
      </div>
 </div><!-- End of Main Jumbotron-->  

<div class="login-page">
  <div class="form" style=" background: rgba(204, 204, 204, 0.5);">
    <form class="login-form" method="post" id="loginData" onsubmit="return admin_login();">
      <!-- Invalid error msg display here -->
      <div class="form-group" id="display_msg" style="display:none;">
          <div class="error">
              <span class="text-danger font-weight-bold" id="display_error"></span>
          </div>
      </div>
      <div>
      <input type="text" name="asg_admin" id="adminID" class="form-control" placeholder="Admin ID" />
      <span class="text-danger font-weight-bold" id="adminID_error"></span>
    </div>
    <div>
      <input type="password" name="asg_pass" placeholder="Password" id="adminPass" class="form-control" />
      <span class="text-danger font-weight-bold" id="adminPass_error"></span>
    </div><br>
      <button type="submit" name="submit">login</button> 
    </form>
  </div>
</div>
</form>
</div>
</div>
</div>

<nav class = "navbar navbar-default navbar-fixed-bottom navbar-inverse">
      <div class = "container-fluid">
        <label class = "navbar-text pull-right">Assignment Submission & Grading System &copy; All rights reserved 2018</label>
      </div>
    </nav>



</div>
  <script src="../js/bootstrap_show_password.js"></script>
  <script type="text/javascript">
  $("#password").password('toggle');
</script>
<script type="text/javascript">
    //Lecturer Login validation
   function admin_login(){
    var adminID = $('#adminID').val();
    var adminPass = $('#adminPass').val();

    if(adminID === ''){
      $('#adminID_error').html("**Please enter your Admin ID!!!");
      $('#adminID').css("border-color", "red");
      return false;
    }
    else if(adminPass === ''){
      $('#adminPass_error').html("**Please enter your Password!!!");
      $('#adminPass').css("border-color", "red");
      return false;
    }
    else{
      $.ajax({
        url:'components/server.php',
        type:"POST",
        data:{confirm:'access', adminID:adminID, adminPass:adminPass},
        success:function(response){
          if(response == "success"){
            window.location.href="dashboard.php";
          }
          else{
            $('#display_error').html("**Invalid Admin ID or Password");
            $('#display_msg').show();
            $('#adminID_error').html("");
            $('#adminId').css("border-color", "#A94442");
            $('#adminPass_error').html("");
            $('#adminPass').css("border-color", "#A94442");
          }
        }
      });
    }
    return false;
  }
  </script>
</body>
</html>



