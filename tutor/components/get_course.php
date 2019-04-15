<?php

require_once 'connect.php';
if(isset($_POST['action']))
{
	$output = '';
	if($_POST['action'] == 'course')
	{
		$courseMember = intval($_POST["query"]);
		$q_getcourse = $db->query("SELECT * FROM courseenroll e, course c, student s WHERE course=$courseMember AND e.course=c.courseID AND s.id=e.student ORDER BY courseCode");
		
		// $output = '<option disabled="disabled">Select student</option>';
		while ($row=$q_getcourse->fetch_assoc()) 
		{
			$student_name = $row['student_firstname'].' '.$row['student_lastname'];
			$output .= '<option value="'.$row["student"].'">'.$student_name.'</option>';
		}
		echo $output;
	}
}
?>