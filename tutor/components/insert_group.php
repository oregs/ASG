<?php
require_once 'connect.php';
session_start();
// die(var_dump($_POST['student']));
if(isset($_POST['course']))
{
	$querycourse = $db->query("SELECT courseCode FROM course WHERE courseID=".$_POST['course']."");
	$result = $querycourse->fetch_assoc();
	$courseCode = $result['courseCode'];

	$tutor_id = intval($_SESSION['tutor_id']);
	$course_id = intval($_POST['course']);
	$group_student = $_POST['student'];
	// $group_name = $_POST['group_name'];
	$group_name = str_replace(' ', '_', $_POST['group_name'].'('.$courseCode.')');

if(!empty($group_name))
{

	$s_group = $db->query("SELECT * FROM group_assignment WHERE group_name='$group_name' AND tutor_id=$tutor_id");
	
	$rowcheck = $s_group->num_rows;
	if($rowcheck > 0)
	{
		while ($result=$s_group->fetch_assoc()) 
		{
			$group_id = $result['group_id'];
		}
		//Array Filter: Verifying if there is data in the array
		$array_check = array_filter($_POST['student']);
		if(!empty($array_check) AND !empty($course_id) AND !empty($group_id))
		{
			foreach ($group_student as $value) 
			{
				$q_groupMember = $db->query("INSERT INTO group_member(group_id,course_id,student_id) VALUES ($group_id, $course_id, $value)");
								
				if($q_groupMember)
				{
					echo 'done';
				}
			}
		}
	}
	else
	{
		$group = $db->query("INSERT INTO group_assignment(course_code,group_name,tutor_id) VALUES ((SELECT courseCode FROM course WHERE courseID=$course_id),'$group_name', $tutor_id)");
		// die(var_dump($group));
		$group_id = mysqli_insert_id($db);
		$array_check = array_filter($_POST['student']);
		if(!empty($array_check) AND !empty($course_id) AND !empty($group_id))
		{
			foreach ($group_student as $value) 
			{
				$q_groupMember = $db->query("INSERT INTO group_member(group_id,course_id,student_id) VALUES ($group_id, $course_id, $value)");
								
				if($q_groupMember)
				{
					echo 'done';
				}
			}
		}
	}
	}
}
?>