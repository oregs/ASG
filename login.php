<div class="tab-pane active" id="Login">
    <form method="post" class="form-horizontal" id="loginData" onsubmit="return student_login();">
        <!-- Display a login error -->
            <div class="form-group" id="show_msg" style="display:none;">
                <div class="error">
                    <span class="text-danger font-weight-bold" id="msg_error"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="text" class="col-sm-3 control-label">
                    Matric No.</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Matric Number" name="matricno" id="matricno" />
                    <span class="text-danger font-weight-bold" id="matric_error"></span>
                </div>
			</div>
          
            <div class="form-group">
                <label for="password" class="col-sm-3 control-label">
                    Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="pass" placeholder="Password" name="pass" autocomplete="off" />
                    <span class="text-danger font-weight-bold" id="password_error"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary btn-sm" name="login">Submit</button>
                    <a href="">Forgot your password?</a>
                </div>
            </div>
		</form>
</div>