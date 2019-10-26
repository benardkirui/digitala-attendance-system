<?php
session_start();
include '../database/DAO.php';
$dao = new DAO();
$report_id = $_GET['id'];
$result=$dao->get_existing_comments($report_id);
$row= mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Assign Supervisor</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(
            function()
            {
                $("#modal").fadeIn(1000);
                $("#submit").click(
                    function()
                    {
                        var comments=$("#comments").val();
                        var report_id=$('#report').val();
                        if(comments.length <5)
                        {
                            $('.modal-title').html("Give more comments").addClass("alert-danger");
                        }
                        else{
                            $.post('linking.php',{makeComments:"makeComments",comments:comments,report_id:report_id},
                                function(data,status)
                                {
                                    if(data == 'yes')
                                    {
                                        $('.modal-body').remove();
                                        $('.modal-footer').remove();
                                        $('.modal-content').addClass('bg-success');
                                        $('.modal-title').html("Comments  Made Succesfully");
                                    }
                                    else{
                                        $('.modal-body').remove();
                                        $('.modal-footer').remove();
                                        $('.modal-content').addClass('bg-danger');
                                        $('.modal-title').html("Failed to make Comments");
                                    }
                                }
                            );

                        }
                    }
                );
            }
        );

    </script>
</head>
<body>
<input type="hidden" id="report" value="<?=$report_id?>">
<div class="modal" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bomet County Government</h4>
                <button type="button" class="close" onclick="window.history.back()">X</button>

            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="supervisor">Make comments</label>
                    <textarea class="form-control" id="comments" placeholder="Describe the task here" rows="3"><?=$row['comments']?></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success " id="submit">Submit</button>
                <button type="button" class="btn btn-danger" onclick="window.history.back()">Close</button>
            </div>
        </div>
    </div>
</div>
</body>


<style>
    body{
        background-color: #0d6aad;
    }
</style>
</html>
