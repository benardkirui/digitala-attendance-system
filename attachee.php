
<?php
session_start();
include 'database/DAO.php';
$dbc = new DAO();
$id = $_SESSION['idnumber'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->


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
    <link href="assets/plugins/modals/modal-component.css" rel="stylesheet" type="text/css">
    <!-- End Theme Layout Style
    =====================================================================-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/verifier.js"></script>
    <script>
        $(document).ready(
            function()
            {
               $("#save").click(
                   function()
                   {
                       var date= $("#date").val();
                       var work_done= $("#work_done").val();
                       var challenges = $("#challenges").val();
                       var solutions = $("#solutions").val();
                       var engagement = $("#engagement").val();
                       var plan = $("#plan").val();

                       if(date =='' || work_done =='' || challenges=='' || solutions =='' || engagement =='' || plan == '')
                       {
                           showError("You cannot leave the fields empty");
                       }
                       else{
                           if(check_min_length(work_done,"Work Done",100))
                           {

                               $.post("register.php",{report_weekly:"report_weekly",date:date,work_done:work_done,challenges:challenges,solutions:solutions,engagement:engagement,plan:plan},
                                   function(data,status)
                                   {
                                       if(data=='yes')
                                       {
                                           $("#tohide").slideUp(1000);
                                           showSuccess("Weekly report saved");
                                           $('#save').hide();
                                       }
                                       else{
                                           showError('Failed to save Weekly report');
                                           $("#tohide").slideUp(100);
                                           $("#tohide").slideDown(1000);
                                       }
                                   }
                               );
                           }
                       }
                   }
               );
            }

        );
    </script>
</head>
<style>
    .md-modal{

        overflow-y: scroll;
    }
</style>
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
                            <li class="active">Add Report</li>
                            <li><a href="weekly.php"><i class="pe-7s-home"></i>Weekly Reports</a></li>
                            <li><a href="panels.php">Daily Reports</a></li>
                            <li><a href="tasks.php">Tasks</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ol>
                    </div>
                </div> <!-- /. Content Header (Page header) -->
                <div class="row" id="tohide">
                    <div class="form-group">
                        <label >Week Ending</label>
                        <br>
                        <input type="date" id="date" class="form-control col-md-6">
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="text-left">State What you did This week</label>
                        <textarea name="f1-about-yourself" placeholder="Report what you did this week"
                                  class="form-control text-left"  rows="5" id="work_done"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="text-left">Challenges faced During the week</label>
                        <textarea name="f1-about-yourself" placeholder="What challenges did you face"
                                  class="form-control text-left"  id="challenges" rows="5"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="text-left">Solutions to Challenges faced</label>
                        <textarea name="f1-about-yourself" placeholder="What are the possible solutions"
                                  class="form-control text-left" id="solutions" rows="5"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="text-left">Explain you engagement in daily activities</label>
                        <textarea name="f1-about-yourself" placeholder="Were you positively Engaged "
                                  class="form-control text-left" id="engagement" rows="5"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="text-left">State Plan For the coming week</label>
                        <textarea name="f1-about-yourself" placeholder="What is you plan for next week"
                                  class="form-control text-left" id="plan" rows="5"></textarea>
                    </div>



                </div>
                <div class="row">
                    <button type="button" class="btn btn-success col-md-5" id="save" style="margin: 10px">Submit Report</button>
                    <button class="btn btn-danger md-close col-md-5" onclick="window.location.assign('weekly.php')" style="margin: 10px">Exit</button>
                </div>

        </div> <!-- /.main content -->
    </div> <!-- /.container -->
</div> <!-- /.content-wrapper -->

</div> <!-- ./wrapper -->


<!--        //THE MODAL-->
<div class="modal" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bomet County Government</h4>
            </div>
        </div>
    </div>
</div>

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
<script src="assets/plugins/modals/classie.js" type="text/javascript"></script>
<script src="assets/plugins/modals/modalEffects.js" type="text/javascript"></script>
</body>
</html>