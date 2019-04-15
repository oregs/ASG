<?php require 'components/authenticate.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>
<html lang = "eng">
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content = "width=device-width, initial-scale=1" />
	</head>
	<style>
.jumbotron h1 {
  font-size: 40px;
}
.btn-huge{
    padding-top:20px;
    padding-bottom:20px;
}
</style>
	<body style = "background-color:#d3d3d3;">
		<?php include 'controllers/form/navigation.php'; ?>
<div class = "col-lg-10">
	<div id="wrapper" class="wrapper" style = "margin-top:30px;">
		<!-- <div class="container"> -->
    <div class="row col-sm-offset-2">
        <div class="col-lg-12">
                
                    <div class="row">
                        <div class="col-md-4 ">
				          <div class="form-group">
				             <a href="addCourse.php" class="btn btn-success btn-lg btn-block btn-huge" role="button"><span class="glyphicon glyphicon-book"></span> <br/>Course Registration</a> 
				          </div>
				        </div>
				        <div class="col-md-4 ">
				          <div class="form-group">
				             <a href="tutor_reg.php" class="btn btn-primary btn-lg btn-block btn-huge" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Lecturer Management</a> 
				          </div>
				        </div>
				        <div class="col-md-4 ">
				          <div class="form-group">
				             <a href="student.php" class="btn btn-info btn-lg btn-block btn-huge" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Student Management</a> 
				          </div>
				        </div>
                        </div><br><br>
                        <div class="row">
                        <div class="col-md-4 ">
				          <div class="form-group">
				             <a href="assignment_submission_archive.php" class="btn btn-success btn-lg btn-block btn-huge" role="button"><span class="glyphicon glyphicon-lock"></span> <br/>Assignment Archive</a> 
				          </div>
				        </div>
				        <div class="col-md-4 ">
				          <div class="form-group">
				             <a href="article_entry.php" class="btn btn-primary btn-lg btn-block btn-huge" role="button"><span class="glyphicon glyphicon-upload"></span> <br/>Article Entry</a> 
				          </div>
				        </div>
				        <div class="col-md-4 ">
				          <div class="form-group">
				             <a href="result.php" class="btn btn-info btn-lg btn-block btn-huge" role="button"><span class="glyphicon glyphicon-th-list"></span> <br/>Assignment Result</a> 
				          </div>
				        </div>
                        </div>
                    </div>					
	</div>			
</div>
		<nav class = "navbar navbar-default navbar-fixed-bottom navbar-inverse">
			<div class = "container-fluid">
				<label class = "navbar-text pull-right">Assignment Submission & Grading System &copy; All rights reserved 2018</label>
			</div>
		</nav>

	</body>