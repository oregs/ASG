<?php
    $staffId=$_SESSION['staffId'];          
    $sql = "SELECT * FROM tutor where staffId='$staffId'";
    $result = mysqli_query($db,$sql) or die(mysqli_error($db)); 
    $rws = mysqli_fetch_array($result);
?>   
<div class = "col-lg-2 well" style = "margin-top:60px;">
        <div class = "container-fluid" style = "word-wrap:break-word;">
          <img src="../userfiles/avatars/<?php echo $rws['tutor_avatar'];?>" class="img-circle"  style="width: 130px;height: 130px;" />
          <br />
          <br />
          <label class = "text-muted"></label> <!-- name of the user to display -->
        </div>
        <hr style = "border:1px dotted #d3d3d3;"/>
        <ul id = "menu" class = "nav menu">
          <li><a style = "font-size:15px; border-bottom:1px solid #d3d3d3;" href="assignment.php"><i class = "material-icons">assignment</i>New Assignment</a>
          <li><a style = "font-size:15px; border-bottom:1px solid #d3d3d3;" href="tutormodule.php"><i class = "glyphicon glyphicon-tasks"></i> Grading Module</a>
          </li>
          <li><a style = "font-size:15px; border-bottom:1px solid #d3d3d3;" href ="notification/index.php""><i class = "material-icons">announcement</i> Announcement</a></li>
          <li><a style = "font-size:15px; border-bottom:1px solid #d3d3d3;" href ="create-group.php"><i class = "fa fa-group"></i> Create Group</a></li>
          <li><a style = "font-size:15px; border-bottom:1px solid #d3d3d3;" href="score_sheet.php"><i class = "material-icons">assessment</i> Scores Sheet</a>
          </li>
          <li><a style = "font-size:15px; border-bottom:1px solid #d3d3d3;" href="article_entry.php"><i class = "fa fa-book"></i> Article Entry</a>
          </li>
          <li><a style = "font-size:15px; border-bottom:1px solid #d3d3d3;" href="assignment_submission_archive.php"><i class = "fa fa-archive"></i> Assignment Archive</a></li>
        </ul>
      </div>