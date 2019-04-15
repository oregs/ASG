<?php
require_once '../../components/connect.php';
session_start();
$tutor = intval($_SESSION['tutor_id']);
//Selecting every courses assign to the tutor.
    $course_query = $db->query("SELECT a.course, c.courseCode FROM courseassign a, course c WHERE a.course=c.courseID AND tutor='$tutor' ORDER BY courseCode ASC");

?>
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Group Information</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <div class="row" style="margin-bottom: 10px;">
            <form method="POST" id="autogroup">
              <h5 align="center">Automatic Group Assigning</h5>
              <div class="row form-group">
              <div class="col-md-5 col-sm-offset-1">
                <input type="text" name="per_group" placeholder="Number of Students per Group" class="form-control" required>
              </div>
              <input type="hidden" name="tutor" value="">
              <div class="col-md-5">
                <div class="form-group">
                  <select id="course" name="course" class="form-control">
                  <option value="" selected="selected" disabled="disabled">Select Course</option>
                       <?php

                       while($row=$course_query->fetch_assoc())
                       {
                          echo '<option value="'.$row["course"].'">'.$row["courseCode"].'</option>';
                        }
                       ?>
                  </select>
                </div>
             </div>
            </div>
          <div class="col-sm-12" align="center">
          <input type="submit" name="add" value="Generate Groups" class="btn btn-primary">
          </div>
          </form></div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="create-group.php"><button type="button" class="btn btn-danger">Cancel</button></a>
      </div>
    </div>
<script>
$(document).ready(function(){
  $('#autogroup').submit(function(){
    $.ajax({
      url:'components/autogroup.php',
      method:'POST',
      data:$(this).serialize(),
      success:function(data){
        alert('Data Inserted');
      }
    }).then(function(){
          window.location="create-group.php";
        });
  });
});    
</script>