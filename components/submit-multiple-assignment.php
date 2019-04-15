<?php
require_once '../connect.php';
session_start();
$student = intval($_SESSION['user_id']);
$ass_id = intval($_SESSION['ass_id']);

// print_r(array_values(array_filter(explode(PHP_EOL, $_POST['answer']))));
// print_r(str_replace("/r","", $_POST['answer']));
// die();

if(!empty($_SESSION['group_id']))
{
    $group_id = intval($_SESSION['group_id']);
}
// die(var_dump($_POST['answer'], $ass_id));
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    	$checking_answer = array_filter($_POST['answer']);
        if(!empty($checking_answer))
        {
        	// Mysql Query to select the details of assignments from database
            $q_multiple = $db->query("SELECT a.id, a.courseCode, a.assign_date, a.sub_question, a.sub_score, a.type, a.submission_date, a.score, a.question, a.score, a.ass_filepath, a.format, a.ass_details, s.matricNum FROM assignmentdetail a, courseenroll e, course c, tutor t, student s  WHERE a.courseCode=c.courseCode AND e.course=c.courseID AND e.student=$student AND a.id=$ass_id");
            $row=$q_multiple->fetch_assoc();
             
            $answer = json_encode(str_replace(array("\n", "\r"), ' ', $_POST['answer'])); //Replacing multiple line with a single line.
            $courseCode = $row['courseCode'];
            $score = $row['score'];
            $submit_date = $row['submission_date'];
            $format = $row['format'];
            $ass_details = $_SESSION['ass_details'] = $row['ass_details'];
            $date = date("Y-m-d h:i:sa");
            $status = 'Ungraded';

            if($format == 'individual'){
            // Mysql Query to select the submission of assignments from database
     		$s_query = $db->query("SELECT * FROM assignmentsubmission WHERE assignment_id=$ass_id AND student_id=$student");
    		$rws = $s_query->num_rows;

            //Check if the assignment have already been submitted by the current User,
            //Update The assignment submission if current User resubmitted is assignment.
    		if($rws > 0)
    		{
                while ($result=$s_query->fetch_assoc()) {
                    $status1 = $result['status'];
                }
                if($status1 == 'Ungraded'){
    			$q_submitted = $db->query("UPDATE assignmentsubmission SET sub_answer='$answer', submission_date='$date' WHERE student_id=$student AND assignment_id=$ass_id");
                // die(var_dump($q_submitted));
                if($q_submitted)
                {
                  echo '<script> window.location.href = "../studentmodule.php"
                          alert("Submission Updated successfully")
                    </script>';
                }
                }
    		}
    		else
    		{

    			$q_submit = $db->query("INSERT INTO assignmentsubmission(ass_details, assignment_id, course_code, sub_answer, format, submission_date, status, student_id) VALUES ('$ass_details', '$ass_id','$courseCode','$answer','$format','$date','$status','$student')");

            if($q_submit)
            {
                echo '<script> window.location.href = "../studentmodule.php"
                          alert("Submission successfully")
                    </script>';
            }
        }
        }
        else
        {
       /*  --This check if any groups have submitted their assignment earlier-- 
                Mysql Query to select the details of assignments from database*/
            $g_query = $db->query("SELECT * FROM assignmentsubmission WHERE assignment_id=$ass_id AND group_id=$group_id");
            $rowcount1 = $g_query->num_rows;
            if($rowcount1 > 0)
            {
                while ($r=$g_query->fetch_assoc()) 
                {
                    $statuses = $r['status'];
                }
                /*If postive, It updated the current submission and student-id base on the group that submitted earlier */
                if($statuses == 'Ungraded'){
                $q_submitted = $db->query("UPDATE assignmentsubmission SET sub_answer='$answer', submission_date='$date', student_id=$student WHERE group_id=$group_id AND assignment_id=$ass_id");
                // die(var_dump($q_submit1));
                if($q_submitted)
                {
                  echo '<script> window.location.href = "../studentmodule.php"
                          alert("Submission Updated successfully")
                    </script>';
                }
                }
            }
            else
            {
                $q_submit = $db->query("INSERT INTO assignmentsubmission(ass_details, assignment_id, course_code, sub_answer, format, submission_date, status, group_id, student_id) VALUES ('$ass_details', '$ass_id','$courseCode','$answer','$format','$date','$status', '$group_id', '$student')");

            if($q_submit)
            {
                echo '<script> window.location.href = "../studentmodule.php"
                          alert("Submission successfully")
                    </script>';
            }
            }
        }
    }
}
?>