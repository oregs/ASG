<?php
	require_once 'connect.php';
	session_start();
	if(!ISSET($_SESSION['staffId'])){
		header('location:../index.php');
	}
?>