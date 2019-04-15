<form action="components/update-registration.php" method="post" enctype="multipart/form-data" id="UploadForm" autocomplete="off">

    <div class="col-md-6">
        <div class="form-group float-label-control">  
            <label for="">Matric Number</label>
            <div> 
                <input type="text" value="<?php echo $matricNum ?>" name="matricNum" class="form-control" readonly>
            </div>  
        </div>
        <div class="form-group float-label-control">
            <label for="">First Name</label>
            <input type="text" class="form-control" placeholder="First Name" id="stud_fname" name="student_firstname" required>
            <span class="text-danger font-weight-bold" id="fname_error"></span>
        </div>
        <div class="form-group float-label-control">
            <label for="">Last Name</label>
            <input type="text" class="form-control"  placeholder="Last Name" id="stud_lname" name="student_lastname" required>
            <span class="text-danger font-weight-bold" id="lname_error"></span>
        </div>
        <label for="">Gender</label>              
                <div class="form-group float-label-control">
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="gender" id="optionsRadios1" value="Male" checked>Male
                        </label>
                    </div>              
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="gender" id="optionsRadios1" value="Female">Female
                        </label>
                    </div>
                </div>
        <div class="form-group float-label-control">
            <label for="">Avatar</label>
            <center><input name="ImageFile" id="ImageFile"  class="btn btn-primary ladda-button" data-style="zoom-in" type="file"/></center>
            <span class="text-danger font-weight-bold" id="file_error"></span>
        </div>           
    </div>    
    <div class="col-md-6">
     <div class="form-group float-label-control">
            <label for="">Phone Number</label>
            <input type="text" class="form-control" placeholder="Phone Number" id="phone" name="phone"  required>
            <span class="text-danger font-weight-bold" id="phone_error"></span>
        </div>
        <div class="form-group float-label-control">
            <label for="">Address</label>
            <textarea class="form-control" placeholder="Address" rows="10" name="address"></textarea>
        </div>
   
    </div>          
    <hr> 
    <div class="row">                
        <center><button class="btn btn-primary btn-block" type="submit"  id="SubmitButton" />Save Your Profile</button></center>

    </div>
</form>