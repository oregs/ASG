<?php
session_start();
//insert.php
// die(var_dump($_POST));
if(isset($_POST["subject"]))
{
	include("connect.php");
	$tutor = intval($_SESSION['tutor_id']);
	$subject = mysqli_real_escape_string($conn, $_POST["subject"]);
 	$comment = mysqli_real_escape_string($conn, $_POST["comment"]);
 	$level = $_POST["level"];
 	// die(var_dump($tutor,$subject,$comment,$level));
 	$query = "INSERT INTO comments(comment_subject, comment_text, tutor_id, level_id) VALUES ('$subject', '$comment', (SELECT id from tutor WHERE id ='$tutor'), '$level')";
 	// die(var_dump($query));
 	mysqli_query($conn, $query);
 }
?>