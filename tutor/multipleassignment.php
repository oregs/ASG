<div id="questiontext" class="tabcontent">
    <form method="post" class="form-horizontal" id="multiple_data">

  <div class="content">
    <div class="row">
      <div class="col-sm-2">
            <button  type="button" id="btnAdd" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i></button>
        </div>
      </div><br> 
      <div class="row">
      <div class="col-sm-6">
      <select class="form-control" name="ass_details" id="ass_details">
        <option value="" disabled="disabled" selected="selected">--Select AssignmentId--</option>
        <option value="Assignment_1">Assignment 1</option>
        <option value="Assignment_2">Assignment 2</option>
        <option value="Assignment_3">Assignment 3</option>
        <option value="Assignment_4">Assignment 4</option>
        <option value="Assignment_5">Assignment 5</option>
      </select>
    </div>

    <div class="form-group offset-sm-1 col-sm-6">
      <select class="form-control" name="course_code" id="course_code">
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

  <div class="row group">
    <div class="col-sm-8">
      <!-- <div class="form-group"> -->
        <textarea class="form-control" id="question" name="question[]" Placeholder="Enter the Assignment Question" rows="2" cols="10"></textarea>
      </div>
    <!-- </div> -->
      <div class="col-sm-2">
        <input type="text" class="form-control score" name="score[]" Placeholder="Score">
      </div>
  
      <div class="form-group offset-sm-1 col-sm-2">
          <button  type="button" class="btn btn-danger btn-sm btnRemove"><i class="glyphicon glyphicon-minus"></i></button>
      </div>
    </div>
  </div><br>

    <div class="row ">
     <div class="col-sm-6">
        <label>Submission Date:</label>
        <input type="date" id="submission_date" name="submission_date" class="form-control" />
    </div>

  <div class="form-group offset-sm-1 col-sm-6">
    <label>Submission Time:</label>
    <input type="time" id="submission_time" name="submission_time" class="form-control" />
  </div>
</div>

    <div class="row">
     <div class="col-sm-6">
      <select class="form-control selectpicker" data-style="select-with-transition" onchange="selectbox()" name="format" id="format-multiple">
        <option value="" disabled="disabled" selected="selected">--Select Format--</option>
        <option value="individual">Individual</option>
        <option value="group">Group</option>
      </select>
    </div>
    <div class="form-group offset-sm-1 col-sm-6" style="display:none;" id="group-ass">
      <select class="form-control" name="group" id="groups">
              <!-- Group name is shown here -->
      </select>
    </div>
  </div><br>


<div class="col-sm-12" align="center">
<button type="button" name="multiple_ass" class="btn btn-primary" id="multiple_ass">Submit</button>
</div>

</form>
</div>
