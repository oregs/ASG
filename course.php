<?php require_once'connect.php'; ?>
<div class = "col-lg-10 well" style = "margin-top:60px;">
	<div class = "alert alert-info">Course Registration</div>
		<div class="field-wrap">
			<label>Department:<span class="req"></span></label>
         	<select name="level" id="level">
            	<option value = "" selected = "selected" disabled = "disabled">Select an option</option>
				<?php 
					$sql = mysqli_query($db, "SELECT * FROM level ORDER BY level_code  ASC");
					while ($row = $sql->fetch_assoc()){
				
					echo '<option value="'.$row["levelID"].'">'.$row["level_code"].'</option>';
				}
				?>
				</select>
		</div>
			<div class = "col-lg-1"></div>
			<div class="table_responsive">
				<table id="table" class ="table table-bordered table-striped">
					<thead class ="alert-success">
						<tr>
							<th>Course Code</th>
							<th>Course name</th>
							<th>course Unit</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

		