<?php 
// Delete.php
require_once '../connect.php';
session_start();

// die(var_dump($_REQUEST["enrolledID"]));
if(isset($_REQUEST["enrolledID"]))
{

	$student = intval($_SESSION['user_id']);
	$query = $db->query("DELETE FROM courseenroll WHERE student=$student AND id=".$_REQUEST["enrolledID"]."");
	header("location: ../view_enroll_course.php");
}
?>