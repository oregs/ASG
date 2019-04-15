 <?php
 session_start();
require_once 'connect.php';

// die(var_dump($_POST['questiontext'], $_FILES["questionfile"]["tmp_name"], $_POST['courseCode'],$_POST['score'], $_POST['subDate'],$_POST['subTime'], $_POST['ass_d'],$_POST['format'], $_POST['groupName']));

//Verify if there is content in the input 
if ((!empty($_FILES["questionfile"]["tmp_name"]) || !empty($_POST['questiontext'])) && !empty($_POST['courseCode']) && !empty($_POST['score']) && !empty($_POST['subDate']) && !empty($_POST['subTime'])) {
    
        $tutor = intval($_SESSION['tutor_id']);
        $ass_details = $_POST['ass_d'];
        $score = $_POST['score'];
        $type = 'single';
        $format = $_POST['format'];
        $courseCode = $_POST['courseCode'];
        $date = $_POST['subDate'];
        $time = $_POST['subTime'];
        $assignedDay = date("Y-m-d h:i:sa");
        $submission = $date . ' ' . $time;

    if($_POST['format'] == 'individal'){
        // $submissiondate = strtotime($submission);
        if(!empty($_FILES["questionfile"]["tmp_name"])){
            $target_dir = "../questionfile/";
            $question = basename($_FILES["questionfile"]["name"]);
            move_uploaded_file($_FILES["questionfile"]["tmp_name"], $target_dir.$question);
            $q_assign = "INSERT INTO `assignmentdetail`(`ass_details`, `courseCode`, `ass_filepath`, `assign_date`, `submission_date`, `type`, `format`, `score`, `tutor_id`) VALUES('$ass_details', '$courseCode', '$question', '$assignedDay', '$submission', '$type', '$format', '$score', '$tutor')";
            $r_assign = $db->query($q_assign);
      }
      elseif(!empty($_POST['questiontext'])) {
           $question = $_POST['questiontext'];
           $score = $_POST['score'];
           $type = 'single';
            
            $q_assign = "INSERT INTO `assignmentdetail`(`ass_details`, `courseCode`, `question`, `assign_date`, `submission_date`, `type`, `format`, `score`, `tutor_id`) VALUES('$ass_details', '$courseCode', '$question', '$assignedDay', '$submission', '$type', '$format', '$score', '$tutor')";
            $r_assign = $db->query($q_assign);
      }
    }
    else 
    {
      $group = intval($_POST['groupName']);
      //Saved as group Assignment.
      if(!empty($_FILES["questionfile"]["tmp_name"])){
            $target_dir = "../questionfile/";
            $question = basename($_FILES["questionfile"]["name"]);
            move_uploaded_file($_FILES["questionfile"]["tmp_name"], $target_dir.$question);
            $q_assign = "INSERT INTO `assignmentdetail`(`ass_details`, `courseCode`, `ass_filepath`, `assign_date`, `submission_date`, `type`, `format`, `score`, `group_id`, `tutor_id`) VALUES('$ass_details', '$courseCode', '$question', '$assignedDay', '$submission', '$type', '$format', '$score', '$group', '$tutor')";
            $r_assign = $db->query($q_assign);
      }
      elseif(!empty($_POST['questiontext'])) {
           $question = $_POST['questiontext'];

            $q_assign = "INSERT INTO `assignmentdetail`(`ass_details`, `courseCode`, `question`, `assign_date`, `submission_date`, `type`, `format`, `score`, `group_id`, `tutor_id`) VALUES('$ass_details', '$courseCode', '$question', '$assignedDay', '$submission', '$type', '$format', '$score', '$group', '$tutor')";
            $r_assign = $db->query($q_assign);
      }
    }
}
?>
