<?php
require_once 'connect.php';

if(ISSET($_POST['save_student'])){
		
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$matricNum = $_POST['matricNum'];
	$level = $_POST['level'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sqlsave = $db->query("SELECT * FROM `student` WHERE `matricNum`='$matricNum'") or die(mysqli_error());
	$result_save = $sqlsave->num_rows;
	if($result_save == 1){
		echo '
			<script type = "text/javascript">
				alert("Matric Number already taken");
				window.location = "../student.php";
			</script>
		';
	}else{
		
		$db->query("INSERT INTO `student`(`email`, `matricNum`, `password`, `student_firstname`, `student_lastname`, `phone`, `level_id`) VALUES('$email', '$matricNum', '$password', '$firstname', '$lastname', '$phone', '$level')") or die(mysqli_error());
		header('location: ../student.php');
	}
}
?>