<?php
include 'components/authenticate.php';
//Requesting for the current (course_code, assignment_id and student_id) 
$received = $_GET['ass_id'];
$process = explode('_', $received);
$ass_id = $process[0];
$courseCode = $process[1];
$student = $process[2];

//Storing the current (course_code, assignment_id and student_id) in a session
$assign_id = $_SESSION['ass_id'] = intval($ass_id);
$course_code = $_SESSION['course_code'] = $courseCode;
$student_id = $_SESSION['student_id'] = intval($student);
?>
 <!DOCTYPE html>
<html lang = "eng">
<?php include 'controllers/base/head.php' ?>
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" /> 
	</head>
	<style type="text/css">
.adjust {
	position: relative;
	left: 30px;
}
hr { 
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  margin-left: auto;
  margin-right: auto;
  border-style: inset;
  border-width: 1px;
} 	
.color {
	color: blue;
}
label{
	font-weight: none !important;
}
</style>
	<body style = "background-color:#F8F8F8;">
			<!-- Navigation Bar -->
				<?php include 'navigation.php'; ?>
			
		<div class = "container-fluid">
			<?php include 'sidebar.php'; ?>
		<div class = "col-lg-10 well" style = "margin-top:60px;">	
<?php
	$q_grade = $db->query("SELECT a.course_code, d.score, a.sub_answer, a.answer_filepath, a.submission_date, a.ass_details, s.matricNum, a.group_id, d.sub_question, d.sub_score, d.question, d.ass_filepath, d.assign_date FROM assignmentsubmission a, student s, assignmentdetail d WHERE `assignment_id`=$assign_id AND a.student_id=$student_id AND a.assignment_id=d.id AND s.id=$student_id");
	$f_grade = $q_grade->fetch_array();
	$_SESSION['group_id'] = $f_grade['group_id'];
	$expectedScore = intval($f_grade['score']);
?>
<!-- <div class = "alert alert-info"><h4><?php echo $f_grade['ass_details']?></h4></div> -->
<div class = "alert alert-info">Submission / Grading</div><br />
 <div class = "col-lg-3"></div>
<div class = "col-lg-10">
	<form method = "POST" enctype="multipart/form-data" id="awardScore">
		<div class="row">                        
            <div class="col-sm-5">
                <label><h4>Matric Number:</h4></label>
            </div>
            <div class="col-sm-1">
               	<label><h4><?= $f_grade['matricNum']; ?></h4></label>
            </div>
        </div>
        <div class="row">                        
            <div class="col-sm-5">
                <label><h4>Course Code:</h4></label>
            </div>
            <div class="col-sm-3">
               	<label><h4><?= $f_grade['course_code']; ?></h4></label>
            </div>
        </div>
        <div class="row">                        
            <div class="col-sm-5">
                <label><h4>Assign_date:</h4></label>
            </div>
            <div class="col-sm-3">
               	<label><h4><?= $f_grade['assign_date']; ?></h4></label>
            </div>
        </div>
		<div class="row">                        
            <div class="col-sm-5">
                <label><h4>Submission Date:</h4></label>
            </div>
            <div class="col-sm-3">
               	<label><h4><?= $f_grade['submission_date']; ?></h4></label>
            </div>
        </div>
        <div class="row">                        
            <div class="col-sm-5">
                <label style="color:blue;"><h3>Total Expected Score:</h3></label>
            </div>
            <div class="col-sm-3">
               	<label style="color:blue;"><h3><?= $f_grade['score']; ?></h3></label>
            </div>
        </div>
		<hr>
		<?php
			//Getting the name of the File without the filepath
			$questionArray = json_decode($f_grade['sub_question']);
			$scoreArray = json_decode($f_grade['sub_score']);
			$answerArray = json_decode($f_grade['sub_answer']);
			$answer_filepath = $f_grade['answer_filepath'];
			$answer_file = explode("/", $answer_filepath);

			if(!empty($f_grade['question']))
			{
				$answer = $answer_file[1];
				echo '<div class="form-group">	
						<label><h4>Question:</h4></label>
						<label class="adjust"><h4>'. $f_grade['question'] .'</h4></label>
					</div>
					<div><label><h4>Answer File:</h4></label>
					<label class=""><a href="../'.$answer_filepath .'"><h4>'. $answer .'</h4></a></label>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
     		 			<input type="text" class="form-control score" name="score[]" Placeholder="Score">
     		 			</div>
    				</div>
     		 			<input type="hidden" class="expectedScore" value="'.$expectedScore.'">
    				<div class = "form-group">	
						<button type="button" class="btn btn-primary grade" name="grade"><span class="glyphicon glyphicon-edit"></span>Submit</button>
					</div>';
			}
			elseif(!empty($f_grade['ass_filepath']))
			{
				$answer = $answer_file[1];
				echo '<div class="form-group">	
						<label><h4>Question File:</h4></label>
						<label class="adjust"><h4>'. $f_grade['ass_filepath'] .'</h4></label>
					</div>
					<div><label><h4>Answer File:</h4></label>
					<label class=""><a href="../'.$answer_filepath .'"><h4>'. $answer .'</h4></a></label>
					</div>
					<div class="col-sm-3">
     		 			<input type="text" class="form-control score" name="score[]" Placeholder="Score">
    				</div>
    				<input type="hidden" class="expectedScore" value="'.$expectedScore.'">
    				<div class = "form-group">	
						<button type="submit" class="btn btn-primary grade" name="grade"><span class="glyphicon glyphicon-edit"></span>Submit</button>
					</div>';
			}
			else
			{ 
				for ($i=0; $i < count($questionArray); $i++) { 
        			for ($i=0; $i < count($scoreArray); $i++) {
        				for ($i=0; $i < count($answerArray); $i++) {
			?>
				    <div class="row">
				        <div class="col-md-8">
				             <div class="form-group">
				                <label style="font-weight:normal;"><strong><span class="color">Question <?php echo $i ?>:</span></strong>   <?php echo $questionArray[$i] ?></label>
				            </div>
				        </div>
				        <div class="col-md-2">
				             <div class="form-group">
				                <label style="font-weight:normal;"><strong><span class="color">Score:</span></strong>   <?php echo $scoreArray[$i] ?></label>
				            </div>
				        </div>
				    </div>
				    <div class="row">
				        <div class="col-md-8">
				            <div class="form-group">
				                <label style="font-weight:normal;"><strong><span class="color">Answer:</span></strong>   <?php echo $answerArray[$i] ?></label>
				                
				        </div>
				    </div>
				    <div class="col-md-2">
				            <div class="form-group">
				                <input type="number" class="form-control score prc" name="score[]" Placeholder="Score" required>   
				        </div>
				    </div>
				</div>
			<?php }}} 
			?>
				
				<div class="row">
					<div class = "col-md-4 form-group" style="float:right;">	
						<label>Total:</label>
						<output id="result"></output>
					</div>
				</div>
				<input type="hidden" class="expectedScore" value="<?php echo $expectedScore ?>">
				<div class="row">
					<div class = "col-md-4 form-group" style="float:right;">	
						<button type="button" class="btn btn-primary btn-md grade" name="grade"><span class="glyphicon glyphicon-upload"></span> Submit</button>
					</div>
				</div>
	<?php	} ?>
	</form>		
</div>
</div>
</div><br><br><br>
<nav class = "navbar navbar-default navbar-fixed-bottom">
	<div class = "container-fluid">
		<label class = "navbar-text pull-right">Assignment Submission & Grading System &copy; All rights reserved 2018</label>
	</div>
</nav>
<script src = "../js/popper.min.js"></script>
<script src = "../js/sweetalert.js"></script>
<script src = "../js/login.js"></script>
<script src = "../js/sidebar.js"></script>
<!-- The script below calculate each Score input and display it to the User -->
<script>
	$('.form-group').on('input','.prc', function(){
		var totalsum = 0;
		$('.form-group .prc').each(function(){
			var inputVal = $(this).val();
			if($.isNumeric(inputVal)){
				totalsum +=parseFloat(inputVal);
			}
		});
		$('#result').text(totalsum);
	});
</script>
<!-- The script below check if the input is empty OR if the Score is greater
		than the Expected Score. if not it send the input data to the server-->
 <script>
  $(document).ready(function(){
    $(".grade").click(function(){

    var score = $(".score").val();
    var expectedScore = $('.expectedScore').val();
    var score_data = $('#awardScore').serialize();

    var scoreSum = 0;
	$('.form-group .score').each(function(){
		var inputVal = $(this).val();
		if($.isNumeric(inputVal)){
			scoreSum +=parseFloat(inputVal);
		}
	});

    if(score == '')
    {
      swal({
            title: "Field(s) empty!!!",
            text: "Please enter score!!!",
            icon: "warning",
            button: "ok",
      });
    }
    else if(scoreSum > parseFloat(expectedScore))
    {
    	swal({
            title: "Not Graded, Score is greater than Expected Score!!!",
            text: "Please Re-enter Score !!!",
            icon: "warning",
            button: "ok",
      });
    }
    else{
      $.ajax({
        url:"components/grade_query.php",
        method:"POST",
        data:score_data,
        success:function(data){
          if(data){
           $('.score').attr("disabled", "disabled");
           $('.grade').attr("disabled", "disabled");
          swal({
            title: "Score Awarded",
            icon: "success",
            button: "ok",
      }).then(function(){
      	window.location="tutormodule.php";
      });
        }
      }
      });
    }
  });
});
  </script>
</body>
</html>