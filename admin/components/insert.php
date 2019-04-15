<?php
require_once 'connect.php';

if(isset($_POST["courseName"], $_POST["courseCode"], $_POST["courseUnit"], $_POST["level"]))
{
	$courseCode = strtoupper(mysqli_real_escape_string($db, $_POST["courseCode"]));
	$courseName = mysqli_real_escape_string($db, $_POST["courseName"]);
	$courseUnit = mysqli_real_escape_string($db, $_POST["courseUnit"]);
	$level = mysqli_real_escape_string($db, $_POST["level"]);
	$query = "INSERT INTO course(courseCode, courseName, courseUnit, level) VALUES('$courseCode', '$courseName', '$courseUnit', '$level')";
	if(mysqli_query($db, $query))
	{
		echo 'data inserted';
	}
}

?>