<?php
require_once '../../components/connect.php';
session_start();
//Creating session for tutor
$_SESSION['id'] = $_REQUEST['id'];

	$q_tutor = $db->query("SELECT * FROM tutor WHERE id=".$_REQUEST['id']."");
	$rowcount = $q_tutor->num_rows;
	if($rowcount > 0){
	while ($result=$q_tutor->fetch_assoc()) {
		$firstname = $result['tutor_fname'];
		$lastname = $result['tutor_lname'];
		$name = $result['tutor_lname'].' '.$result['tutor_fname'];
		$phone = $result['tutor_phone'];
		$email = $result['tutor_email'];
		$avatar = $result['tutor_avatar'];
		$gender = $result['tutor_gender'];
		$staffID = $result['staffId'];
		$address = $result['tutor_address'];
	}
}
?>
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Lecturer Information</h4>
	</div>
		<div class="modal-body">
			<div class="box-body">
	<ul class="nav nav-tabs">
      <li class="active"><a href="#personal" data-toggle="tab">Profile</a></li>
      <li><a href="#general" data-toggle="tab">Edit</a></li>
      <li><a href="#change" data-toggle="tab">Change Password</a></li>
    </ul>
    <div class="tab-content">
    	 <div class="tab-pane fade in active" id="personal">
			<div class="row"><br>
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="../userfiles/avatars/<?php echo $avatar ?>" class="img-circle img-responsive"> </div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Full Name:</td>
                        <td><?php echo $name ?></td>
                      </tr>
                      <tr>
                        <td>Staff ID:</td>
                        <td><?php echo $staffID ?></td>
                      </tr>
                   
                    <tr>
                      <tr>
                        <td>Gender</td>
                        <td><?php echo $gender ?></td>
                      </tr>
                       <tr>
                        <td>Home Address</td>
                        <td><?php echo $address ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></td>
                      </tr>
                        <td>Phone Number</td>
                        <td><?php echo $phone ?></td> 
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
        	</div>
        	<div class="tab-pane fade" id="general">
        		<div class="row col-sm-offset-2"> 
        		<div class = "col-lg-10">
        		<form method="POST" action="../admin/components/save_tutor_profile.php">
        			<div class = "form-group">  
                  		<label>Firstname:</label>
                  		<input type = "text" placeholder="<?php echo $firstname ?>" name = "firstname" value="<?php echo $firstname ?>" class="form-control" />
                	</div>
                	<div class = "form-group">  
                  <label>Lastname:</label>
                  <input type="text" placeholder="<?php echo $lastname ?>" value="<?php echo $lastname ?>" name = "lastname" class = "form-control" />
                </div>
                <div class = "form-group">
                  <label>Staff ID:</label>
                  <input type = "text" placeholder="<?php echo $staffID ?>" value="<?php echo $staffID ?>" name = "staffId" class = "form-control" />
                </div> 
                <div class = "form-group">  
                  <label>Phone:</label>
                  <input type = "text" placeholder="<?php echo $phone ?>" value="<?php echo $phone ?>" name = "phone" class = "form-control" />
                </div>  
                <div class = "form-group">  
                  <label>Email:</label>
                  <input type = "text" placeholder="<?php echo $email ?>" value="<?php echo $email ?>" name = "email" class = "form-control" />
                </div>                
                  
                  <button type="submit" class ="btn btn-primary" id="add" name="save_profile"><span class="glyphicon glyphicon-save"></span>Save</button>
                
        		</form>
        		</div>
        	</div>
			</div>
      <div class="tab-pane fade" id="change">
            <div class="row col-sm-offset-2"> 
            <div class = "col-lg-10">
              <form method="POST" id="changeData" onsubmit="return change_password();">
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
                  <button type="submit" class ="btn btn-primary" id="changepass" name="changepass"><span class="glyphicon glyphicon-save"></span>Save</button>
            </form>
            </div>
          </div>
      </div>
		</div>
		</div>
	</div>
<div class="modal-footer">
	<a href="../admin/tutor_reg.php"><button type="button" class="btn btn-danger">Cancel</button></a>
</div>
</div>
<script type="text/javascript">
//Student Login Validation
  function change_password(){
    var newpass = $('#newpass').val();
    var cpass = $('#cpass').val();

    
    if(newpass === ''){
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
        data:{change:"Change password", cpass:cpass},
        success:function(response){
          if(response == "success"){
            $('#changeData')[0].reset();
            swal({
                title: "Password Changed Successfully!!!",
                icon: "success",
                button: "ok",
          }).then(function(){
            window.location="tutor_reg.php";
            });
          }
          else{
            $('#display_error').html("**Password not match!!!");
            $('#display_msg').show();
            $('#newpass_error').html("");
            $('#cpass_error').html("");
            $('#newpass').css("border-color", "#A94442");
            $('#cpass').css("border-color", "#A94442");
          }
        }
      });
    }
    return false;
  }
  </script>
