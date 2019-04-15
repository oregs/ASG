<?php include 'valid.php'; ?>
 
<!DOCTYPE html>
 <?php include 'controllers/base/head.php' ?>
 <link type="text/css" rel="stylesheet" href="assets/css/bootstrap/card.css" />
<style>
	a:hover {
		text-decoration: none;
	}
</style>
 
	<body style = "background-color:#F8F8F8;">
				 <!-- Navigation Bar -->
                <?php include 'navigation.php'; ?>                    
    
<div class = "container-fluid">
			<?php include 'sidebar.php' ?>	
	<div class = "col-lg-10 well" style = "margin-top:60px;">
		<div class="content">
				<div class = "alert alert-info">New Assignment</div>

		<!-- Individual Assignment Card Link -->
            <div class="row">                        
			<?php
                // Mysql Query to select the details of assignments from database
          	$student = intval($_SESSION['user_id']);
            $q_assignment = $db->query("SELECT a.id, a.courseCode, a.assign_date, a.submission_date, a.score, a.question, a.score, a.ass_filepath, t.tutor_fname, t.tutor_lname FROM assignmentdetail a, courseenroll e, course c, tutor t  WHERE a.courseCode=c.courseCode AND e.course=c.courseID AND e.student=$student AND a.tutor_id=t.id AND format='individual'");

            while($row=$q_assignment->fetch_assoc()){
            $submit_date = $row['submission_date'];
            date_default_timezone_set('Africa/Lagos');
        	$datetime1 = new DateTime($submit_date);
        	$datetime2 = new DateTime(date("Y-m-d h:i:sa"));
            $position = 25;
            $question = substr($row['question'], 0, $position); 
            
            if($datetime2 > $datetime1){?>	
            <?php }else{ ?>
            	<a href="submit-assignment.php?id=<?php echo $row['id']; ?>" class="text-white">
            		<div class="col-md-3" style="margin-bottom:20px;">
		              <div class="card text-white bg-primary" style="max-width: 20rem;">
		  					<div class="card-header">Assignment Details</div>
		  						<div class="card-body">
		    						<?php
		    						if(!empty($row['ass_filepath']))
		    						{
		    							echo '<p class="card-text"><b>Question File:</b> '. $row['ass_filepath'] .'</p>';
		    						}
		    						elseif (!empty($row['question'])) 
		    						{
		    							echo '<p class="card-text"><b>Question:</b> '. $question .'...</p>';
		    						}
		    						else
		    						{
		    							echo '<p class="card-text"><b>Multiple Question</b></p>';
		    						}
		    						?>
		    						<p class="card-text"><b>Course Code:</b> <?= $row['courseCode']; ?></p>
		    						<p class="card-text"><b>Expected Score:</b> <?= $row['score']; ?></p>
		    						<p class="card-text"><b>Submission Date:</b> <?= $row['submission_date']; ?></p>
		    						<p class="card-text"><b>Lecturer:</b> <?= $row['tutor_lname']; ?> <?= $row['tutor_fname']; ?>
		    						</p>
		  						</div>
		  						<div class="card-footer"><span style="color:white;">Submit Assignment</span><span style="color:white;float:right;"><i class='fa fa-angle-right'></i></span></div>
		  				</div>
					</div>
				</a>
            <?php } } ?>
            </div><br>

            <!-- Group Assignment Card Link -->
             <div class="row">
            <div class = "alert alert-info">Group Assignment</div>
            <?php
            	 $q_group = $db->query("SELECT a.id, a.courseCode, a.assign_date, a.submission_date, a.score, a.question, a.group_id, a.score, a.ass_filepath, t.tutor_fname, t.tutor_lname, g.group_name FROM assignmentdetail a, courseenroll e, course c, tutor t, group_assignment g, group_member m  WHERE a.courseCode=c.courseCode AND e.course=c.courseID AND e.student=$student AND a.tutor_id=t.id AND a.group_id=m.group_id AND a.group_id=g.group_id AND m.student_id=$student AND format='group' GROUP BY id");

            	while($result=$q_group->fetch_assoc()){
            		$submit_date = $result['submission_date'];
            		$group_name = strtoupper(str_replace('_', ' ', $result['group_name']));
            		date_default_timezone_set('Africa/Lagos');
        			$datetime1 = new DateTime($submit_date);
        			$datetime2 = new DateTime(date("Y-m-d h:i:sa"));
            		$position = 25;
            		$question = substr($result['question'], 0, $position);
          
            if($datetime2 > $datetime1){?>	
            <?php }else{ ?>
            	<a href="group_submission.php?id=<?php echo $result['id']; ?>_<?php echo $result['group_id']; ?>" class="text-white">
            		<div class="col-md-3" style="margin-bottom:20px;">
		              <div class="card text-white bg-primary" style="max-width: 20rem;">
		  					<div class="card-header">Group Assignment Details</div>
		  						<div class="card-body">
		    						<?php
		    						if(!empty($result['ass_filepath']))
		    						{
		    							echo '<p class="card-text"><b>Question File:</b> '. $result['ass_filepath'] .'</p>';
		    						}
		    						elseif (!empty($result['question'])) 
		    						{
		    							echo '<p class="card-text"><b>Question:</b> '. $question .'...</p>';
		    						}
		    						else
		    						{
		    							echo '<p class="card-text"><b>Multiple Question</b></p>';
		    						}
		    						?>
		    						<p class="card-text"><b>Course Code:</b> <?php echo $result['courseCode']; ?></p>
		    						<p class="card-text"><b>Group Name:</b> <?php echo $group_name ?></p>
		    						<p class="card-text"><b>Expected Score:</b> <?php echo $result['score']; ?></p>
		    						<p class="card-text"><b>Submission Date:</b> <?php echo $result['submission_date']; ?></p>
		    						<p class="card-text"><b>Lecturer:</b> <?php echo $result['tutor_lname']; ?> <?php echo $result['tutor_fname']; ?>
		    						</p>
		  						</div>
		  						<div class="card-footer"><span style="color:white;">Submit Assignment</span><span style="color:white;float:right;"><i class='fa fa-angle-right'></i></span></div>
		  				</div>
					</div>
				</a>
            <?php } } ?>
        	</div><br>

        	<!-- Graded Assignment Card Link -->
            <div class="row">
            <div class = "alert alert-info">Graded Assignment</div>

            <?php
            	$q_gradecheck = $db->query("SELECT a.id, a.status, a.assignment_id, a.course_code, a.ass_details, d.ass_filepath, d.question FROM assignmentsubmission a, assignmentdetail d WHERE student_id=$student AND  a.assignment_id=d.id AND a.status='Graded' AND a.seen=0 ");
            	while($rws=$q_gradecheck->fetch_assoc()){
            		$status = $rws['status'];
            		$ass_details = $rws['ass_details'];
            		$course_code = $rws['course_code'];
            ?>
            	<a href="check_grade.php?id=<?= $rws['id']; ?>_<?= $rws['ass_details']; ?>_<?= $rws['course_code']; ?>_<?= $rws['assignment_id']; ?>" class="text-white check">	
            		<div class="col-md-3" style="margin-bottom:20px;">
		              <div class="card text-white bg-primary" style="max-width: 20rem;">
		  					<div class="card-header">Assignment Details</div>
		  						<div class="card-body">
		    						<?php
		    						if(!empty($rws['ass_filepath']))
		    						{
		    							echo '<p class="card-text"><b>Question File:</b> '. $rws['ass_filepath'] .'</p>';
		    						}
		    						elseif (!empty($rws['question'])) 
		    						{
		    							echo '<p class="card-text"><b>Question:</b> '. $rws['question'] .'...</p>';
		    						}
		    						else
		    						{
		    							echo '<p class="card-text"><b>Multiple Question</b></p>';
		    						}
		    						?>
		    						<p class="card-text"><b>Course Code:</b> <?= $rws['course_code']; ?></p>
		    						<p class="card-text"><b>Status:</b> <?= $rws['status']; ?></p>
		    						<!-- <p class="card-text"><b>Lecturer:</b> <?php echo $row['tutor_lname']; ?> <?php echo $row['tutor_fname']; ?>
		    						</p> -->
		  						</div>
		  						<div class="card-footer"><span style="color:white;">Check Score</span><span style="color:white;float:right;"><i class='fa fa-angle-right'></i></span></div>
		  				</div>
					</div>
				</a>
            <?php } ?>
        </div>
</div>
</div>
</div>
		
		<br />
		<br />
		<br />
		<nav class = "navbar navbar-default navbar-fixed-bottom">
			<div class = "container-fluid">
				<label class = "navbar-text pull-right">Assignment Submission & Grading System &copy; All rights reserved 2018</label>
			</div>
		</nav>
	</body>
	<script src="assets/js/sb/sb-admin.js"></script>
	<script src="js/sidebar.js"></script>