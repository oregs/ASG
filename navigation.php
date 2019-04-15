<?php
    $matricNum=$_SESSION['matricNum'];          
    $sql = "SELECT * FROM student where matricNum='$matricNum'";
    $result = mysqli_query($db,$sql) or die(mysqli_error($db)); 
    $row = mysqli_fetch_array($result);
?> 
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <a href="studentmodule.php"><li ><img src="images/ASG-logo.png" width = "50px" height = "50px" />
        <h4 class = "navbar-text navbar-right">ASG System</h4></li></a>
    </ul>
    <!-- Button trigger modal -->
    <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo $row['student_firstname'];?> <?php echo $row['student_lastname'];?><strong class="caret"></strong></a>                  
                        <ul class="dropdown-menu">
                            <li>
                                <a href="edit-profile.php"><i class="fa fa-edit"></i> Edit Profile</a>
                            </li>
                            <li>
                                <a href="change_password.php"><i class="fa fa-key"></i> Change of Password</a>
                            </li>
                        </ul>
                    </li> 
                    <li>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" id="drop" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span><span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>
                                <ul class="dropdown-menu" id="down"></ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="components/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                    </li> 
                  </ul>
  </div>  
  </div>
</nav>
<script>
$(document).ready(function(){
load_unseen_notification();
function load_unseen_notification(view = '')
{
 $.ajax({
  url:"tutor/notification/fetch.php",
  method:"POST",
  data:{view:view},
  dataType:"json",
  success:function(data)
  {
   $('#down').html(data.notification);
   if(data.unseen_notification > 0)
   {
    $('.count').html(data.unseen_notification);
   }
  }
 });
}
$(document).on('click', '#drop', function(){
 $('.count').html('');
 load_unseen_notification('yes');
});

setInterval(function(){ 
 load_unseen_notification();
}, 5000);
 
});
</script>