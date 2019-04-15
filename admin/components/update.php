<?php
//update.php
require_once 'connect.php';
if(isset($_POST["courseID"]))
{

	$value = mysqli_real_escape_string($db, $_POST["value"]);
	$query = "UPDATE course SET ".$_POST["column_name"]."='".$value."' WHERE courseID = '".$_POST["courseID"]."'";
	
	if(mysqli_query($db, $query))
	{
		echo 'Data Updated';
	}
}
?>