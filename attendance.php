<?php
session_start();
include 'database/DAO.php';
$dbc = new DAO();
$id = $_SESSION['idnumber'];
$result =$dbc->select_attendance($id);

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
    <script type="text/javascript">
        $(document).ready(
            function()
            {
                var idnumber= $("#idnumber").val();
                var fullname= $("#fullname").val();
                $("#comments-display").hide();

                function check_if_already_reportedin()
                {
                    var action='ifexist';
                    var report ='reportin';
                    var currentdate = new Date();
                    var datetime = currentdate.getDate() + "-" + (currentdate.getMonth()+1)  + "-" + currentdate.getFullYear();

                    $.post('register.php',{ifexist:action,report:report,idnumber:idnumber,date:datetime},
                        function(data,status)
                        {
                            if(data == 'yes')
                            {
                                $("#reportin").attr('disabled','disabled');
                            }
                        }
                    );
                }


                function check_if_already_reported_out()
                {
                    var action='ifexist';
                    var report ='reportout';
                    var currentdate = new Date();
                    var datetime = currentdate.getDate() + "-" + (currentdate.getMonth()+1)  + "-" + currentdate.getFullYear();

                    $.post('register.php',{ifexist:action,report:report,idnumber:idnumber,date:datetime},
                        function(data,status)
                        {
                            if(data == 'yes')
                            {
                                $("#reportout").attr('disabled','disabled');
                            }
                        }
                    );
                }

                check_if_already_reportedin();
                check_if_already_reported_out();


                function getNow()
                {
                    var currentdate = new Date();
                    var datetime = currentdate.getDate() + "-"
                        + (currentdate.getMonth()+1)  + "-"
                        + currentdate.getFullYear() + " "
                        + currentdate.getHours() + ":"
                        + currentdate.getMinutes() + ":"
                        + currentdate.getSeconds();
                    return datetime;
                }

                $("#reportin").click(
                    function()
                    {
                        $("#reportin").attr("disabled","disabled");
                        var date=getNow();
                        var action='reportin';

                        //saving the report in to the database
                        $.post('register.php',{reportin:action,fullname:fullname,idnumber:idnumber,timein:date},
                            function(data,status)
                            {
                                if(data=='yes')
                                {

                                    $("#title").html("Report In succesful");
                                    $("#name-display").text("Full Name: "+fullname);
                                    $("#idnumber-display").text("Id Number: "+idnumber);
                                    $("#timein-display").text("Time In: "+date);

                                }
                                else{
                                    alert("There was a problem reporting in");
                                }
                            }
                        );


                    }
                );



                $("#submit_job").click(
                    function()
                    {


                        var jobs_done= $('#job_area').val();
                        //if the job is null ask the user to explain why he didnt do anything today
                        if(jobs_done=='')
                        {
                            $("#my_display").html("Explain why you did nothing or state the job you did today").addClass("alert-danger");
                        }
                        else if(jobs_done.length<10)
                        {
                            $("#my_display").html("Give more Description").addClass("alert-danger");
                        }
                        else {
                            var action='done';
                            //the user did something so save the job done by the user
                            $.post('register.php',{done:action,fullname:fullname,idnumber:idnumber,job_done:jobs_done},
                                function(data,status)
                                {
                                    if(data=='yes')
                                    {

                                        //the users work has been saved succesfully
                                        //now update the report out time in his reports
                                        var action='reportout';
                                        var timeout = getNow();
                                        var currentdate = new Date();
                                        var datetime = currentdate.getDate() + "-" + (currentdate.getMonth()+1)  + "-" + currentdate.getFullYear();//24-8-2019
                                        $.post('register.php',{reportout:action,idnumber:idnumber,fullname:fullname,timeout:timeout,date:datetime},
                                            function(data,status)
                                            {
                                                if(data == 'no')
                                                {
                                                    alert("There was an error reporting in");
                                                }
                                                else {

                                                    window.location.assign('attendance.php');
                                                }
                                            },"json"
                                        );


                                    }
                                    else{
                                        alert("There was a problem saving Job");
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
                            <li class="active">Attendance</li>
                            <li><a href="panels.php"><i class="pe-7s-home"></i>Daily Reports</a></li>
                            <li><a href="weekly.php">Weekly Reports</a></li>
                            <li><a href="tasks.php">Tasks</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ol>
                    </div>
                </div> <!-- /. Content Header (Page header) -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel  lobidrag">
                            <div class="panel-heading">
                                <button class="btn btn-primary md-trigger m-b-5 m-r-2" style="margin:10px;" id="reportin" data-modal="modal-4">Report In</button>
                                <button class="btn btn-info md-trigger m-b-5 m-r-2" style="margin:10px;" id="reportout" data-modal="modal-13">Report Out</button>

                            </div>
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Full Name</th>
                                            <th>ID Number</th>
                                            <th>Time in</th>
                                            <th>Time out</th>
                                            <th>Department</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count=1;
                                        while($row= mysqli_fetch_assoc($result))
                                        {

                                            ?>
                                            <tr class="md-trigger m-b-5 m-r-2" data-modal="modal-11">
                                                <td><?=$count++?></td>
                                                <td><?=$row['fullname']?></td>
                                                <td><?=$row['idnumber']?></td>
                                                <td><?=$row['reportin']?></td>
                                                <td><?=$row['reportout']?></td>
                                                <td><?=$row['department']?></td>
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
    <div class="md-modal md-effect-13" id="modal-13">
        <div class="md-content">
            <h3>Bomet County Government</h3>
            <div class="n-modal-body">
                <p id="my_display">Tell us What you did Today</p>
                <ul>
                    <div class="form-group">
                        <label class="sr-only" for="f1-about-yourself">Today's Report</label>
                        <textarea name="f1-about-yourself" placeholder="Eg. I wrote a program"
                                  class="form-control" id="job_area" rows="5"></textarea>
                    </div>
                </ul>
                <div class="row">
                    <button type="button" class="btn btn-success col-md-5" id="submit_job" style="margin: 10px">Report Out</button>
                    <button class="btn btn-danger md-close col-md-5" style="margin: 10px">Exit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="md-modal md-effect-11" id="modal-11">
        <div class="md-content">
            <h3>Bomet County Government</h3>
            <div class="n-modal-body">

                <ul id="list">
                </ul>
                <div class="row">
                    <button class="btn btn-danger md-close col-md-5" style="margin: 10px">Exit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="md-modal md-effect-4" id="modal-4">
        <div class="md-content">
            <h3>Bomet County Government</h3>
            <div class="n-modal-body">
                <p class="text-center" id="title">Report In </p>
                <ol>
                    <li><strong>Name:</strong> <span id="name-display"></span></li>
                    <li><strong>Idnumber:</strong> <span id="idnumber-display"></span></li>
                    <li><strong>Time In:</strong> <span id="time-display"></span></li>
                    <li><strong>Comments:</strong> <span id="comments-display"></span></li>
                </ol>
                <button class="btn btn-success md-close">Close me!</button>
            </div>
        </div>
    </div>
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

        $("tr").click(
            function()
            {
                $("#list").html('');

                var children = $(this).children();
                // var id =$(this).children().last().val();
                var elem1 = "<li><b>Full Name:<b> "+children[1].innerHTML+"</li>";
                var elem2 = "<li><b>ID Number:</b> "+children[2].innerHTML+"</li>";
                var elem3 = "<li><b>Time In: </b> "+children[3].innerHTML+"</li>";
                var elem4 = "<li><b>Time Out: </b> "+children[4].innerHTML+"</li>";
                var elem5 = "<li><b>Department: </b> "+children[5].innerHTML+"</li>";
                $("#list").append(elem1+elem2+elem3+elem4+elem5);


            }
        );

    });
</script>
</body>
</html>