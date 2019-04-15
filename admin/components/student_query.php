<?php
//coursereg.php
session_start();
require_once 'connect.php';

$column = array("id", "matricNum", $name='student_lastname'.' '.'student_firstname', "level_code", "phone", "email");

$query = "SELECT * FROM student
INNER JOIN level ON level.levelID=student.level_id";

// Search
if(isset($_POST["search"]["value"]))
{
	$query .= '
	WHERE id LIKE "%'.$_POST["search"]["value"].'%" 
	OR student_firstname LIKE "%'.$_POST["search"]["value"].'%"
	OR student_lastname LIKE "%'.$_POST["search"]["value"].'%"
	OR level_code LIKE "%'.$_POST["search"]["value"].'%"
	OR matricNum LIKE "%'.$_POST["search"]["value"].'%" 
	OR phone LIKE "%'.$_POST["search"]["value"].'%"
	OR email LIKE "%'.$_POST["search"]["value"].'%"
	';
}

//Order
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
	';
}
else
{
	$query .= 'ORDER BY id DESC ';
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
	$name = $row["student_firstname"].' '.$row["student_lastname"];
	$sub_array = array();
	$sub_array[] = $row["id"];
	$sub_array[] = $row["matricNum"];
	$sub_array[] = $name;
	$sub_array[] = $row["level_code"];
	$sub_array[] = $row["phone"];
	$sub_array[] = $row["email"];
	$sub_array[] = '<button  type="button" name="view" id="getView" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row["id"].'"><i class="glyphicon glyphicon-search">&nbsp;</i>Assign Course/View</button>';
	$sub_array[] = '<button type="button" name="edit" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row["id"].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button>
		<a href="student.php?delete='.$row["id"].'" onclick="return confirm(\'Are You sure? \')" name="delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</a>';
	$data[] = $sub_array;
}
function get_all_data($db)
{
	$query = "SELECT * FROM student";
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
