<?php
//update.php
require_once 'connect.php';
if(isset($_POST["id"]))
{
	$value = mysqli_real_escape_string($db, intval($_POST["value"]));
	$query = "UPDATE assignmentresult SET ".$_POST["column_name"]."=$value WHERE id =".intval($_POST["id"])."";
	if(mysqli_query($db, $query))
	{
		echo 'Data Updated';
	}
}
?>