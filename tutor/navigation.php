<?php
    $staffId=$_SESSION['staffId'];          
    $sql = "SELECT * FROM tutor where staffId='$staffId'";
    $result = mysqli_query($db,$sql) or die(mysqli_error($db)); 
    $row = mysqli_fetch_array($result);
?> 
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <a href="tutormodule.php"><li ><img src="../images/ASG-logo.png" width = "50px" height = "50px" />
        <h4 class = "navbar-text navbar-right">ASG System</h4></li></a>
    </ul>
    <!-- Button trigger modal -->
    <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo $row['tutor_fname'];?> <?php echo $row['tutor_lname'];?><strong class="caret"></strong></a>                  
                        <ul class="dropdown-menu">
                            <li>
                                <a href="edit-profile.php"><i class="fa fa-edit"></i> Edit Profile</a>
                                <a href="change_password.php"><i class="fa fa-key"></i> Change of Password</a>
                            </li>
                        </ul>
                    </li>   
                    <li>
                        <a href="../components/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>  
                </ul>  
  </div>  
  </div>
</nav>    