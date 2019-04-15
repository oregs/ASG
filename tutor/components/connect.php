<?php
// connect to the database
$db = mysqli_connect('localhost', 'root', 'password', 'asg');

if ($db->connect_error) 
	die($db->connect_error);


?>