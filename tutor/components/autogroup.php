<?php
require_once "connect.php";
session_start();
$tutor = intval($_SESSION['tutor_id']);

if (!empty($_POST['course']) && !empty($_POST['per_group'])) {
        $courseId = $_POST['course'];
        $num = $_POST['per_group'];
        // $tutor = $_POST['tutor'];
        $num1 = $num;
    //Select all students offering the course.
    $i = 0; $GroupId = 1;
    $query = "SELECT student FROM courseenroll WHERE course = '$courseId'";
    $result = $db->query($query); 
    $rownum1 = $result->num_rows;

    // Getting the value of course by courseId
    $querycourse = "SELECT courseCode FROM course WHERE courseID = '$courseId'";
    $resultcourse = $db->query($querycourse);
    while ($row = $resultcourse->fetch_assoc()) {
      $course = $row['courseCode'];
    }
    // Ensuring students per group does not exceed the total number of students
    if ($num > $rownum1) {
        ?>
		    <script>
		      alert("Sorry, Students per group cannot exceed the total number of students available");
		     </script>
     	<?php
      return;
    }

    $iterate = ceil($rownum1/$num);
    $rownum = $iterate * $num;
    while ($row = $result->fetch_array()) {
      $student[] = $row['student'];
    }
    while ($num <= $rownum) {
          $groupName = "Group_".$GroupId."(".$course.")";
          $insert_group = $db->query("INSERT INTO group_assignment(course_code,group_name,tutor_id) VALUES((SELECT courseCode FROM course WHERE courseID=$courseId),'$groupName',$tutor)");

          $group_id = mysqli_insert_id($db);
          
          for ($i = $i; $i < $num; $i++) { 
            if ($i == $rownum1) {
                break;
            }
            $stmt = $db->prepare("INSERT INTO group_member(group_id,course_id,student_id) VALUES (?,?,?)");
            $stmt->bind_param("sss",$group_id,$courseId,$student[$i]);
            $stmt->execute();
            // echo "Student added" . $student[$i] . '<br>';
          }
          $num += $num1;
          $GroupId +=1;
      }
      echo "Data Inserted";
    // print_r($student);
 } ?>