<?php
require_once 'connect.php';
// Starting a sesssion variable
session_start();

if (isset($_POST['confirm'])) {
	
	$asg_admin = mysqli_real_escape_string($db, $_POST['adminID']);
	$asg_pass = md5(mysqli_real_escape_string($db, $_POST['adminPass']));

	if(!empty($asg_admin) && !empty($asg_pass)) {
		$query = $db->query("SELECT * FROM admin WHERE username='$asg_admin' AND password='$asg_pass'");

		if (mysqli_num_rows($query) > 0) {
			// log user in
			foreach ($query as $key => $value) {
				$_SESSION['asg_id'] = intval($value['admin_id']);
				// die(var_dump($_SESSION['tutor_id']));
			}
			$_SESSION['asg_admin'] = $asg_admin;
			echo "success";
		}
		else{
			echo '<script>alert("Wrong password")</script>';
		}
	}
}
?>