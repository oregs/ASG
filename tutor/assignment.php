<?php include 'components/authenticate.php'; ?>

<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="Admin/dashboard/image/logo.gif" rel="shortcut icon"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="../css/sb-admin.css" rel="stylesheet">
</head>
<title>New Assignment - ASG</title>
<body style = "background-color:#F8F8F8;">
 
      <!-- Navigation Bar -->
        <?php include 'navigation.php'; ?>
        
 <div id="wrapper">
      <!-- Sidebar -->

    <div id="content-wrapper">
     <div class="container-fluid">
      <?php include 'sidebar.php'; ?>
    <div class = "col-lg-10 well" style = "margin-top:60px;>
    <h3 align="center" class="display-5">New Assignment</h3>

    <div id="message" style="text-align: center; margin-top: 5px;"></div>

    <button class="tablink" onclick="openPage('questiontext', this, '#0275d8')" id="defaultOpen">Multiple Questions</button>
    <button class="tablink" onclick="openPage('questionfile', this, '#0275d8')">File Upload</button>

   <!-- Multiple Assignment -->
   <?php include 'multipleassignment.php'; ?>

    <!-- Single Assignment -->
    <?php include 'singleassignment.php'; ?>
</div>
</div>
</div>
</div>
<nav class = "navbar navbar-default navbar-fixed-bottom">
      <div class = "container-fluid">
        <label class = "navbar-text pull-right">Assignment Submission & Grading System &copy; All rights reserved 2018</label>
      </div>
    </nav>

  <script src = "../js/display.js"></script>
  <script src = "../js/popper.min.js"></script>
  <script src = "../js/sweetalert.js"></script>
  <script src = "../js/jquery.multifield.min.js"></script>
  <script src = "../js/sidebar.js"></script>
  <script src="../js/sb-admin.js"></script>
  <script>
    $('.content').multifield({
      section: '.group',
      btnAdd: '#btnAdd',
      btnRemove: '.btnRemove',
      max: 20
    });
  </script>
  <script>
    //JQuery for Posting assignment to the Server (Multiple Question)
  $(document).ready(function(){
    $("#multiple_ass").click(function(){

    var question = $("#question").val();
    var score = $(".score").val();
    var date = $("#submission_date").val();
    var time = $("#submission_time").val();
    var multipleAss = $('#multiple_data').serialize();

    if(question == '' || score == '' || date == '' || time == ''){

      swal({
            title: "Fields empty!!!",
            text: "Please check the missing field!!!",
            icon: "warning",
            button: "ok",
      });
    }
    else{
      $.ajax({
        url:"components/query-multiple-assignment.php",
        method:"POST",
        data:multipleAss,
        success:function(data){
          if(data){
            $('#multiple_data')[0].reset();
          swal({
            title: "Successfully Submitted",
            icon: "success",
            button: "ok",
            // allowOutsideClick: false,
            // allowEscapeKey: false
      });
        }
      }
      });
    }
  });
});
  </script>
  <script>
  //JQuery for Posting assignment to the Server (Upload Question)
  $(document).ready(function(){
    $('#submit').click(function(){

        var form_data = new FormData();
        form_data.append('questionfile', $("#questionfile input[type='file']")[0].files[0]);
        form_data.append('score', $("#score").val());
        form_data.append('questiontext', $("#q_text").val());
        form_data.append('ass_d', $("#ass_d").val());
        form_data.append('courseCode', $("#courseCode").val());
        form_data.append('subTime', $("#subTime").val());
        form_data.append('subDate', $("#subDate").val());
        form_data.append('format', $("#format").val());
        form_data.append('groupName', $("#groupName").val());
        form_data.append('format', $("#format").val());
        if($("#score").val() == '' || $("#subTime").val() == '' || $("#subDate").val() == ''){

      swal({
            title: "Fields empty!!!",
            text: "Please check the missing field!!!",
            icon: "warning",
            button: "ok",
      });
    }
    else{
        $.ajax({
          url:"components/query_assignment.php",
          type:"POST",
          data:form_data,
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          success:function(data){
            if(data){
              $('#assignment_data')[0].reset();
              swal({
                title: "Successfully Submitted",
                icon: "success",
                button: "ok",
          });
        }
          }
        });
      }
  });
// jQuery Script for getting available group from the Server for a particular course.
    $('#course_code').change(function(){
      if($(this).val() != '')
      {
        var action = $(this).attr("id");
        var query = $(this).val();
        var result = '';
        if(action == 'course_code')
        {
          result = 'groups';
        }
        $.ajax({
          url:"components/get_group.php",
            method:"POST",
            data:{action:action, query:query},
            success:function(data){
              $('#'+result).html(data);
            }
        })
      }
    });

    $('#courseCode').change(function(){
      if($(this).val() != '')
      {
        var action = $(this).attr("id");
        var fetch = $(this).val();
        var result = '';
        if(action == 'courseCode')
        {
          result = 'groupName';
        }
        $.ajax({
          url:"components/get_group_upload.php",
            method:"POST",
            data:{action:action, fetch:fetch},
            success:function(data){
              $('#'+result).html(data);
            }
        })
      }
    });
});
  </script>
</body>  
</html>

