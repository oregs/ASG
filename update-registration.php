<?php 
session_start();
$matricNum = $_SESSION['matricNum'] 
// = $_GET['matricNum'];
?>
<html lang = "eng">
<?php include 'controllers/base/head.php' ?>

<body style="background:#d0cfce;">
<nav class="navbar navbar-default navbar-fixed-top">
        <div class = "container-fluid">
            <div class="container">
                <div class = "navbar-header">
                    <img src = "images/logo.gif" width = "50px" height = "50px" />
                    <h4 class = "navbar-text navbar-right">ASG System</h4>
                </div>                      
            </div>
        </div>
</nav><br><br>
        <div class="container-fluid">
            <div class="no-gutter row">             
                <div class="col-md-12">
                     <center><h2 style="color:blue;">Fill Up the details below to Continue</h2></center>
              	     <div class="panel panel-default" id="sidebar">
                        <div class="panel-body">

<?php include 'controllers/form/update-registration.php' ?>
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
</script>
  <script type="text/javascript">
    $(function(){
        $('#fname_error').hide();
        $('#lname_error').hide();
        $('#phone_error').hide();
        $('#file_error').hide();

        var error_fname = false;
        var error_lname = false;
        var error_phone = false;
        var error_file = false;
        
        $('#stud_fname').focusout(function(){
            check_fname();
        });
        $('#stud_lname').focusout(function(){
            check_lname();
        });
        $('#phone').focusout(function(){
            check_phone();
        });
        $('#ImageFile').focusout(function(){
             check_file();
        });

        function check_fname(){
            var firstname_pattern = /^[a-zA-Z]*$/;
            var firstname = $('#stud_fname').val();
            if(firstname_pattern.test(firstname) && firstname !== ""){
                $('#fname_error').hide();
                $('#stud_fname').css("border-color", "green");
            }
            else{
              $('#fname_error').html("**Should contain only Characters");
              $('#fname_error').show();
              $('#stud_fname').css("border-color", "red");
              error_fname = true;
            }
        }

        function check_lname(){
            var lastname_pattern = /^[a-zA-Z]*$/;
            var lastname = $('#stud_lname').val();
            if(lastname_pattern.test(lastname) && lastname !== ""){
                $('#lname_error').hide();
                $('#stud_lname').css("border-color", "green");
            }
            else{
                $('#lname_error').html("**Should contain only Characters");
                $('#lname_error').show();
                $('#stud_lname').css("border-color", "red");
                error_lname = true;
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
              $('#phone_error').html("**Should contain only Numeric");
              $('#phone_error').show();
              $('#phone').css("border-color", "red");
              error_phone = true;
            }
        }

        function check_file(){
            var file = $("#ImageFile").prop('files')[0];

            if(file !== ""){
                $('#file_error').hide();
                $('#ImageFile').css("border-color", "green");
            }
            else{
              $('#file_error').html("**Password doesn't match");
              $('#file_error').show();
              $('#ImageFile').css("border-color", "red");
              error_file = true;
            }
        }

        $('#UploadForm').submit(function(){
          error_fname = false;
          error_lname = false;
          error_phone = false;
          error_file = false;

          check_fname();
          check_lname();
          check_phone();
          check_file();

          if(error_fname === false && error_lname === false && error_phone === false && error_file === false){
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