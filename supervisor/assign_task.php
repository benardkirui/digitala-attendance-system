<?php
session_start();
include '../database/DAO.php';
$dao = new DAO();
$attachee = $_GET['idnumber'];
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
                        var task = $('#task').val();
                        var attachee = $("#attachee").val();
                        if(task.length <5)
                        {
                            $('.modal-title').html("Give more description of the task").addClass("alert-danger");
                        }
                        else{
                            $.post('linking.php',{assignTask:"assignTask",task:task,attachee:attachee},
                                function(data,status)
                                {
                                    if(data == 'yes')
                                    {
                                        $('.modal-body').remove();
                                        $('.modal-footer').remove();
                                        $('.modal-content').addClass('bg-success');
                                        $('.modal-title').html("Task assigned Succesfully");
                                    }
                                    else{
                                        $('.modal-body').remove();
                                        $('.modal-footer').remove();
                                        $('.modal-content').addClass('bg-danger');
                                        $('.modal-title').html("Failed to assign Task");
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
<input type="hidden" id="attachee" value="<?=$attachee?>">
<div class="modal" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bomet County Government</h4>
                <button type="button" class="close" onclick="window.history.back()">X</button>

            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="supervisor">State Task</label>
                    <textarea class="form-control" id="task" placeholder="Describe the task here" rows="3"></textarea>
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
