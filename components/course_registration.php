<?php
require_once '../connect.php';
session_start();

if(isset($_POST['register'])){

	$student = intval($_SESSION['user_id']);
	$courseID = intval($_POST['courseID']);

	$result_register = mysqli_query($db, "SELECT * FROM courseenroll WHERE course = $courseID AND student=$student");
	if(mysqli_num_rows($result_register) < 1)
	{
		$sqlregister = "INSERT INTO courseenroll (student, course) VALUES ((SELECT id FROM student WHERE id = $student), (SELECT courseID FROM course WHERE courseID = $courseID))";
		$store = mysqli_query($db, $sqlregister);
		if($store)
		{
			echo "success";
		}
	}
	else
	{
		echo "registered";
	} 
}
?>