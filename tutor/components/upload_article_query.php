<?php
require_once 'connect.php';
session_start();

$tutor_id = intval($_SESSION['tutor_id']);
// die(var_dump($_FILES["docUpload"]["tmp_name"], $_POST['article']));
if(!empty($_FILES["docUpload"]["tmp_name"]) || !empty($_POST['article']))
{
	$article = mysqli_real_escape_string($db, $_POST['article']);
	$upload_date = date("Y-m-d h:i:sa");
	$target_dir = '../article_file/';
        $original_filename = $_FILES["docUpload"]["name"];

        $uploadOk = 1;
        $FileType = pathinfo($original_filename,PATHINFO_EXTENSION);

        // Get filename without extension
        $filename_without_ext = basename($original_filename, '.'.$FileType);

        // Generate new filename
        $new_filename = $target_dir.str_replace(' ', '_', $filename_without_ext) . '_' . time() . '.' . $FileType;

        //Check if file already exists
        if (file_exists($new_filename)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["docUpload"]["size"] > 30000000) {
            echo '<p style="color:red;">Sorry, your file is too large.</p>';
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($FileType != "txt" && $FileType != "docx" && $FileType != "pdf") {
            echo "Only txt, docx and pdf files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo '<p style="color:green;">Sorry, your file was not uploaded.</p>';
        // if everything is ok, try to upload file
        } 
        else {
        	move_uploaded_file($_FILES["docUpload"]["tmp_name"], $new_filename);
        	$q_article = $db->query("INSERT INTO article_entry(article_title, doc_upload, upload_date, tutor_id) VALUES('$article', '$new_filename', '$upload_date', $tutor_id)");
        	header('Location: ../article_entry.php');
        }
}
?>