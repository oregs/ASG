<?php
    // ini_set("display_errors",1);

session_start();
$staffId=$_SESSION['staffId'];
if(isset($_POST)){
    require 'connect.php';

    $Destination = '../userfiles/avatars';
        if(!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name'])){
            $NewImageName= 'default.jpg';
            move_uploaded_file($_FILES['ImageFile']['tmp_name'], "$Destination/$NewImageName");
        }
        else{
            $RandomNum = rand(0, 9999999999);
            $ImageName = str_replace(' ','-',strtolower($_FILES['ImageFile']['name']));
            $ImageType = $_FILES['ImageFile']['type'];
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.','',$ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
            move_uploaded_file($_FILES['ImageFile']['tmp_name'], "$Destination/$NewImageName");
        }

        $sql5="UPDATE tutor SET tutor_avatar='$NewImageName' WHERE staffId='$staffId'";
        $sql6="INSERT INTO tutor (tutor_avatar) VALUES ('$NewImageName') WHERE staffId = '$staffId'";
        $result = mysqli_query($db,"SELECT * FROM tutor WHERE staffId = '$staffId'");
        if( mysqli_num_rows($result) > 0) {
            if(!empty($_FILES['ImageFile']['name'])){
                mysqli_query($db,$sql5)or die(mysqli_error($db));
                header("location:../edit-profile.php?staffId=$staffId&request=profile-update&status=success");
            }
        } 
        else {
            mysqli_query($db,$sql6)or die(mysqli_error($db));
            header("location:../edit-profile.php?staffId=$staffId&request=profile-update&status=success");
        }  
        

    $tutor_fname=$_REQUEST['tutor_fname'];
    $tutor_lname=$_REQUEST['tutor_lname'];
    $tutor_phone=$_REQUEST['tutor_phone'];
    $tutor_email=$_REQUEST['tutor_email'];
    $tutor_gender=$_REQUEST['gender'];
    $tutor_address=$_REQUEST['tutor_address'];
        
    $sql3="UPDATE tutor SET tutor_fname='$tutor_fname',tutor_lname='$tutor_lname',tutor_phone='$tutor_phone',tutor_email='$tutor_email',tutor_gender='$tutor_gender',tutor_address='$tutor_address' WHERE staffId = '$staffId'";
        $staffId=$_SESSION['staffId'];
    mysqli_query($db,$sql3)or die(mysqli_error($db));
    header("location:../edit-profile.php?staffId=$staffId&request=profile-update&status=success");
    }    
?>