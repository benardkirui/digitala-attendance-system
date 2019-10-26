<?php
session_start();
if($_SESSION['idnumber']==0)
{
    header('Location:logout.php');
}
include 'database/DAO.php';
$dbc = new DAO();
$id = $_SESSION['idnumber'];
$result =$dbc->select_attachee_tasks($id);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Attachee Page</title>

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="assets/dist/img/ico/apple-touch-icon-57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/dist/img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/dist/img/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/dist/img/ico/apple-touch-icon-144-precomposed.png">

    <!-- Start Global Mandatory Style
    =====================================================================-->
    <link href="assets/dist/css/base.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Theme style -->
    <link href="assets/dist/css/component_ui.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style rtl -->
    <link href="assets/dist/css/component_ui_rtl.css" rel="stylesheet" type="text/css">
    <!-- Custom css -->
    <link href="assets/dist/css/custom.css" rel="stylesheet" type="text/css">
    <!-- End Theme Layout Style
    =====================================================================-->
</head>
<body>
<div class="wrapper animsition">


    <!-- /.content-wrapper -->
    <div class="content-wrapper">
        <div class="container">
            <!-- main content -->
            <div class="content">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="header-icon"><i class="pe-7s-date"></i></div>
                    <div class="header-title">
                        <h1>Bomet County Government</h1>
                        <ol class="breadcrumb">
                            <li class="active">Daily Reports</li>
                            <li><a href="attendance.php">Attendance</a></li>
                            <li><a href="weekly.php">Weekly Reports</a></li>
                            <li><a href="tasks.php">Tasks</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ol>
                    </div>
                </div> <!-- /. Content Header (Page header) -->
                <div class="row text-left">
                    <?php

                    while($row= mysqli_fetch_assoc($result))
                    {
                        ?>
                        <div class="col-sm-12 col-md-6">
                            <!-- Multiple panels with drag & drop -->
                            <div class="panel  lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4><?=$row['date']?></h4>
                                    </div>
                                </div>

                                <div class="panel-body text-left">
                                    <p><b>Assigned By:</b> <?=$row['fullname']?></p>
                                    <p><b>Task:</b> <?=$row['description']?></p>
                                    <p><b>Assigned on:</b> <?=$row['date']?></p>
                                </div>
                                <!--                                <div class="panel-footer">-->
                                <!--                                   -->
                                <!--                                </div>-->
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div> <!-- /.main content -->
        </div> <!-- /.container -->
    </div> <!-- /.content-wrapper -->

</div> <!-- ./wrapper -->
<!-- jQuery -->
<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
<!-- jquery-ui -->
<script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<!-- Bootstrap js -->
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- lobipanel js -->
<script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
<!-- animsition js -->
<script src="assets/plugins/animsition/js/animsition.min.js" type="text/javascript"></script>
<!-- bootsnav js -->
<script src="assets/plugins/bootsnav/js/bootsnav.js" type="text/javascript"></script>
<!-- SlimScroll js -->
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick js-->
<script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
<!-- End Core Plugins
=====================================================================-->
<!-- Start Page Lavel Plugins
=====================================================================-->




<!-- Start Theme label Script
=====================================================================-->
<!-- Dashboard js -->
<script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
<!-- End Theme label Script
=====================================================================-->
</body>
</html>