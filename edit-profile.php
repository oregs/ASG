<?php include 'valid.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>  
<body style = "background-color:#d3d3d3;">   
              <!-- Navigation Bar -->
                <?php include 'navigation.php'; ?>                    
            
<div class = "container-fluid">
<?php include 'sidebar.php'; ?>

<div class = "col-lg-9 well" style = "margin-top:60px;">   
    <div class="container">
       <div class="no-gutter row"> 
           <div class="col-md-9">
               <div class="panel panel-default" id="sidebar">
                   <div class="panel-body">                
<?php
    $matricNum=$_SESSION['matricNum'];          
    $sql = "SELECT * FROM student where matricNum='$matricNum'";
    $result = mysqli_query($db,$sql) or die(mysqli_error($db)); 
    $rws = mysqli_fetch_array($result);
?> 
          
<?php include 'controllers/form/edit-profile-form.php' ?>
                   </div>
               </div>
           </div>
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