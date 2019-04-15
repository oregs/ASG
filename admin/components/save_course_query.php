<?php 
require_once 'connect.php';
session_start();
$id = intval($_SESSION['id']);
if(ISSET($_POST['course']))
{
	$course = array_map('intval', $_POST['course']);
	foreach ($course as $value) {
		$insert_course = $db->query("INSERT INTO courseassign(tutor, course) VALUES($id, $value)");
	}
		if ($insert_course)
		{
			echo 'done';
		}		
}
?>