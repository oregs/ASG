<?php 
// Delete.php
require 'connect.php';

if (!empty(intval($_REQUEST['id'])))
{
    $sub_id = explode('_', $_REQUEST['id']);
    $member_id = $sub_id[0];
    $group_id = $sub_id[1];

    $q_group = $db->query("DELETE FROM group_assignment WHERE group_id=$group_id");
	$query = "DELETE FROM group_member WHERE member_id = $member_id";
	if(mysqli_query($db, $query))
	{
		// echo 'Data Deleted';
		header('Location: ../create-group.php');
	}
}

	
?>