 <?php
    $tutor = intval($_SESSION['tutor_id']);
    //Selecting every courses assign to the tutor.
    $course_query = $db->query("SELECT a.course, c.courseCode FROM courseassign a, course c WHERE a.course=c.courseID AND tutor='$tutor' ORDER BY courseCode ASC");
    //Selecting every groups a tutor registered.
     $group_query = $db->query("SELECT * FROM group_assignment WHERE tutor_id='$tutor'");

?>
 <div class="col-lg-12">
  <form method = "POST" id="group_data">
   <div class = "alert alert-info">Group / Student</div><br />
   <div class="row">
    <h4>For Auto Generation of Group <a id="getAuto" class = "btn btn-primary" data-toggle="modal" data-target="#myModal"><span class = "fa fa-group">&nbsp;</span>Click Here</a></h4>
    </div><br>
   <div class="row form-group">
    <div class="col-md-5 col-sm-offset-1">
      <input type="text" class="form-control" placeholder="Enter Group Name" name="group_name" id="group_name" />
      
    </div>
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
  </div><br>

  <div class="row">
    <div class = "col-md-5 col-sm-offset-3 form-group" align="center">
     <label>Select Student</label><br />
     <select id="student" name="student[]" class="form-control" multiple>
     </select>
     <!-- An hidden input collecting data from the multiple select 'Student' -->
     <input type="hidden" name="hidden_student" id="hidden_student" />
   </div>
</div>
<div class="col-sm-12" align="center">
<button type="submit" name="add" id="add" class="btn btn-primary">Add</button>
</div>
</form>
</div><br><br><br><br>
  <!-- <div id="alert_message"></div> -->
  <div id = "group_table">
      <table id = "table" class="table table-bordered table-striped">
        <thead class = "alert-success">
          <tr>
            <th>S/N</th>
            <th>Group Name</th>
            <th>Course Code</th>
            <th>Group Members</th>
          </tr>
        </thead>
        <tbody>
        <?php

        $q_group = $db->query("SELECT * FROM group_assignment g, group_member m, course c WHERE tutor_id=$tutor AND g.group_id=m.group_id AND m.course_id=c.courseID GROUP BY group_name");
        $rowcount = $q_group->num_rows;
          
        if($rowcount > 0){
        while ($result = mysqli_fetch_assoc($q_group)) 
          { 
            $id = $result['group_id'];
            $group_name = str_replace('_', ' ', $result['group_name']);
            $course = $result['courseCode'];
            // $matricNum = $result['matricNum'];
          ?>
          <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $group_name ?></td>
            <td><?php echo $course ?></td>
            <!-- <td>'.$matricNum.'</td> -->
            <td><button  value="<?php echo $id ?>" id="getView" class = "btn btn-primary" data-toggle="modal" data-target="#myModal"><span class = "glyphicon glyphicon-search">&nbsp;</span>View</button> </td>
        <?php }} ?>
          </tr>
        </tbody>
      </table>
  </div>

</div>