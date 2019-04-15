<form action="components/update-profile.php" method="post" enctype="multipart/form-data" id="UploadForm">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#personal" data-toggle="tab">Profile</a></li>
      <li><a href="#general" data-toggle="tab">Edit</a></li>
    </ul>
    <!-- Tab panes -->
     <div class="tab-content">
        <div class="tab-pane fade in active" id="personal">
            <h5 class="navbar navbar-inverse" style="color:white; font-size:30px;">Personal Information</h5>
            
            <div class="col-md-6">
                <div class="form-group float-label-control"> 
                    <label class="col-sm-5" for="">Matric Number:</label>
                    <div><?php echo $rws['matricNum'];?></div>
                </div>
                <div class="form-group float-label-control"> 
                    <label class="col-sm-5" for="">Full Name:</label>
                    <div><?php echo $rws['student_firstname'];?> <?php echo $rws['student_lastname'];?></div>
                </div>
                <div class="form-group float-label-control"> 
                    <label class="col-sm-5" for="">Gender:</label>
                    <div><?php echo $rws['gender'];?></div>
                </div>
                 <div class="form-group float-label-control"> 
                    <label class="col-sm-5" for="">Email:</label>
                    <div><?php echo $rws['email'];?></div>
                </div> 
                 <div class="form-group float-label-control"> 
                    <label class="col-sm-5" for="">Telephone:</label>
                    <div><?php echo $rws['phone'];?></div>
                </div>
                 <div class="form-group float-label-control"> 
                    <label class="col-sm-5" for="">Address:</label>
                    <div><?php echo $rws['address'];?></div>
                </div>             
            </div>
        </div> 
        <div class="tab-pane fade" id="general"> 
            <div class="col-md-6">
                <div class="form-group float-label-control">  
                    <label for="">Matric Number</label>
                    <fieldset disabled> 
                                <input type="text" class="form-control" placeholder="<?php echo $rws['matricNum'];?>" name="matricNum" value="<?php echo $rws['matricNum'];?>" id="disabledTextInput" autocomplete="off">
                            </fieldset>  
                </div>
                <div class="form-group float-label-control">                      
                    <label for="">First Name</label>
                    <input type="text" class="form-control" placeholder="<?php echo $rws['student_firstname'];?>" name="student_firstname" value="<?php echo $rws['student_firstname'];?>">
                </div>
                <div class="form-group float-label-control">                      
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" placeholder="<?php echo $rws['student_lastname'];?>" name="student_lastname" value="<?php echo $rws['student_lastname'];?>">
                </div>
                <div class="form-group float-label-control">                      
                    <label for="">Phone Number</label>
                    <input type="text" class="form-control" placeholder="<?php echo $rws['phone'];?>" name="phone" value="<?php echo $rws['phone'];?>">
                </div>
                <div class="form-group float-label-control">
                    <label for="">Avatar</label>
                    <center><input name="ImageFile"  id="uploadFile" class="btn btn-primary ladda-button" data-style="zoom-in"  type="file" value="<?php echo $rws['student_avatar'];?>"/></center>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group float-label-control">                      
                    <label for="">Email</label>
                    <input type="text" class="form-control" placeholder="<?php echo $rws['email'];?>" name="email" value="<?php echo $rws['email'];?>">
                </div>
                <div class="form-group float-label-control">                      
                    <label for="">Address</label>
                    <textarea class="form-control" placeholder="<?php echo $rws['address'];?>" rows="10" name="address" value="<?php echo $rws['address'];?>"><?php echo $rws['address'];?></textarea>
                </div>
                <label for="">Gender</label>              
                <div class="form-group float-label-control">
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="gender" id="optionsRadios1" value="Male" checked>Male</label>
                    </div>              
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="gender" id="optionsRadios1" value="Female">Female</label>
                    </div>
                </div>
            </div>
                <div class="submit">
                <center>
                    <button class="btn btn-primary ladda-button" data-style="zoom-in" type="submit"  id="SubmitButton" value="Upload" />Save Your Profile</button>
                </center>
            </div>
        </div>
     </div>
</form>