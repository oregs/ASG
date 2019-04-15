<?php
// logout
session_start();
if(isset($_SESSION['asg_admin'])){
	unset($_SESSION['asg_admin']);
	header('location: ../index.php');
}
?>