<?php
    // ini_set("display_errors",1);



session_start();
$matricNum=$_SESSION['matricNum'];
if(isset($_POST)){
    require '../connect.php';

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

        $sql5="UPDATE student SET student_avatar='$NewImageName' WHERE matricNum = '$matricNum'";
        $sql6="INSERT INTO student (student_avatar) VALUES ('$NewImageName') WHERE matricNum = '$matricNum'";
        $result = mysqli_query($db,"SELECT * FROM student WHERE matricNum = '$matricNum'");
        if( mysqli_num_rows($result) > 0) {
            if(!empty($_FILES['ImageFile']['name'])){
                mysqli_query($db,$sql5)or die(mysqli_error($db));
                header("location:../edit-profile.php?matricNum=$matricNum&request=profile-update&status=success");
            }
        } 
        else {
            mysqli_query($db,$sql6)or die(mysqli_error($db));
            header("location:../edit-profile.php?matricNum=$matricNum&request=profile-update&status=success");
        }  
        
    $email=$_REQUEST['email'];
    $student_firstname=$_REQUEST['student_firstname'];
    $student_lastname=$_REQUEST['student_lastname'];
    $phone=$_REQUEST['phone'];
    $gender=$_REQUEST['gender'];
    $address=$_REQUEST['address'];
        
    $sql3="UPDATE student SET student_firstname='$student_firstname',student_lastname='$student_lastname',phone='$phone',gender='$gender',address='$address' WHERE matricNum = '$matricNum'";
        $matricNum=$_SESSION['matricNum'];
    mysqli_query($db,$sql3)or die(mysqli_error($db));
    header("location:../edit-profile.php?matricNum=$matricNum&request=profile-update&status=success");
    }    
?>