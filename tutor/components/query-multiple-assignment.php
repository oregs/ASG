<?php
session_start();
require_once 'connect.php';
// die(var_dump($_POST['question']));
// if(isset($_POST['multiple_ass']))
// {
    if(!empty($_POST['question']) && !empty($_POST['score']) && !empty($_POST['submission_date']) && !empty($_POST['submission_time']) && !empty($_POST['course_code']))
      {
        //converting an array of string (i.e number in string) to integer and encoding it in Json
        $scoreArray = json_encode(array_map('intval', $_POST['score'])); 
        $questionArray = json_encode($_POST['question']);
        $score = array_sum(json_decode($scoreArray));
      	$tutor = intval($_SESSION['tutor_id']);
      	$course_code = $_POST['course_code'];
      	$ass_details = $_POST['ass_details'];
      	$date = $_POST['submission_date'];
        $time = $_POST['submission_time'];
        $assignedDay = date("Y-m-d h:i:sa");
        $submission = $date . ' ' . $time;
        $type = 'multiple';
        $format = $_POST['format'];

      if($_POST['format'] == 'individual'){
        $q_assignment = $db->query("INSERT INTO `assignmentdetail`(`ass_details`, `courseCode`, `sub_question`, `assign_date`, `submission_date`, `type`, `format`, `sub_score`, `score`, `tutor_id`) VALUES('$ass_details', '$course_code', '$questionArray', '$assignedDay', '$submission', '$type', '$format', '$scoreArray', '$score', '$tutor')");
        if($q_assignment)
        {
        	echo '<script> window.location.href = "../assignment.php"
                          alert("Assignment saved successfully")
                    </script>';
        }
        
      }
      else
      {
        $group = intval($_POST['group']);
        $q_assignment = $db->query("INSERT INTO `assignmentdetail`(`ass_details`, `courseCode`, `sub_question`, `assign_date`, `submission_date`, `type`, `format`, `sub_score`, `score`, `group_id`, `tutor_id`) VALUES('$ass_details', '$course_code', '$questionArray', '$assignedDay', '$submission', '$type', '$format', '$scoreArray', '$score', '$group', '$tutor')");
        if($q_assignment)
        {
          echo '<script> window.location.href = "../assignment.php"
                          alert("Assignment saved successfully")
                    </script>';
        }
      }
    }
// }

?>