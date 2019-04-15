<?php include 'valid.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>
<?php
//Requesting for the current (course_code, assignment_id and student_id) 

$received = $_REQUEST['id'];
$process = explode('_', $received);
$ass_details = $process[1].'_'.$process[2];
$sub_id = intval($process[0]);
$course_code = $process[3];
$ass_id = $process[4];

if(!empty($_REQUEST['id'])){
  $update_query = "UPDATE assignmentsubmission SET seen=1 WHERE id=$sub_id";
    mysqli_query($db, $update_query);
}
?>
<style>
  .color{
    color: blue;
  }
</style>

<body style = "background-color:#F8F8F8;">   

                <?php include 'navigation.php'; ?>                    
            
<div class = "container-fluid">
<?php include 'sidebar.php'; ?>

<div class = "col-lg-9 well" style = "margin-top:60px;">   
    <div class="container">
       <div class="no-gutter row"> 
           <div class="col-md-9">
               <div class="panel panel-default" id="sidebar">
                   <div class="panel-body">                
                    <ul class="nav nav-tabs">
                      <?php  

                        $q_gradecheck = $db->query("SELECT a.id, a.status, a.course_code, a.ass_details, d.ass_filepath, d.question, d.score FROM assignmentsubmission a, assignmentdetail d WHERE student_id=$student AND a.assignment_id=d.id AND d.id=$ass_id AND a.status='Graded'");
                        while($rws=$q_gradecheck->fetch_assoc())
                        {
                          $status = $rws['status'];
                          $score = $rws['score'];
                        }
                       
                         $q_result = $db->query("SELECT * FROM assignmentresult r, tutor t WHERE student_id=$student AND course_code='$course_code' AND r.tutor_id=t.id");
                            while ($row=$q_result->fetch_assoc()) {
                              $ass_details1 = $row[$ass_details];
                              $tutor_name = $row['tutor_lname'].' '.$row['tutor_fname'];
                            }
                         

                      ?>
                      <div class="row group">
                        <div class="form-group col-sm-3">
                            <label class="color"><strong>Course Code:</strong></label>
                          </div>
                          <div class="col-sm-2">
                           <label><?= $course_code ?></label>
                          </div>
                          </div>
                          <div class="row group">
                            <div class="form-group col-sm-3">
                                <label class="color"><strong>Assignment Detail:</strong></label>
                              </div>
                              <div class="col-sm-2">
                               <label><?= str_replace('_', ' ', $ass_details); ?></label>
                              </div>
                          </div>
                          <div class="row group">
                            <div class="form-group col-sm-3">
                                <label class="color"><strong>Lecturer:</strong></label>
                              </div>
                              <div class="col-sm-4">
                               <label><strong><?= $tutor_name ?></strong></label>
                              </div>
                          </div>
                          <div class="row group">
                            <div class="form-group col-sm-3">
                                <label class="color">Status:</label>
                              </div>
                              <div class="col-sm-2">
                                <label><?= $status ?></label>
                              </div>
                          </div>
                    </ul>
                    <div class="tab-content">
                      <h3 align="center"><strong class="color">Score:</strong></h3>
                       <h1 align="center" style="font-size:100px;"><?= $ass_details1 .'/'. $score ?></h1>
                    </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>
</div>
    <nav class = "navbar navbar-default navbar-fixed-bottom">
            <div class = "container-fluid">
                <label class = "navbar-text pull-right">Assignment Submission & Grading System &copy; All rights reserved 2018</label>
            </div>
        </nav>
    </body>
<script src = "js/sidebar.js"></script>
