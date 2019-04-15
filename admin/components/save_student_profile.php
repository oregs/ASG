<?php
// Update
require_once 'connect.php';
session_start();
$id = intval($_SESSION['id']);

if(isset($_POST['save_student_profile']))
	{
		 $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		 $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		 $matricNum = mysqli_real_escape_string($db, $_POST['matricNum']);
		 $phone = mysqli_real_escape_string($db, $_POST['phone']);
		 $email = mysqli_real_escape_string($db, $_POST['email']);
		 $level = mysqli_real_escape_string($db, $_POST['level']);
		 $sqlupdate = $db->query("UPDATE student SET email='$email', student_firstname='$firstname', student_lastname='$lastname', phone='$phone', level_id=$level WHERE id=$id");
		 header("Location: ../student.php");
	}
?>