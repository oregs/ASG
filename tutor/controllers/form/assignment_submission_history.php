<?php
require_once '../../components/connect.php';
session_start();
// die(var_dump($_REQUEST['id']));
    $process= $_REQUEST['id'];
    $process = explode('_', $process);
    $stud_id = $_SESSION['student_id'] = intval($process[0]);
    $assignment_id = $_SESSION['assignment_id'] = intval($process[1]);
    $ass_details = $_SESSION['assignment_details'] = $process[2]."_".$process[3];
    $tutor_id = intval($_SESSION['tutor_id']);
    $q_submission = $db->query("SELECT a.course_code, a.submission_date, a.format, a.status, a.answer_filepath, d.question, d.ass_filepath, d.score, d.sub_question FROM assignmentsubmission a, courseassign e, course c, assignmentdetail d WHERE e.tutor=$tutor_id AND a.student_id=$stud_id AND e.course=c.courseID AND a.assignment_id=$assignment_id AND d.id=$assignment_id ORDER BY a.course_code");
    while ($result=$q_submission->fetch_assoc()) {
        $course_code = $result['course_code'];
        $status = $result['status'];
        $question = $result['question'];
        $sub_question = json_decode($result['sub_question']);
        $answer_filepath = $result['answer_filepath'];
        $ass_filepath = $result['ass_filepath'];
        $score = $result['score'];
    }

  $q_result = $db->query("SELECT * FROM assignmentresult r, tutor t WHERE student_id=$stud_id AND course_code='$course_code'");
  while ($row=$q_result->fetch_assoc()) {
    $ass_details1 = $row[$ass_details];
  }
?>
<style>
    hr { 
          display: block;
          margin-top: 0.5em;
          margin-bottom: 0.5em;
          margin-left: auto;
          margin-right: 26px;
          border-style: inset;
          border-width: 1px;
}
.color {
    color: blue;
}
.circle {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    font-size: 50px;
    color: #fff;
    line-height: 150px;
    text-align: center;
    background: #000;

}
.pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}   
</style>
<div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class=" col-sm-4">
            <h4 class="modal-title">Article Information</h4>
          </div>
          <div class="col-sm-2 col-sm-offset-6">
            <a href="assignment_history.php?s_id=<?= $stud_id ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
          </div>
          </div>
        </div>
    <div class="modal-body">
        <div class="box-body">
            <div class="row col-sm-offset-1">
                <div class = "col-lg-12">
                    <div class="row">                        
                        <div class="form-group col-sm-6">
                            <label><strong>Course Code:</strong></label>
                          </div>
                          <div class="col-sm-2">
                           <label><?= $course_code ?></label>
                        </div>
                    </div>
                    <div class="row group">
                        <div class="form-group col-sm-6">
                            <label><strong>Assignment Detail:</strong></label>
                        </div>
                        <div class="col-sm-3">
                            <label><?= str_replace('_', ' ', $ass_details); ?></label>
                        </div>
                    </div>
                          <div class="row group">
                            <div class="form-group col-sm-6">
                                <label class="color">Status:</label>
                              </div>
                              <?php
                            if($status === 'Graded'){
                                echo '<div class="col-sm-2">
                                <label style="color:green;">'.strtoupper($status).'</label>
                              </div>';
                            }
                            else
                            {
                                echo '<div class="col-sm-2">
                                <label style="color:red;">'.strtoupper($status).'</label>
                              </div>';
                            }
                            echo '</div>';
                            echo'<div class="row group">';
                          if(!empty($ass_details1)){
                              echo '<div class="col-sm-2"><h3 align="center"><strong class="color">Score:</strong></h3></div>
                                 <div class="col-sm-2 col-sm-offset-2"><h1 class="circle">'. $ass_details1 .'/'. $score.'</h1></div>
                              </div>';
                            } 
                            echo '</div><hr>';

                            if(!empty($question))
                            {
                                echo '<div class="row">
                                        <div class="form-group col-sm-5">
                                            <h4 class="color"><strong>Question:</strong></h4>
                                        </div>
                                        <div class="col-sm-5">
                                            <h4 class="color"><strong>Expected Score: <span>'.$score.'</span></strong></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label>'.$question.'</label>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-5">
                                            <h4 class="color"><strong>Answer:</strong></h4>
                                        </div>
                                        <div class="col-sm-5">
                                            <h4 class="color"><strong>Score Awarded:  <span>'.$ass_details1.'</span></strong>
                                        </div>                                       
                                    </div>
                                    <div class="row">
                                        <a href="../'.$answer_filepath.'" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-download-alt"> Download</span></a>
                                    </div>';
                            }
                            elseif(!empty($sub_question))
                            { ?>
                              <!-- The multiple Question and Answer Pagination is called here by Ajax -->
                                <div id="pagination_data">  
                                </div> 
                                 
                            <?php }
                            else
                            { 
                                echo '<div class="row">
                                        <div class="form-group col-sm-5">
                                            <h4 class="color"><strong>Question File:</strong></h4>
                                        </div>
                                        <div class="col-sm-5">
                                            <h4 class="color"><strong>Expected Score:  <span>'.$score.'</span></strong>
                                        </div>                                       
                                    </div>
                                    <div class="row">
                                        <a href="../tutor/questionfile/'.$ass_filepath.'" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-download-alt"> Download</span></a>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-5">
                                            <h4 class="color"><strong>Answer:</strong></h4>
                                        </div>
                                        <div class="col-sm-5">
                                            <h4 class="color"><strong>Score Awarded:  <span>'.$ass_details1.'</span></strong>
                                        </div>                                       
                                    </div>
                                    <div class="row">
                                        <a href="../'.$answer_filepath.'" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-download-alt"> Download</span></a>
                                    </div>';
                            }

                              ?>
                </div>
            </div><br/>                           
        </div>
    </div>
</div>
<script>  
  //JQuery and Ajax for calling and paginating multiple Answer and Question
 $(document).ready(function(){  
      load_data();  
      function load_data(page)  
      {  
        var studentID = "<?= $_SESSION['student_id']; ?>";
        var assignmentID = "<?= $_SESSION['assignment_id']; ?>";
           $.ajax({  
                url:"controllers/form/assignment_history_pagination.php",  
                method:"POST",  
                data:{page:page, studentID:studentID, assignmentID:assignmentID},  
                success:function(data){  
                     $('#pagination_data').html(data);  
                }  
           })  
      }  
      $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");  
           load_data(page);  
      });  
 });  
 </script>  