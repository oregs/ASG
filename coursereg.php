<?php
//coursereg.php
$db = mysqli_connect('localhost', 'root', 'password', 'asg');
$column = array("course.courseID", "course.courseCode", "course.courseName", "course.courseUnit");
$query = "
	SELECT * FROM level
	INNER JOIN course
	ON level.levelID = course.level
";
$query .= " WHERE ";
if(isset($_POST["is_level"]))
{
	$query .= "course.level = '".$_POST["is_level"]."' AND";
}
if(isset($_POST["search"]["value"]))
{
	$query .= '(course.courseID LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR course.courseName LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR course.courseCode LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR level.level_code LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY course.courseID ';
}

$query1 = '';

if($_POST["length"] != -1)
{
	$query1 .= 'LIMIT ' . $_POST['start']. ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($db, $query));
$result = mysqli_query($db, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
	$sub_array = array();
	$sub_array[] = $row["courseID"];
	$sub_array[] = $row["courseCode"];
	$sub_array[] = $row["courseName"];
	$sub_array[] = $row["courseUnit"];
	$sub_array[] = '<button value="'.$row['courseID'].'" type="button" name="register" class="btn btn-success btn-xs success" id="registered">Register</button>';
	$data[] = $sub_array;
}
function get_all_data($db)
{
	$query = "SELECT * FROM course";
	$result = mysqli_query($db, $query);
	return mysqli_num_rows($result);
}

$output = array(
	"draw" 				=> intval($_POST["draw"]),
	"recordsTotal" 		=> get_all_data($db),
	"recordsFiltered" 	=> $number_filter_row,
	"data"				=> $data
);

echo json_encode($output);

?>
