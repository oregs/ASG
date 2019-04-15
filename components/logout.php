<?php
// logout
session_start();
if(isset($_SESSION['matricNum'])){
	unset($_SESSION['matricNum']);
	header('location: ../index.php');
}
elseif (isset($_SESSION['staffId'])) {
	unset($_SESSION['staffId']);
	header('location: ../index.php');
}
?>