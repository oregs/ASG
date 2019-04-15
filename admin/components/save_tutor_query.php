<?php
require_once 'connect.php';

if(ISSET($_POST['save_tutor'])){
		
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$staffId = $_POST['staffId'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	// $courses = $_POST['courses'];
	$password = md5($_POST['password']);
	$name = $firstname . ' ' . $lastname;
	$sqlsave = $db->query("SELECT * FROM `tutor` WHERE `staffId`='$staffId'") or die(mysqli_error());
	$result_save = $sqlsave->num_rows;
	if($result_save == 1){
		echo '
			<script type = "text/javascript">
				alert("Staff ID already taken");
				window.location = "../tutor_reg.php";
			</script>
		';
	}else{
		$db->query("INSERT INTO tutor(staffId, tutor_fname, tutor_lname, tutor_phone, tutor_email, password) VALUES('$staffId', '$firstname', '$lastname', '$phone', '$email', '$password')") or die(mysqli_error());
		echo '
			<script type = "text/javascript">
				alert("Successfully saved data");
				window.location = "../tutor_reg.php";
			</script>
		';
	}
}
?>