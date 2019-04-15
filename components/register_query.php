<?php
require_once '../connect.php';
session_start();
// die(var_dump($_POST['matricNum']));
//if the registration button is clicked
if (isset($_POST['register'])) {
	$email = $_POST['email'];
	$matricNum = $_POST['matricNum'];
	$level = intval($_POST['level']);
	$password_1 = $_POST['password_1'];
	$password_2 = $_POST['password_2'];
	
		$password = md5($password_1); // encrypt password before storing into database (security)
		$sql = "INSERT INTO `student`(`email`, `matricNum`, `level_id`, `password`) VALUES ('$email', '$matricNum', $level, '$password')";
		// die(var_dump($sql));
		mysqli_query($db, $sql);
		$_SESSION['matricNum'] = $matricNum;
		header('location:../update-registration.php');
}

?>