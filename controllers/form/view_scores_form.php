<div class = "alert alert-info">View / Scores</div>					<br />
					<div id = "score_table">
						<table id = "table" class="table table-bordered table-striped">
							<thead class = "alert-success">
								<tr>
									<th>S/N</th>
									<th>Course Code</th>
									<th>Assignment 1</th>
									<th>Assignment 2</th>
									<th>Assignment 3</th>
									<th>Assignment 4</th>
									<th>Assignment 5</th>
									<th>Total Score</th>
									<th>Average Score</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$q_result = $db->query("SELECT *, sum(ifnull(Assignment_1, 0) + ifnull(Assignment_2, 0) + ifnull(Assignment_3, 0) + ifnull(Assignment_4, 0) + ifnull(Assignment_5, 0)) as total FROM assignmentresult WHERE student_id=$student  GROUP BY id");
									while ($row = $q_result->fetch_assoc()) {
										$count = $row['count'];
								?>
								<tr>
									<td><?php echo $row['id']; ?></td>
									<td><?php echo $row['course_code']; ?></td>
									<td><?php echo $row['Assignment_1']; ?></td>
									<td><?php echo $row['Assignment_2']; ?></td>
									<td><?php echo $row['Assignment_3']; ?></td>
									<td><?php echo $row['Assignment_4']; ?></td>
									<td><?php echo $row['Assignment_5']; ?></td>
									<td><?php echo $row["total"]; ?></td>
									<td><?php echo round($row["total"]/$count, 2); ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>