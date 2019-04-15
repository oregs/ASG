<?php include 'valid.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>
<?php
$date = date("Y-m-d h:i:sa");
// Getting the id of the assignment details and store it into a session variable.
if (!empty(intval($_GET['id'])))
{
    $sub_id = explode('_', $_GET['id']);
    $ass_id = $sub_id[0];
    $_SESSION['ass_id']= intval($ass_id);
    
  if(count($sub_id) == 2)
  {
    $group_id = $sub_id[1];
    $_SESSION['group_id'] = intval($group_id);
    
  }
}
?>
<body style = "background-color:#F8F8F8;">   
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
          
<?php include 'controllers/form/submit-assignment-form.php' ?>
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
  <script src = "js/popper.min.js"></script>
  <script src = "js/sweetalert.js"></script>
<script src = "js/sidebar.js"></script>
<script>
  $(document).ready(function(){
    $('#submit').click(function(){

        var form_data = new FormData();
        if($('.type').val() == 'single')
        {
          form_data.append('myfile', $("#myfile").prop('files')[0]);
          var status = $(".status").val();
          var url=$('#assignmentData').attr("action");
        }
        else
        {
          var multiAnswer = $("#multiData").serialize();
          var status = $(".status").val();
          var urls = $('#multiData').attr("action");
        }
        if($("#myfile").val() == '' || $("#answer").val() == ''){

          swal({
                title: "Field empty!!!",
                text: "Answer not supplied!!!",
                icon: "warning",
                button: "ok",
      });
    }
    else if(status == 'Graded'){
      swal({
                title: "Assignment not Updated, graded already!!!",
                icon: "warning",
                button: "ok",
      }).then(function(){
            window.location="studentmodule.php";
          });
    }
    else{
      if($('.type').val() == 'single'){
        $.ajax({
          url:url,
          type:"POST",
          data:form_data,
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          success:function(data){
            if(data){
              // $('#assignment_data')[0].reset();
              swal({
                title: "Successfully Submitted",
                icon: "success",
                button: "ok",
          }).then(function(){
            window.location="studentmodule.php";
            });
        }
          }
        });
      }
      else{
          $.ajax({
          url:urls,
          type:"POST",
          data:multiAnswer,
          success:function(data){
            if(data){
              $('#multiData')[0].reset();
              swal({
                title: "Successfully Submitted",
                icon: "success",
                button: "ok",
          }).then(function(){
            window.location="studentmodule.php";
            });
        }
          }
        });
      }
    }
  });
});
  </script>
