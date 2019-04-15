<div id="questionfile" class="tabcontent">
  <form method="post" enctype="multipart/form-data" id="assignment_data">
    <div class="formgroup">
      <textarea class="form-control" id="q_text" name="questiontext" Placeholder="Enter the Assignment Question" rows="5" cols="10"></textarea>
    </div><br>

  <h4 align="center" style="color:#0275D8;">OR</h4>
  <div class="row">
    <div class="col-sm-6 float-label-control">
      <input type="file" name="questionfile" id="questionFile" class="btn btn-primary ladda-button" />
    </div>
    <div class="form-group col-sm-6 offset-sm-1">
      <input type="text" class="form-control" id="score" name="score" Placeholder="Score">
  </div>
  </div><br>

  <div class="row">
     <div class="col-sm-6">
      <select class="form-control" id="ass_d" name="ass_d">
        <option value="" disabled="disabled" selected="selected">--Select AssignmentId--</option>
        <option value="Assignment_1">Assignment 1</option>
        <option value="Assignment_2">Assignment 2</option>
        <option value="Assignment_3">Assignment 3</option>
        <option value="Assignment_4">Assignment 4</option>
        <option value="Assignment_5">Assignment 5</option>
      </select>
    </div>
    <div class="form-group offset-sm-1 col-sm-6">
      <select class="form-control courseCode" id="courseCode" name="courseCode">
        <option value="" disabled="disabled" selected="selected">--Select Course Code--</option>
        <?php
        $tutor = intval($_SESSION['tutor_id']);
        $a_query = $db->query("SELECT a.course, c.courseCode FROM courseassign a, course c WHERE a.course=c.courseID AND tutor='$tutor'");
        while ($a_row=$a_query->fetch_assoc()) 
        {
          echo '<option value="' .$a_row["courseCode"]. '">' .$a_row["courseCode"]. '</option>';
        }

        ?>
      </select>
  </div>
  </div>

  <div class="row ">
     <div class="col-sm-6">
        <label>Submission Date:</label>
        <input type="date" name="subDate" id="subDate" class="form-control" />
    </div>

  <div class="form-group offset-sm-1 col-sm-6">
    <label>Submission Time:</label>
    <input type="time" name="subTime" id="subTime" class="form-control" />
  </div>
</div>
  <div class="row">
     <div class="col-sm-6">
      <select class="form-control selectpicker" data-style="select-with-transition" onchange="fun_showselectbox()" name="format" id="format">
        <option value="" disabled="disabled" selected="selected">--Select Format--</option>
        <option value="individual">Individual</option>
        <option value="group">Group</option>
      </select>
    </div>
    <div class="form-group offset-sm-1 col-sm-6" style="display:none;" id="group">
      <select class="form-control" name="groupName" id="groupName">
        
      </select>
    </div>
  </div><br>


<div class="col-sm-12" align="center">
<button type="button" name="submit" id="submit" class="btn btn-primary">Submit</button>
</div>

</form>

</div>