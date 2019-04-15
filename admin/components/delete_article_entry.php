<?php 
// Delete.php
require_once 'connect.php';

if(isset($_REQUEST["articleID"]))
{
	$query = $db->query("DELETE FROM article_entry WHERE article_id=".$_REQUEST["articleID"]."");
	header("location: ../article_entry.php");
}
?>