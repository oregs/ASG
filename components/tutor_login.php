<?php 
// Tutor Log in credential
require_once '../connect.php';
session_start();

if(!empty($_POST['staffId']) && !empty($_POST['tutorPass'])) {
	$staffId = $_POST['staffId'];
	$password = md5($_POST['tutorPass']);
// print_r($staffId);
// die();
	$query = "SELECT * FROM tutor WHERE staffId='$staffId' AND password='$password'";
	$result = mysqli_query($db, $query);
	if (mysqli_num_rows($result) == 1) {
		// log user in
		foreach ($result as $key => $value) {
			$_SESSION['tutor_id'] = intval($value['id']);
			// die(var_dump($_SESSION['tutor_id']));
		}
		$_SESSION['staffId'] = $staffId;
		$_SESSION['success'] = 'You are now logged in';
		
		echo "success";
	}
	else{
		echo "fail";
	}
	exit();
}
?>