<?php 
// Delete.php
require_once 'connect.php';
// die(var_dump($_POST["courseID"]));
if(isset($_POST["courseID"]))
{
	$query = "DELETE FROM course WHERE courseID = '".$_POST["courseID"]."'";
	if(mysqli_query($db, $query))
	{
		echo 'Data Deleted';
	}
}
?>