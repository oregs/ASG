<?php include 'valid.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>
<?php
// Getting the id of the assignment details and store it into a session variable.
if (!empty(intval($_GET['id'])))
{
    $sub_id = explode('_', $_GET['id']);
    $ass_id = $sub_id[0];
    $_SESSION['ass_id']= intval($ass_id);
    $group_id = $sub_id[1];
    $_SESSION['group_id'] = intval($group_id);
}
$student = intval($_SESSION['user_id']);
?>
<body style = "background-color:#F8F8F8;">   
               <!-- Navigation Bar -->
                <?php include 'navigation.php'; ?>                    

<div class = "container-fluid">
<?php include 'sidebar.php'; ?>

  <div class = "col-lg-10 well" style = "margin-top:60px;">   
      <div class="content">
        <div class = "alert alert-info">Group Assignment / Member</div><br />
         <?php
            $q_group = $db->query("SELECT * FROM group_assignment g, group_member m, course c, student s, tutor t WHERE g.tutor_id=t.id  AND m.group_id=$group_id AND m.course_id=c.courseID AND m.student_id=s.id GROUP BY matricNum");

              while($result = $q_group->fetch_assoc()){
                $member_id = $result['member_id'];
                $matricNum = $result['matricNum'];
                $name = strtoupper($result['student_lastname'].' '.$result['student_firstname']);
          ?>
              <div class="row">
                  <div class="col-md-4 col-sm-offset-3">
                       <div class="form-group">
                          <label><h4><?php echo $name ?></h4></label>
                      </div>
                  </div>
                  <div class="col-md-3">
                       <div class="form-group">
                          <label><h4><?php echo $matricNum ?></h4></label>
                      </div>
                  </div>
              </div>
            <?php } ?>
            <div class="row">
                <a href="Submit-assignment.php?id=<?php echo $ass_id ?>_<?php echo $group_id ?>" class="btn btn-primary btn-block">Assignment Submission</a>
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
