<?php 
// Delete.php
require_once 'connect.php';

if(isset($_REQUEST["enrollID"]))
{
	$query = $db->query("DELETE FROM courseenroll WHERE id=".$_REQUEST["enrollID"]."");
	header("location: ../student.php");
}
?>