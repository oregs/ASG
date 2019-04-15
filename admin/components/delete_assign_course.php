<?php 
// Delete.php
require_once 'connect.php';

if(isset($_REQUEST["assignID"]))
{
	$query = $db->query("DELETE FROM courseassign WHERE id=".$_REQUEST["assignID"]."");
	header("location: ../tutor_reg.php");
}
?>