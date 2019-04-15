<?php
	require_once 'connect.php';
	session_start();
	if(!ISSET($_SESSION['asg_admin'])){
		header('location:../admin/index.php');
	}
?>