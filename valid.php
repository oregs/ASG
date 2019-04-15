<?php
	require_once 'connect.php';
	session_start();
	if(!ISSET($_SESSION['matricNum'])){
		header('location: index.php');
	}

	$student = intval($_SESSION['user_id']);
?>