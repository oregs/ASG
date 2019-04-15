<?php

require_once 'connect.php';

if(isset($_POST['action']))
{
	if($_POST['action'] == 'check' && !empty($_POST["staffId"]))
	{
		$staffId = $_POST["staffId"];
		$q_staffId = $db->query("SELECT * FROM tutor WHERE staffId='$staffId'");
		$rowcount = $q_staffId->num_rows;
		if ($rowcount > 0) {
			echo 'exist';
		}
		else
		{
			echo 'Not exist';
		}
		exit();
	}
}


if($_POST['email_check'] == 'verify' && !empty($_POST["email"]))
	{
		$email = $_POST["email"];
		$q_email = $db->query("SELECT * FROM tutor WHERE tutor_email='$email'");
		$row = $q_email->num_rows;
		
		if ($row > 0) {
			echo 'exist';
		}
		else
		{
			echo 'Not exist';
		}
		exit();
	}

?>