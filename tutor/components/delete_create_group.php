<?php 
// Delete.php
require 'connect.php';
// die(var_dump($_POST["id"]));
if(isset($_POST["id"]))
{
	$query = "DELETE FROM group_assignment WHERE group_id = '".$_POST["id"]."'";
	if(mysqli_query($db, $query))
	{
		echo 'Data Deleted';
	}
	else
	{
		echo 'Ensure that Student assigned to this group are Deleted.';
	}
}
?>