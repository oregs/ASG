<?php 
session_start();
require_once '../connect.php';
// Student log in credential
if (!empty($_POST['matricno']) && !empty($_POST['pass'])) {
	// die(var_dump($_POST['matricno'], $_POST['pass']));

	$matricNum = $_POST['matricno'];
	$password = $_POST['pass'];

	$password = md5($password); //encrypt password before comparing with that from database 
	$query = "SELECT * FROM student WHERE matricNum='$matricNum' AND password='$password' LIMIT 1";
	$result = mysqli_query($db, $query);
	if (mysqli_num_rows($result) == 1) {
		// log user in
		foreach ($result as $key => $value) {
			$_SESSION['user_id'] = intval($value['id']);
			$_SESSION['level'] = intval($value['level_id']);
			// die(var_dump($_SESSION['level'], $_SESSION['user_id']));
		}
		$_SESSION['matricNum'] = $matricNum;
		$_SESSION['success'] = 'You are now logged in';

		echo "success";
		// header('location:studentmodule.php'); // redirect to homepage
	}
	else
	{
		echo "fail";
	}
	exit();
}

?>