<?php
include 'components/authenticate.php';
$student_id = $_GET['s_id'];
$tutor_id = intval($_SESSION['tutor_id']);
$q_submission = $db->query("SELECT a.assignment_id, a.course_code, a.submission_date, a.ass_details, a.format FROM assignmentsubmission a, courseassign e, course c WHERE a.course_code=c.courseCode AND e.tutor=$tutor_id AND a.student_id=$student_id AND e.course=c.courseID ORDER BY a.course_code");
?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>  
<html lang = "eng">
    <head>
        <title>ASG System</title>
        <meta charset = "utf-8" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1" />
        <link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
    </head>

<style>
    th {
        text-align: center;
    }
    tr {
        text-align: center;
    }
</style>

    <body style = "background-color:#F8F8F8;">
        <!-- Navigation Bar -->
            <?php include 'navigation.php'; ?>
    
<div class = "container-fluid">
    <!-- Side Bar -->
    <?php include 'sidebar.php'; ?>
<div class = "col-lg-10 well" style="margin-top:60px;">
    <div class = "alert alert-info">History / Graded</div>
    <table id = "table" class="table table-bordered table-striped">
            <thead class = "alert-success">
                <tr>
                    <th>Course Code</th>
                    <th>Assignment Details</th>
                    <th>Format</th>
                    <th>Submission Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while ($row = $q_submission->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['course_code']; ?></td>
                    <td><?= str_replace('_', ' ', $row['ass_details']); ?></td>
                    <td><?= strtoupper($row['format']); ?></td>
                    <td><?= $row['submission_date']; ?></td>
                    <td><button class="btn btn-primary btn-xs" id="view" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" value="<?= $student_id; ?>_<?= $row['assignment_id']; ?>_<?= $row['ass_details']; ?>"><span class="glyphicon glyphicon-search"></span> view Grade</button></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div id="content-data"></div>
    </div>
</div>
</div><br/><br/><br/>
<nav class = "navbar navbar-default navbar-fixed-bottom">
            <div class = "container-fluid">
                <label class = "navbar-text pull-right">Assignment Submission & Grading System &copy; All rights reserved 2018</label>
            </div>
        </nav>
<script src = "../js/sidebar.js"></script>
<script src = "../js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function(){
        $('.table').DataTable({
            "order":[]
        });

        $(document).on('click', '#view', function(){
            $('#content-data').html('');
            var id = $(this).val();
        $.ajax({
            url:'controllers/form/assignment_submission_history.php',
            type:'POST',
            data:{id:id},
            dataType:'html'
        }).done(function(data){
            $('#content-data').html('');
            $('#content-data').html(data);
        });
    });
    });
</script>
</body>
</html>