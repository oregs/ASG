<?php
require_once '../../components/connect.php';
session_start();
$tutor_id = intval($_SESSION['tutor_id']);
$query_article = $db->query("SELECT * FROM article_entry INNER JOIN tutor ON tutor.id=article_entry.tutor_id WHERE tutor_id=$tutor_id ORDER BY article_id DESC");
$rowcount = $query_article->num_rows;
?>
<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Article Information</h4>
            </div>
        <div class="modal-body">
            <div class="box-body">
                <div class="row col-sm-offset-2">
                    <div class = "col-lg-10">
                        <form method="POST" id="article_upload" enctype="multipart/form-data">
                            <div id="alert_message"></div>
                               <div class = "form-group">
                                  <label>Article Title:</label>
                                  <input type="text" placeholder="Article Title" id="article" name="article" class="form-control" />
                                </div> 
                                <div class = "form-group">  
                                  <label>Upload Article:</label>
                                  <input type="file" id="docUpload" name="docUpload" class="btn btn-primary ladda-button form-control" />
                                </div>
                                <button type="button" class ="btn btn-primary col-sm-offset-5" name="articleUpload" id="articleUpload" align="center"><span class="glyphicon glyphicon-save"></span> Save</button>
                        </form>
                    </div>
                </div><br/>
                <div id = "assign_table">
                        <table id="tutor_data" class ="table table-bordered table-striped">
                            <thead class ="alert-success">
                                <tr>
                                    <th>Article Title</th>
                                    <th>Document</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                        <?php
                        if($rowcount > 0)
                        {
                            while ($result=$query_article->fetch_assoc()) 
                            {
                                $doc_filepath = explode("/", $result['doc_upload']);  
                        ?>
                            <tr>
                                <td><?php echo $result['article_title']; ?></td>
                                <td><a href="../tutor/article_file/<?php echo $doc_filepath[2] ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-download-alt"></span> download</a></td>
                                <td> <button type="button" name="remove" class="btn btn-danger btn-xs remove" value="<?php echo $result['article_id']; ?>"><span class="glyphicon glyphicon-trash"></span> Delete</button></td>
                            </tr>
                        <?php }} ?>

                                </tbody>
                            </thead>
                        </table>
                    </div>                           
            </div>
        </div>
            <div class="modal-footer">
                <a href="article_entry.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </div>
        </div>
<script>
    $(document).ready(function(){
        $result = $('<center><label>Deleting...</label></center>');
    $('.remove').click(function(){
                $articleID = $(this).attr('value');
            if(confirm("Are you sure you want to remove this?"))
            {
                $(this).parents('td').empty().append($result);
                $('.remove').attr('disabled', 'disabled');
                setTimeout(function(){
                    window.location = 'components/delete_article_entry.php?articleID=' + $articleID;
                }, 1000);
            }
        });
    });
</script>
<script>
  $(document).ready(function(){
    $('#articleUpload').click(function(){

        var form_data = new FormData();
        form_data.append('docUpload', $("#docUpload").prop('files')[0]);
        form_data.append('article', $("#article").val());
        if($("#article").val() == '' || $("#docUpload").val() == ''){

      swal({
            title: "Fields empty!!!",
            text: "Please check the missing field!!!",
            icon: "warning",
            button: "ok",
      });
    }
    else{
        $.ajax({
          url:"components/upload_article_query.php",
          type:"POST",
          data:form_data,
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          success:function(data){
            if(data){
              $('#article_upload')[0].reset();
              swal({
                title: "Article Successfully Submitted",
                icon: "success",
                button: "ok",
          }).then(function(){
                window.location="../tutor/article_entry.php";
      });
        }
          }
        });
      }
  });
});
  </script>