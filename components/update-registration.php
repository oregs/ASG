<?php
    require '../connect.php';
    session_start();
    $matricNum = $_SESSION['matricNum'];
    ini_set("display_errors",1);
    if(isset($_POST)){
        // die(var_dump($_POST['student_firstname'], $_POST['student_lastname'], $_POST['phone']));
        // Upload Avatar
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
        $student_firstname=$_REQUEST['student_firstname'];
        $student_lastname=$_REQUEST['student_lastname'];
        $phone=$_REQUEST['phone'];
        $gender=$_REQUEST['gender'];
        $address=$_REQUEST['address'];
        
        
        $sql3="UPDATE student SET student_firstname='$student_firstname',student_lastname='$student_lastname',student_avatar='$NewImageName',phone='$phone',gender='$gender',address='$address' WHERE matricNum = '$matricNum'";
        $matricNum=$_SESSION['matricNum'];

        $sql4="INSERT INTO student (student_firstname,student_lastname,student_avatar,phone,gender,address) VALUES ('$student_firstname','$student_lastname','$NewImageName','$phone','$gender','$address') WHERE matricNum = $matricNum"; 



        $result = mysqli_query($db,"SELECT * FROM student WHERE matricNum = '$matricNum'");
        if( mysqli_num_rows($result) > 0) {
            mysqli_query($db,$sql3)or die(mysqli_error($db));
            header("location:../index.php?matricNum=$matricNum&status=success");
        }
        else{
            mysqli_query($db,$sql4)or die(mysqli_error($db));
            header("location:../../index.php?matricNum=$matricNum&status=sucess");
        }  
    }    
?>