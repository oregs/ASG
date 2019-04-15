<div class = "alert alert-info">Submission / Grading</div><br />
					<div id = "grade_table">
						<table id = "table" class="table table-bordered table-striped">
							<thead class = "alert-success">
								<tr>
									<th>S/N</th>
									<th>Matric No.</th>
									<th>Full Name</th>
									<th>Assignment Details</th>
									<th>Course Code</th>
									<th>Submission Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$tutor_id = intval($_SESSION['tutor_id']);
									$q_submission = $db->query("SELECT a.id, a.sub_answer, a.assignment_id, a.ass_details, a.course_code, a.student_id, a.submission_date, a.status, s.matricNum, s.student_firstname, s.student_lastname FROM assignmentsubmission a, student s, courseassign n, course c WHERE a.student_id=s.id AND a.course_code=c.courseCode AND n.course = c.courseID AND n.tutor=$tutor_id AND status='Ungraded'");
									while ($row = $q_submission->fetch_assoc()) {
										$name = $row['student_lastname'].' '.$row['student_firstname'];
										$course_code = $row['course_code'];
								?>
								<tr>
									<td><?= $row['id']; ?></td>
									<td><?= $row['matricNum']; ?></td>
									<td><?= $name ?></td>
									<td><?= str_replace('_', ' ', $row['ass_details']); ?></td>
									<td><?= $course_code ?></td>
									<td><?= $row['submission_date']; ?></td>
								
									<td><a href="load_submission.php?ass_id=<?= $row['assignment_id']; ?>_<?= $row['course_code'];?>_<?= $row['student_id'];?>" class="btn btn-primary btn-sm ass_id" value=""><span class = "glyphicon glyphicon-edit"></span> <?php echo $row['status']; ?></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>