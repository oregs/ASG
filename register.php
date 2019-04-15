				<div class="tab-pane" id="Registration">
                      <form method="post" role="form" class="form-horizontal" action="components/register_query.php" id="regData">
                                <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label">
                                        Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required="" />
                                        <span class="text-danger font-weight-bold" id="email_error"></span>
                                    </div>
									</div>
                                <div class="form-group">
                                    <label for="mobile" class="col-sm-3 control-label">
                                        Matric No.</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="matricNum" placeholder="Matric Number" name="matricNum" required="" />
                                        <span class="text-danger font-weight-bold" id="matricNum_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-3 control-label">
                                        Level</label>
                                    <div class="col-sm-9">
                                    <select name="level" id="level" class="col-sm-3 form-control">
                                      <option value = "" selected = "selected" disabled = "disabled">Select your Level</option>
                                        <?php 
                                          $sql = mysqli_query($db, "SELECT * FROM level ORDER BY level_code  ASC");
                                          while ($row = $sql->fetch_assoc()){
                                        
                                          echo '<option value="'.$row["levelID"].'">'.$row["level_code"].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-3 control-label">
                                        Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password_1"  placeholder="Password" name="password_1" required="" />
                                        <span class="text-danger font-weight-bold" id="password1_error"></span>
                                    </div>
                                </div>
									<div class="form-group">
                                    <label for="password" class="col-sm-3 control-label">
                                        Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password_2"  placeholder="Password"  name="password_2" required="" />
                                        <span class="text-danger font-weight-bold" id="password2_error"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-9">
                                        <button type="submit" name="register" id="submit" class="btn btn-primary btn-sm">Register</button>
                                    </div>
                                </div>
                     </form>
                </div>