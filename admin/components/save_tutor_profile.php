<?php
// Update
require_once 'connect.php';
session_start();
$id = intval($_SESSION['id']);

if(isset($_POST['save_profile']))
	{
		 $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		 $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		 $staffId = mysqli_real_escape_string($db, $_POST['staffId']);
		 $phone = mysqli_real_escape_string($db, $_POST['phone']);
		 $email = mysqli_real_escape_string($db, $_POST['email']);
		 $sqlupdate = $db->query("UPDATE tutor SET staffId='$staffId', tutor_fname='$firstname', tutor_lname='$lastname', tutor_phone='$phone', tutor_email='$email' WHERE id=$id");
		 // die(var_dump($sqlupdate));
		 // die(var_dump($result_update));
		 if($sqlupdate){
		 	echo '
			<script>
				alert("Successfully Update data");
				window.location = "../tutor_reg.php";
			</script>
		';
		 }
		else{
			echo '<script>
					alert("Update failed");
					window.location = "../tutor_reg.php";
				</script>';
		}
	}
?>