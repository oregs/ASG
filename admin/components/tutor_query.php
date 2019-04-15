<?php
//coursereg.php
session_start();
require_once 'connect.php';

$column = array("id", "staffId", $name='tutor_fname'.' '.'tutor_lname', "tutor_phone", "tutor_email");

$query = "SELECT * FROM tutor";

// Search
if(isset($_POST["search"]["value"]))
{
	$query .= '
	WHERE id LIKE "%'.$_POST["search"]["value"].'%" 
	OR staffId LIKE "%'.$_POST["search"]["value"].'%" 
	OR tutor_phone LIKE "%'.$_POST["search"]["value"].'%"
	OR tutor_email LIKE "%'.$_POST["search"]["value"].'%"
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
	$name = $row["tutor_fname"].' '.$row["tutor_lname"];
	$sub_array = array();
	$sub_array[] = $row["id"];
	$sub_array[] = $row["staffId"];
	$sub_array[] = $name;
	$sub_array[] = $row["tutor_phone"];
	$sub_array[] = $row["tutor_email"];
	$sub_array[] = '<button  type="button" name="view" id="getView" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row["id"].'"><i class="glyphicon glyphicon-search">&nbsp;</i>Assign Course/View</button>';
	$sub_array[] = '<button type="button" name="edit" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row["id"].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button>
		<a href="tutor_reg.php?delete='.$row["id"].'" onclick="return confirm(\'Are You sure? \')" name="delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</a>';
	$data[] = $sub_array;
}
function get_all_data($db)
{
	$query = "SELECT * FROM tutor";
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
