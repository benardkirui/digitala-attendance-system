<?php
include "database/DAO.php";
$dao= new DAO();
$_SESSION['error']="";
$number_attachees=$dao->get_number_attachees();
$number_admins=$dao->get_number_admins();
$number_supervisors=$dao->get_number_supervisors();
if(isset($_GET['delAttachee']))
{
    $idnumber=$_GET['idnumber'];
    if($dao->deleteAttachee($idnumber))
    {
        $_SESSION['error']="data deleted !!";
        $number_attachees=$dao->get_number_attachees();
    }
    else{
        $_SESSION['error']="Not Deleted!!";
    }

}
if(isset($_GET['delAdmin']))
{
    $idnumber=$_GET['idnumber'];
    if($dao->deleteAdmin($idnumber))
    {
        $_SESSION['error']="data deleted !!";
        $number_attachees=$dao->get_number_attachees();
    }
    else{
        $_SESSION['error']="Not Deleted!!";
    }

}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <link rel="stylesheet" href="assets/css/notif.css">
    <title></title>

    <script src="assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(
            function() {
                $("#attachees").click(
                    function()
                    {
                        $("#container").load('attachees_table.php');

                    }
                );
                $("#admin").click(
                    function()
                    {
                        $("#container").load('admin_table.php');

                    }
                );

            });
    </script>
</head>

  </head>
<body >

<center>  <h2>Admin Management</h2></center>
<hr>
<div class="container-fluid container-fullw ">
    <div class="row">
        <div class="col-sm-4">
            <a>
            <div class="panel panel-white no-radius text-center" id="attachees">
                <div class="panel-body" >
                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i> </span>
                    <h2 class="StepTitle">Manage Attachees</h2>

                    <p class="links cl-effect-1">
                            Attachees: <?=$number_attachees?>
                    </p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-white no-radius text-center" id="admin">
                <div class="panel-body">
                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
                    <h2 class="StepTitle">Manage Admins</h2>

                    <p class="cl-effect-1">

                            Total Admins: <?=$number_admins?>


                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-white no-radius text-center">
                <div class="panel-body">
                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
                    <h2 class="StepTitle"> Manage Supervisors</h2>

                    <p class="links cl-effect-1">
                            Total Supervisors: <?=$number_supervisors?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<p id="notif-failed"><?=$_SESSION['error'];?></p>
<div class="container" id="container">

</div>

</body>

<style>
    body{
        background: url("assets/images/bedge_grunge.png");
    }

    .panel-white:hover{
        background-color: #1c94c4;
        color: white;
    }
    .panel-white{
        background-color: white;
        color: #1c94c4;
    }

</style>

</html>
