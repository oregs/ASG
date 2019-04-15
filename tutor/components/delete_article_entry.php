<?php 
// Delete.php
require_once 'connect.php';
session_start();

if(isset($_REQUEST["articleID"]))
{
	$tutor_id = intval($_SESSION['tutor_id']);
	$query = $db->query("DELETE FROM article_entry WHERE tutor_id=$tutor_id AND article_id=".$_REQUEST["articleID"]."");
	header("location: ../article_entry.php");
}
?>