<?php

require_once 'connect.php';
session_start();
$course_code = $_POST["query"];
$tutor = intval($_SESSION['tutor_id']);
if(isset($_POST['action']))
{
	$output = '';
	if($_POST['action'] == 'course_code')
	{
		$course_code = $_POST["query"];
		
		$q_getgroup = $db->query("SELECT * FROM group_assignment WHERE course_code='$course_code' AND tutor_id=$tutor ORDER BY group_name");

		$output = '<option disabled="disabled" selected="selected">--Select student--</option>';
		while ($row=$q_getgroup->fetch_assoc()) 
		{
			$group_name = $row['group_name'];
			$output .= '<option value="'.$row["group_id"].'">'.str_replace("_", " ", $group_name).'</option>';

		}
		echo $output;
	}
}