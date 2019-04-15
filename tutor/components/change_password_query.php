<?php
require_once 'connect.php';
session_start();

$tutor = intval($_SESSION['tutor_id']);

if(isset($_POST['change'])){

	if(!empty($_POST['userpass']) && !empty($_POST['cpass'])){
		$userpass = md5(mysqli_real_escape_string($db, $_POST['userpass']));
		$cpass = md5(mysqli_real_escape_string($db, $_POST['cpass']));
		//Mysqli to query the database (comparing Post with Database Password).
		$q_password = $db->query("SELECT password FROM tutor WHERE id=$tutor");
		$rowcount = $q_password->num_rows;

		$fetch = $q_password->fetch_assoc();
		$password = $fetch['password'];

		if($rowcount > 0){
			if($password === $userpass){
				$q_newpass = $db->query("UPDATE tutor SET password='$cpass' WHERE id=$tutor");
				// die(var_dump($q_newpass));
				if($q_newpass){
					echo "success";
				}
			}
		}
		else
		{
			echo 'failed';
		}
	}
}
?>