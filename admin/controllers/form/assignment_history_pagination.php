<?php
require_once '../../components/connect.php';

$student_id = $_SESSION['student_id'] = intval($_POST['studentID']);
$assignment_id = $_SESSION['assignment_id']  = intval($_POST['assignmentID']);

$q_sub = $db->query("SELECT a.sub_answer, a.score_array, d.sub_question, d.sub_score FROM assignmentsubmission a, courseassign e, course c, assignmentdetail d WHERE a.student_id=$student_id AND e.course=c.courseID AND a.assignment_id=$assignment_id AND d.id=$assignment_id");
    while ($r=$q_sub->fetch_assoc()) 
    {
        $sub_question = json_decode($r['sub_question']);
        $sub_answer = json_decode($r['sub_answer']);
        $sub_score = json_decode($r['sub_score']);
        $score_array = json_decode($r['score_array']);
    }
//This check if the multiple question and answer is not empty
if(!empty($sub_question) && !empty($sub_answer))
{
        $page = '';  
        $limit = 1; //define the number of content to be in page
        $output = '';

    if(isset($_POST["page"]))  
    {  
      $page = $_POST["page"];  
    }  
    else  
    {  
      $page = 1;  
    }  
        //This where the logic of pagination is calculated
        //Pagination calaculation for Question
        $qty_pages = ceil(count($sub_question) / $limit);
        $curr_page = isset($_POST['page']) ? $_POST['page'] : 1;  //Current pages should start from 1
        $offset = ($curr_page - 1) * $limit; 
        $sub_question = array_slice($sub_question, $offset, $limit);
        
        //Pagination calaculation for Answer
        $qty_pages = ceil(count($sub_answer) / $limit);
        $curr_page = isset($_POST['page']) ? $_POST['page'] : 1;         
        $offset = ($curr_page - 1) * $limit;
        $sub_answer = array_slice($sub_answer, $offset, $limit);

        if(!empty($sub_score) && !empty($score_array))
        {
            //Pagination calaculation for sub_score
            $qty_pages = ceil(count($sub_score) / $limit);
            $curr_page = isset($_POST['page']) ? $_POST['page'] : 1;         
            $offset = ($curr_page - 1) * $limit;
            $sub_score = array_slice($sub_score, $offset, $limit);

            //Pagination calaculation for Marked
            $qty_pages = ceil(count($score_array) / $limit);
            $curr_page = isset($_POST['page']) ? $_POST['page'] : 1;         
            $offset = ($curr_page - 1) * $limit;
            $score_array = array_slice($score_array, $offset, $limit);

    }
}
?>
<?php
//iterating the Question and Answer out of an array
if(!empty($sub_question) && !empty($sub_answer) && !empty($sub_score) && !empty($score_array)){
    foreach($sub_question as $question)
    {
        foreach($sub_answer as $answer)
        {
            foreach($sub_score as $scores)
            { 
                foreach($score_array as $array_score)
                {
                   $output .= '<div class="row">
                            <div class="form-group col-sm-5">
                                <h4 class="color"><strong>Question:</strong></h4>
                            </div>';
                    if(!empty($scores)){
                    $output .= '<div class="col-sm-5">
                                <h4 class="color"><strong>Expected Score:  <span>'.$scores.'</span></strong>
                            </div>';
                    }                                       
                    $output .= '</div>
                    <div class="row">
                        <label>'.$question.'</label>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-5">
                            <h4 class="color"><strong>Answer:</strong></h4>
                        </div>';
                    if(!empty($array_score)){
                        $output .= '<div class="col-sm-5">
                            <h4 class="color"><strong>Score Awarded:  <span>'.$array_score.'</span></strong>
                        </div>';
                    }                                       
                    $output .='</div>
                    <div class="row">
                        <label>'.$answer.'</label>
                    </div><br>';                                 
                }
            }
        }
    }
}
else
{
   foreach($sub_question as $question)
    {
        foreach($sub_answer as $answer)
        {
           $output .= '<div class="row">
                        <div class="form-group col-sm-5">
                            <h4 class="color"><strong>Question:</strong></h4>
                        </div>
                    </div>
                    <div class="row">
                        <label>'.$question.'</label>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-5">
                            <h4 class="color"><strong>Answer:</strong></h4>
                        </div>                                  
                    </div>
                    <div class="row">
                        <label>'.$answer.'</label>
                    </div><br>';                                 
        }
    } 
}
 //Pagination Number order for the page link
 $output .= '<div class="row">';
 for($i=1; $i<=$qty_pages; $i++)  
 {  
      $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
 }  
 $output .= '</div></div><br /><br />';  
 echo $output;  

 ?>