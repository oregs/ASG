<?php

session_start();
require_once 'connect.php';
//Requesting for the current (course_code, assignment_id, group_id and student_id,) 
$course_code = $_SESSION['course_code'];
$ass_id = intval($_SESSION['ass_id']);
$student_id = intval($_SESSION['student_id']);
$tutor_id = intval($_SESSION['tutor_id']);
$score_array = json_encode(array_map('intval', $_POST['score']));
$score = array_sum(array_map('intval', $_POST['score']));
// die(var_dump($score_array));
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (!empty(array_filter($_POST['score']))) 
    {
        $q_submission = $db->query("SELECT a.format, a.ass_details, a.course_code, a.assignment_id, s.matricNum, n.score FROM assignmentsubmission a, student s, assignmentdetail n WHERE `assignment_id`=$ass_id AND a.student_id=s.id AND n.id=$ass_id AND s.id=$student_id");
            $r_submission = $q_submission->fetch_assoc();
            $matricNum = $r_submission['matricNum'];
            $ass_details = $r_submission['ass_details'];
            $status = 'Graded';
            $expected_score = intval($r_submission['score']);
            $format = $r_submission['format'];

    if($format == 'individual'){
        if($expected_score >= $score)
        {
            // Checking if the assignment has been graded for the student already 
            $q_result = $db->query("SELECT * FROM assignmentresult WHERE course_code='$course_code' AND student_id=$student_id");
            $rownum = $q_result->num_rows;
            $fetch = $q_result->fetch_assoc();
            $count = $fetch['count'] + 1;
      
            if($rownum > 0)
            {
                // Saving the assignment result in database
                $r_update = $db->query("UPDATE assignmentresult SET $ass_details='$score', count=$count WHERE course_code='$course_code' AND student_id=$student_id");

                // Updating the assignmentsubmission table
                $r_update_submission = $db->query("UPDATE assignmentsubmission SET status='$status', score_array='$score_array' WHERE assignment_id=$ass_id AND student_id=$student_id");
                if($r_update)
                {
                    echo 'Graded';
                }
            }
            else
            {
                // Saving the assignment result in database
                $r_insert = $db->query("INSERT INTO assignmentresult(matricNum, course_code, $ass_details, student_id, tutor_id, count) VALUES('$matricNum','$course_code', $score, $student_id, $tutor_id, 1)");
                
                // Updating the assignmentsubmission table
                $r_update_submission = $db->query("UPDATE assignmentsubmission SET status='$status', score_array='$score_array' WHERE assignment_id=$ass_id AND student_id=$student_id");
                if($r_insert)
                {
                    echo 'Score Inserted';
                }
            }
        }
    }
    else
    {
       if($expected_score >= $score)
        {   //Getting the Group ID of the Ungraded Assignment.
             $group_id = intval($_SESSION['group_id']);

            //Selecting every members of a particular Group.
            $query = $db->query("SELECT s.matricNum, c.courseCode, m.student_id FROM group_assignment g, group_member m, course c, student s WHERE tutor_id=$tutor_id AND m.group_id=$group_id AND m.course_id=c.courseID AND m.student_id=s.id GROUP BY matricNum");

            // Checking if the student as a record in the assignment result already. 
            foreach ($query as $value) {
                $q_result = $db->query("SELECT * FROM assignmentresult WHERE course_code='$course_code' AND matricNum='".$value['matricNum']."'");
            $rownum = $q_result->num_rows;
            $fetch = $q_result->fetch_assoc();
            $count = $fetch['count'] + 1;
            }
            

            if($rownum > 0)
            {
                // Saving the assignment result of each student in the group into database
                foreach ($query as $value) 
                {
                    $r_update1 = $db->query("UPDATE assignmentresult SET $ass_details=$score, count=$count WHERE course_code='$course_code' AND matricNum='".$value['matricNum']."'");
                }
                    //Updating the assignmentsubmission table
                    $r_update_submission = $db->query("UPDATE assignmentsubmission SET status='$status', score_array='$score_array' WHERE assignment_id=$ass_id AND student_id=$student_id");
                if($r_update1)
                {
                    echo 'Graded';
                }
            }
            else
            {   // Saving the assignment result of each student in the group into database
               foreach ($query as $value) 
               {
                    $query1 = $db->query("INSERT INTO assignmentresult(matricNum, course_code, $ass_details, student_id, tutor_id, count) VALUES('".$value['matricNum']."', '".$value['courseCode']."', $score, ".$value['student_id'].", $tutor_id, 1)");
                    // die(var_dump($query1));
                }
                //Updating the assignmentsubmission table
                $r_update_submission = $db->query("UPDATE assignmentsubmission SET status='$status', score_array='$score_array' WHERE assignment_id=$ass_id AND student_id=$student_id");
            
                if($query1)
                {
                     echo 'Score Inserted';
                }
            }
        }
    }

    }
}
?>