<?php
require_once 'connect.php';
session_start();

$student = intval($_SESSION['id']);
// die(var_dump($student, $_POST['cpass']));
if(isset($_POST['change'])){

	if(!empty($_POST['cpass'])){
		$cpass = md5(mysqli_real_escape_string($db, $_POST['cpass']));
		
		$q_newpass = $db->query("UPDATE student SET password='$cpass' WHERE id=$student");
		if($q_newpass){
			echo "success";
		}
	}
}
?>