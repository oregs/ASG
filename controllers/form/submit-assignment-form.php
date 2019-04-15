
    <!-- Nav tabs -->
<style>
    .color {
        color: blue;
    }
</style>

    <?php    
        // die(var_dump($_SESSION['ass_id'],  $_SESSION['group_id']));
    // Mysql Query to select the submission of assignments from database
     $s_query = $db->query("SELECT * FROM assignmentsubmission WHERE assignment_id=$ass_id AND student_id=$student");
    $rowcount = $s_query->num_rows;
    if($rowcount > 0){
        while ($rws=$s_query->fetch_assoc()) {
            $status1 = $rws['status'];
        }
    }
 
     
        // Mysql Query to select the details of assignments from database
            $q_ass = $db->query("SELECT a.id, a.courseCode, a.assign_date, a.sub_question, a.sub_score, a.type, a.submission_date, a.score, a.question, a.score, a.ass_filepath, a.format, a.ass_details, a.group_id, s.matricNum FROM assignmentdetail a, courseenroll e, course c, tutor t, student s  WHERE a.courseCode=c.courseCode AND e.course=c.courseID AND e.student=$student AND a.id=$ass_id");
            $rownum = $q_ass->num_rows;
            if($rownum > 0)
            {
                while ($row=$q_ass->fetch_assoc()) 
                {
                    $courseCode = $row['courseCode'];
                    $score = $row['score'];
                    $submit_date = $row['submission_date'];
                    $assign_date = date("M j, Y",strtotime($row['assign_date']));
                    $submission_date = date("M j, Y",strtotime($row['submission_date']));
                    $submission_time = date("h:ia",strtotime($row['submission_date']));
                    $question = $row['question'];
                    $ass_filepath = $row['ass_filepath'];
                    $format = $row['format'];
                    $assignment_id = intval($row['id']);
                    $matricNum = $row['matricNum'];
                    $ass_details = $_SESSION['ass_details'] = $row['ass_details'];
                    $type = $row['type'];
                    $questionArray = json_decode($row['sub_question']);
                    $scoreArray = json_decode($row['sub_score']);
                    $group_id = $row['group_id'];

                }

            }   

    ?>
    <ul class="nav nav-tabs">
        <p><strong>Course Code:</strong><?php echo $courseCode  ?></p>
      <p><strong>Expected Score:</strong><?php echo $score  ?></p>
       <p><strong>Assigned Date:</strong><?php echo $assign_date ?></p>
        <p><strong>Submission Date:</strong><?php echo $submission_date ?></p>
        <p><strong>Submission Time:</strong><?php echo $submission_time ?></p>
    </ul>
    <!-- setting status to Ungraded at the initial submission -->
    <?php
    $status = "Ungraded";
    ?>
    <!-- Tab panes -->

<div class="tab-content">
    <br>
    <?php 
    //conditional statement to specify the type of assignment.
    if($type == 'single')
    {
        if(!empty($question)){
            echo '<p><strong>Question:</strong>'. $question .'</p>';
        }else{
            echo '<p><strong>Assignment File:</strong><a href="tutor/questionfile/'. $ass_filepath .'">'. $ass_filepath .'</a></p>';
        }

    ?>
    <?php 
    // Checking if the submission deadline has not passed
        date_default_timezone_set('Africa/Lagos');
        $datetime1 = new DateTime($submit_date);
        $datetime2 = new DateTime(date("Y-m-d h:i:sa"));
        
        if($datetime2 > $datetime1)
        {
            echo '<b style="color:red;">Sorry, Assignment cannot be Submitted. Submission Deadline has been reached.</b>';
        }
        // elseif($rowcount > 0)
        // {
        //     echo "<b>Assignment has been submitted already</b>";
        // }
        else
        {
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $ass_id ?>" enctype="multipart/form-data" role="form" id="assignmentData">
        <div class="form-group">
            <div class="col-md-6">
                <div class="form-group float-label-control">
                    <label>Upload a file.</label>
                    <input type="file" name="myfile" id="myfile" class="btn btn-primary ladda-button" />
                </div>
            </div>
            <input type="hidden" class="status" value="<?php if(!empty($status1)){echo $status1;}else{echo $statuses;} ?>">
            <input type="hidden" class="type" value="<?php echo $type ?>">
            <button type="button" name="submit" id="submit" class="btn btn-primary btn-block">Submit</button>
        </div>  
    </form>  
</div>
<?php 
}
}
else
{ ?>
<form method="post" action="components/submit-multiple-assignment.php?id=<?php echo $ass_id ?>" enctype="multipart/form-data" id="multiData" role="form">
<?php
    for ($i=0; $i < count($questionArray) ; $i++) { 
        for ($i=0; $i < count($scoreArray) ; $i++) {
?>
    <div class="row">
        <div class="col-md-6">
             <div class="form-group">
                <label><strong><span class="color">Question <?= $i; ?>:</span></strong></label>
            </div>
        </div>
        <div class="col-md-3 col-sm-offset-2">
             <div class="form-group">
                <label><strong><span class="color">Score:</span></strong><?= $scoreArray[$i]; ?></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
             <div class="form-group">
                <label><?= $questionArray[$i]; ?></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label><span class="color">Answer:</span></label>
                <textarea name="answer[]" id="answer" class="form-control" rows="3" style="width:753px;height:94px;"></textarea>
            </div>
        </div>
    </div>
<?php }} ?>
        
        <input type="hidden" class="status" value="<?php if(!empty($status1)){echo $status1;}else{echo $statuses;} ?>">
<?php
        echo '<button type="button" id="submit" name="multiple_ass" class="btn btn-primary btn-block">Submit</button>
        </form>';
}?>


<?php
// die(var_dump($_FILES["myfile"]["tmp_name"]));
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// die(var_dump($_FILES["myfile"]["tmp_name"]));
        if(!empty($_FILES["myfile"]["tmp_name"])){

        $target_dir = 'assignment_file/';
        $original_filename = $_FILES["myfile"]["name"];

        $uploadOk = 1;
        $FileType = pathinfo($original_filename,PATHINFO_EXTENSION);

        // Get filename without extension
        $filename_without_ext = basename($original_filename, '.'.$FileType);

        // Generate new filename
        $new_filename = $target_dir.str_replace(' ', '_', $filename_without_ext) . '_' . time() . '.' . $FileType;

        //Check if file already exists
        if (file_exists($new_filename)) {
            if($student)
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["myfile"]["size"] > 5000000) {
            echo '<p style="color:red;">Sorry, your file is too large.</p>';
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($FileType != "txt" && $FileType != "docx" && $FileType != "pdf") {
            echo "Only txt, docx and pdf files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo '<p style="color:green;">Sorry, your file was not uploaded.</p>';
        // if everything is ok, try to upload file
        } 
        else {
        /*  Check if the assignment have already been submitted by the current User,
            Update The assignment submission if current User resubmitted is assignment. */ 
            if($format == 'individual'){
                if($rowcount > 0){
                    if($status1 == 'Ungraded'){
                    move_uploaded_file($_FILES["myfile"]["tmp_name"], $new_filename);
                    $q_submit1 = $db->query("UPDATE assignmentsubmission SET answer_filepath='$new_filename', submission_date='$date' WHERE student_id=$student AND assignment_id=$ass_id AND status='Ungraded'");
                    
                     if($q_submit1){
                      echo '<p style="color:green;">Assignment Updated Successfully.</p>';
                    }
                }
                }
                else
                {
                    //Inserted assignment submitted by the user into the database.
                    move_uploaded_file($_FILES["myfile"]["tmp_name"], $new_filename);
                    $q_submit = $db->query("INSERT INTO assignmentsubmission(ass_details, assignment_id, course_code, answer_filepath, format, submission_date, status, student_id) VALUES ('$ass_details', '$assignment_id','$courseCode','$new_filename','$format','$date','$status','$student')");

                    if($q_submit){
                      echo '<p style="color:green;">Data Inserted Successfully.</p>';
                    }
                }
           }
           else
           {    /*  --This check if any groups have submitted their assignment earlier-- 
                    Mysql Query to select the details of assignments from database*/
                $g_query = $db->query("SELECT * FROM assignmentsubmission WHERE assignment_id=$ass_id AND group_id=$group_id");
                $rowcount1 = $g_query->num_rows;
                if($rowcount1 > 0){
                    while ($r=$g_query->fetch_assoc()) {
                        $statuses = $r['status'];
                    }
                }
            /*If postive, It updated the current submission and student-id base on the group that submitted earlier */
                if($rowcount1 > 0){
                    if($statuses == 'Ungraded'){
                    move_uploaded_file($_FILES["myfile"]["tmp_name"], $new_filename);
                    $q_submit1 = $db->query("UPDATE assignmentsubmission SET answer_filepath='$new_filename', submission_date='$date', student_id=$student WHERE assignment_id=$ass_id AND group_id=$group_id AND status='Ungraded'");
                    
                     if($q_submit1){
                      echo '<p style="color:green;">Assignment Updated Successfully.</p>';
                    }
                }
                }
                else
                {
                    //Inserted assignment submitted by group into the database.
                    move_uploaded_file($_FILES["myfile"]["tmp_name"], $new_filename);
                    $q_submit = $db->query("INSERT INTO assignmentsubmission(ass_details, assignment_id, course_code, answer_filepath, format, submission_date, status, group_id, student_id) VALUES ('$ass_details', '$assignment_id','$courseCode','$new_filename','$format','$date','$status', '$group_id', '$student')");

                        
                    if($q_submit){
                      echo '<p style="color:green;">Data Inserted Successfully.</p>';
                    }
                }
           }  
        }
    }
    else{
        echo '<p style="color:blue;">Select File to upload</p>';
    }
    
}
?>