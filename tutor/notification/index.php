<?php include '../components/authenticate.php'; ?>
<!DOCTYPE html>
<html>
 <head>
  <title>Notification using PHP Ajax Bootstrap</title>
	 <link rel="stylesheet" href="assets/css/bootstrap.css" />
   <link rel="stylesheet" href="../../assets/css/font-awesome/font-awesome.css">
 </head>
 <body style = "background-color:#F8F8F8;">

        <!-- Navigation Bar -->        
        <?php include 'navigation.php'; ?>
        
    <div class = "container-fluid">
      <!-- Side Bar -->   
      <?php include 'sidebar.php'; ?> 
    <div class = "col-lg-10 well" style = "margin-top:60px;">
   <form method="post" id="comment_form">
    <div class="form-group">
     <label>Enter Subject</label>
     <input type="text" name="subject" id="subject" class="form-control">
    </div>
    <div class="form-group">
     <label>Enter Comment</label>
     <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
    </div>
    <div class="form-group">
    <select name="level" id="level" class="form-control">
      <option value = "" selected = "selected" disabled = "disabled">Select your Level</option>
        <?php 
          $sql = mysqli_query($db, "SELECT * FROM level ORDER BY level_code  ASC");
          while ($row = $sql->fetch_assoc()){
        
          echo '<option value="'.$row["levelID"].'">'.$row["level_code"].'</option>';
        }
        ?>
        </select>
      </div>
    <div class="form-group">
     <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
    </div>
   </form>
   
  </div>
</div>
<nav class = "navbar navbar-default navbar-fixed-bottom">
      <div class = "container-fluid">
        <label class = "navbar-text pull-right">Assignment Submission & Grading System &copy; All rights reserved 2018</label>
      </div>
    </nav>
 </body>
</html>
 <script src="assets/js/jquery-1.11.1.min.js"></script>
<script src = "../../js/popper.min.js"></script>
  <script src = "../../js/bootstrap.js"></script>
  <script src = "../../js/sweetalert.js"></script>
<script src="assets/js/sidebar.js"></script>
<script>
$(document).ready(function(){
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#comment').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     swal({
                title: "Notification Sent",
                icon: "success",
                button: "ok",
          })
    }
   });
  }
  else
  {
   swal({
            title: "Fields empty!!!",
            text: "Please check the missing field!!!",
            icon: "warning",
            button: "ok",
      });
  }
 }); 
});
</script>
