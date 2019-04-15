<?php
require_once '../../components/connect.php';
session_start();

$tutor = intval($_SESSION['tutor_id']);
$id = intval($_REQUEST['id']);
$q_group = $db->query("SELECT * FROM group_assignment g, group_member m, course c, student s WHERE tutor_id=$tutor AND m.group_id=$id AND m.course_id=c.courseID AND m.student_id=s.id GROUP BY matricNum");
?>
<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Group Information</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<form class="form-horizontal">
						<div id="alert_message"></div>
						<?php
							while($result = $q_group->fetch_assoc()){
								$groupass_id = $result['group_id'];
								$member_id = $result['member_id'];
								$matricNum = $result['matricNum'];
								$name = strtoupper($result['student_lastname'].' '.$result['student_firstname']);
						?>
						<div class="row">
					        <div class="col-md-4 col-sm-offset-2">
					             <div class="form-group">
					                <label><h4><?php echo $name ?></h4></label>
					            </div>
					        </div>
					        <div class="col-md-3">
					             <div class="form-group">
					                <label><h4><?php echo $matricNum ?></h4></label>
					            </div>
					        </div>
					        <div class="col-md-2 .result">
					             <div class="form-group">
					                <button type="button" name="remove" class="btn btn-danger btn-xs remove" value="<?php echo $member_id ?>_<?php echo $groupass_id ?>"><span class="glyphicon glyphicon-trash"></span> Delete</button>
					            </div>
					        </div>
				    	</div>
						<?php } ?>
					</form>						
				</div>
			</div>
			<div class="modal-footer">
				<a href="create-group.php"><button type="button" class="btn btn-danger">Cancel</button></a>
			</div>
		</div>
<script>
$(document).ready(function(){
	$result = $('<center><label>Deleting...</label></center>');
	$('.remove').click(function(){
				$id = $(this).attr('value');
			if(confirm("Are you sure you want to remove this?"))
			{
				$(this).empty().append($result);
				$('.remove').attr('disabled', 'disabled');
				setTimeout(function(){
					window.location = 'components/delete_member.php?id=' + $id;
				}, 1000);
			}
		});
});
</script>