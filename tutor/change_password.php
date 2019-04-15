<?php include 'components/authenticate.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>  
<body style = "background-color:#F8F8F8;">   
              <!-- Navigation Bar -->
                <?php include 'navigation.php'; ?>                    
            
<div class = "container-fluid">
<?php include 'sidebar.php'; ?>

<div class = "col-lg-10 well" style = "margin-top:60px;">   
    <div class="container">
      <div class="row">
        <div class="col-md-9">
            <h1 class="page-head-line" style="color:#337AB7;">Change Password </h1>
        </div>
      </div>
        <div class="row" >
          <div class="col-md-6"></div>
            <div class="col-md-10">
                <div class="panel panel-default">
                <div class="panel-heading">
                   Change Password
                </div>
                  <div class="panel-body">
                    <form name="changeData" id="changeData" method="post" onsubmit="return change_password();">
                      <div class="form-group" id="display_msg" style="display:none;">
                        <div class="error">
                          <span class="text-danger font-weight-bold" id="display_error"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="userpass">Current Password</label>
                        <input type="password" class="form-control" id="userpass" name="userpass" placeholder="Password" />
                        <span class="text-danger font-weight-bold" id="userpass_error"></span>
                      </div>
                      <div class="form-group">
                        <label for="newpass">New Password</label>
                        <input type="password" class="form-control" id="newpass" name="newpass" placeholder="Password" />
                        <span class="text-danger font-weight-bold" id="newpass_error"></span>
                      </div>
                      <div class="form-group">
                        <label for="cpass">Confirm Password</label>
                        <input type="password" class="form-control" id="cpass" name="cpass" placeholder="Password" />
                        <span class="text-danger font-weight-bold" id="cpass_error"></span>
                      </div>
 
                      <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                      <hr />
                    </form>
                  </div>
                </div>
              </div>     
            </div>
          </div>
        </div>
</div>
    <nav class = "navbar navbar-default navbar-fixed-bottom">
      <div class = "container-fluid">
          <label class = "navbar-text pull-right">Assignment Submission & Grading System &copy; All rights reserved 2018</label>
      </div>
    </nav>
<script src = "../js/popper.min.js"></script>
<script src = "../js/sweetalert.js"></script>
<script src = "../js/sidebar.js"></script>
<!-- Username Checking -->
    <script type="text/javascript">

//Student Login Validation
  function change_password(){
    var userpass = $('#userpass').val();
    var newpass = $('#newpass').val();
    var cpass = $('#cpass').val();

    if(userpass === ''){
      $('#userpass_error').html("**Please enter your Current Password!!!");
      $('#userpass').css("border-color", "red");
      return false;
    }
    else if(newpass === ''){
      $('#newpass_error').html("**Please enter your New Password!!!");
      $('#newpass').css("border-color", "red");
      return false;
    }
    else if(newpass !== cpass ){
      $('#cpass_error').html("**Password not match!!!");
      $('#cpass').css("border-color", "red");
      return false;
    }
    else{
      $.ajax({
        url:'components/change_password_query.php',
        type:"POST",
        data:{change:"Change password", userpass:userpass, cpass:cpass},
        success:function(response){
          if(response == "success"){
            $('#changeData')[0].reset();
            swal({
                title: "Password Changed Successfully!!!",
                text: "Logout to effect the change...",
                icon: "success",
                button: "ok",
          }).then(function(){
            window.location="tutormodule.php";
            });
          }
          else{
            $('#display_error').html("**Password not match!!!");
            $('#display_msg').show();
            $('#newpass_error').html("");
            $('#cpass_error').html("");
            $('#userpass_error').html("");
            $('#newpass').css("border-color", "#A94442");
            $('#cpass').css("border-color", "#A94442");
            $('#userpass').css("border-color", "#A94442");
          }
        }
      });
    }
    return false;
  }
  </script>
</body>