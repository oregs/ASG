<?php
require_once 'connect.php';
	session_start();
	if(!ISSET($_SESSION['asg_tutorId'])){
		header('location: index.php');
	}
?>