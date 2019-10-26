<?php
include 'database/DAO.php';
$dao = new DAO();
$result =$dao->selectSupervisors();
$attachee = $_GET['idnumber'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Assign Supervisor</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(
            function()
            {
                $("#modal").fadeIn(1000);
                $("#submit").click(
                    function()
                    {
                        var sup = $('#supervisor').val();
                        var attachee = $("#attachee").val();

                        $.post('register.php',{assignSup:"assignSup",sup:sup,attachee:attachee},
                        function(data,status)
                        {
                            if(data == 'yes')
                            {
                                $('.modal-body').remove();
                                $('.modal-footer').remove();
                                $('.modal-content').addClass('bg-success');
                                $('.modal-title').html("Supervisor assigned Succesfully");
                            }
                            else{
                                $('.modal-body').remove();
                                $('.modal-footer').remove();
                                $('.modal-content').addClass('bg-danger');
                                $('.modal-title').html("Failed to assign");
                            }
                        }
                        );
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
                <p>Assign Supervisor</p>
                <div class="form-group">
                    <label for="supervisor">Choose Supervisor</label>
                    <select class="form-control" id="supervisor">
                        <?php
                        while($row = mysqli_fetch_assoc($result))
                        {
                            ?>
                            <option><?=$row['fullname']." - ".$row['idnumber']?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success " id="submit">Submit</button>
                <button type="button" class="btn btn-danger" onclick="window.location.assign('attachees_table.php')">Close</button>
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
