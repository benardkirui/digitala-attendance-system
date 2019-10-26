<?php
session_start();
include 'database/DAO.php';
$dbc = new DAO();
$id = $_SESSION['idnumber'];
$result =$dbc->select_attachee_weekly_report($id);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Weekly Report</title>

    <!-- Start Global Mandatory Style
    =====================================================================-->
    <link href="assets/dist/css/base.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- dataTables css -->
    <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style -->
    <link href="assets/dist/css/component_ui.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style rtl -->
    <link href="assets/dist/css/component_ui_rtl.css" rel="stylesheet" type="text/css">
    <!-- Custom css -->
    <link href="assets/dist/css/custom.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/modals/modal-component.css" rel="stylesheet" type="text/css">
    <!-- End Theme Layout Style
    =====================================================================-->

    <script src="assets/js/jquery.min.js"></script>
</head>
<body>


<div class="wrapper animsition">
    <!-- HIDDEN FIELDS  -->
    <input type="hidden" id="fullname" value="<?= $_SESSION['fullname']?>">
    <input type="hidden" id="idnumber" value="<?= $_SESSION['idnumber']?>">
    <!-- /.content-wrapper -->
    <div class="content-wrapper">
        <div class="container">
            <!-- main content -->
            <div class="content">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-box1"></i>
                    </div>
                    <div class="header-title">
                        <h1>Bomet County Government</h1>
                        <ol class="breadcrumb">
                            <li class="active">Weekly Reports</li>
                            <li><a href="panels.php">Daily Reports</a></li>
                            <li><a href="attachee.php">Add Report</a></li>
                            <li><a href="tasks.php">Tasks</a></li>
                            <li><a href="logout.php">Logout</a></li>

                        </ol>


                    </div>
                </div> <!-- /. Content Header (Page header) -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel  lobidrag">
                            <div class="panel-heading">
                                <h3 class="panel-title" >Weekly Report</h3>
                            </div>
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width:18%">Work Done</th>
                                            <th style="width:15%">Challenges</th>
                                            <th style="width:15%">Solutions</th>
                                            <th style="width:15%">Engagement</th>
                                            <th style="width:15%">Next Week Plan</th>
                                            <th style="width:10%">Comments</th>
                                            <th style="width:12%">Week Ending</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while($row= mysqli_fetch_assoc($result))
                                        {
                                            ?>
                                            <tr>
                                                <td><?=$row['work_done']?></td>
                                                <td><?=$row['challenges']?></td>
                                                <td><?=$row['solutions']?></td>
                                                <td><?=$row['engagement']?></td>
                                                <td><?=$row['plan']?></td>
                                                <td><?=$row['comments']?></td>
                                                <td><?=$row['week_ending']?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
<!-- dataTables js -->
<script src="assets/plugins/datatables/dataTables.min.js" type="text/javascript"></script>
<!-- Start Theme label Script
=====================================================================-->
<!-- Dashboard js -->
<script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
<!-- End Theme label Script
=====================================================================-->
<script src="assets/plugins/modals/classie.js" type="text/javascript"></script>
<script src="assets/plugins/modals/modalEffects.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {

        "use strict"; // Start of use strict

        $('#dataTableExample1').DataTable({
            "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "lengthMenu": [[6, 25, 50, -1], [6, 25, 50, "All"]],
            "iDisplayLength": 6
        });

        $("#dataTableExample2").DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {extend: 'copy', className: 'btn-sm'},
                {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print', className: 'btn-sm'}
            ]
        });

    });
</script>
</body>
</html>