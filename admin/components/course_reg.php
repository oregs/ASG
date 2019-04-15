<?php
//coursereg.php
require_once 'connect.php';
$column = array("course.courseCode", "course.courseName", "course.courseUnit", "level.level_code");

$query = "SELECT * FROM course
INNER JOIN level ON level.levelID=course.level";

$query .= " WHERE ";
// Search
if(isset($_POST["search"]["value"]))
{
	$query .= '
	course.courseCode LIKE "%'.$_POST["search"]["value"].'%"
	OR course.courseName LIKE "%'.$_POST["search"]["value"].'%" 
	OR course.courseUnit LIKE "%'.$_POST["search"]["value"].'%" 
	OR level.level_code LIKE "%'.$_POST["search"]["value"].'%"';
}

//Order
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
	';
}
else
{
	$query .= 'ORDER BY course.courseID DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
	$query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($db, $query));
$result = mysqli_query($db, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
	$sub_array = array();
	$sub_array[] =  '<div contenteditable class="update" data-id="'.$row["courseID"].'" data-column="courseCode">' . $row["courseCode"] . '</
					div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["courseID"].'" data-column="courseName">' . $row["courseName"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["courseID"].'" data-column="courseUnit">' . $row["courseUnit"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["courseID"].'" data-column="level">' . $row["level_code"] . '</div>';
	$sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["courseID"].'">Delete</button>';
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
