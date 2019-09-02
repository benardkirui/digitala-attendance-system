<?php session_start();
include 'database/DAO.php';

$dao= new DAO();

if(isset($_POST['logout']))
{
    $dao->logout();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
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
    <link rel="stylesheet" href="assets/css/attachee.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <link rel="stylesheet" href="assets/css/notif.css">
</head>
<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(
        function()
        {
            var idnumber= $("#idnumber").val();
            var fullname= $("#fullname").val();
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
                            $("#report_in").attr('disabled','disabled');
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
                            $("#report_out").attr('disabled','disabled');
                        }
                    }
                );
            }

            check_if_already_reportedin();
            check_if_already_reported_out();

            $("#report-body").hide(1);
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
            $("#report_in").click(
                function()
                {
                    $("#report_in").attr("disabled","disabled");
                    var date=getNow();
                    var action='reportin';

                    //saving the report in to the database
                    $.post('register.php',{reportin:action,fullname:fullname,idnumber:idnumber,timein:date},
                        function(data,status)
                        {
                            if(data=='yes')
                            {
                                $("#initial-body").slideToggle(1000);
                                $("#title").html("Report In succesful");
                                $("#name-display").text("Full Name: "+fullname);
                                $("#idnumber-display").text("Id Number: "+idnumber);
                                $("#timein-display").text("Time In: "+date);
                                $("#comment-display").text("Comment: Always come early");
                                $("#report-body").slideToggle(1000);
                                $(this).text("Saved dont click again");
                            }
                            else{
                                alert("There was a problem reporting in");
                            }
                        }
                    );


                }
            );

            $("#report_out").click(
                function()
                {
                    //pop up a modal to state what the user has done for the day
                    $("#reportOutModal").slideDown(1000);

                }
            );

            $("#submit_job").click(
                function()
                {
                    //get the jobs done from the text area

                    $("#reportOutModal").slideUp(1);
                    var jobs_done= $('#job_area').val();
                    //if the job is null ask the user to explain why he didnt do anything today
                    if(jobs_done=='')
                    {
                        $("#reportOutModal").slideDown(1000);
                        $("#modal-title").html("You did nothing?");
                        $("#job_area").attr("placeholder","Explain why you did nothing or state the job you did today");
                    }
                    else if(jobs_done.length<10)
                    {
                        $("#reportOutModal").slideDown(1000);
                        var elem= '<p class="lead alert-danger">Hint: At least 10 characters</p>';
                        $("#job_area").append(elem);
                        $("#modal-title").html("Give More Description ").append(elem);
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

                                                $("#reportOutModal").hide(5);
                                                $("#initial-body").slideUp(1000);
                                                $("#title").html("Report Out succesful");
                                                $("#name-display").text("Full Name: "+data.fullname);
                                                $("#idnumber-display").text("Id Number: "+data.idnumber);
                                                $("#timein-display").text("Time In: "+data.reportin);
                                                $("#timeout-display").text("Time Out: "+data.reportout);
                                                $("#comment-display").text("Job Done: "+data.jobdone);
                                                $("#report-body").slideDown(1000);
                                                $(this).text("Saved dont click again");
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

            $(".closeModal").click(
                function()
                {
                    $("#reportOutModal").slideUp(1000);
                }
            );

            $("#current_week").click(
                function()
                {
                    alert("you clicked current week ");
                }
            );

            $("#previous_week").click(
                function()
                {
                    alert("you clicked previous_week ");
                }
            );

            $("#tasks").click(
                function()
                {
                    alert("you clicked tasks ");
                }
            );

        }
    );
</script>
<body>

<!-- HIDDEN FIELDS  -->
<input type="hidden" id="fullname" value="<?= $_SESSION['fullname']?>">
<input type="hidden" id="idnumber" value="<?= $_SESSION['idnumber']?>">

<div id="container" class="container col-md-12">
    <div class="card col-md-3 bg-white">
        <div class="btn-group-vertical" id="button-container">
            <button type="button" name="button" class="btn btn-primary navigation_button" id="report_in" >Report In</button>
            <button type="button" name="button" class="btn btn-primary navigation_button " id="report_out" >Report out</button>
            <button type="button" name="button" class="btn btn-primary navigation_button" id="previous_week" >Previous Week Report</button>
            <button type="button" name="button" class="btn btn-primary navigation_button" id="current_week" >This Week</button>
            <button type="button" name="button" class="btn btn-primary navigation_button" id="tasks" >Tasks</button>
            <form method="post">
                <button type="submit" onClick="return confirm('Are you sure you want to Logout?')" class="btn btn-primary navigation_button" name="logout" >Logout</button>
            </form>
        </div>

    </div>
    <div class="card col-md-6 bg-white" id="body">
        <div class="card-header">
            Attachee Report
        </div>
        <div class="card-body" >
            <div class="form-group" id="initial-body">
                <label for="">Monday</label>
                <input type="text" name="" value="" class="form-control">
                <br>
                <label for="">Tuesday</label>
                <input type="text" name="" value="" class="form-control">
                <br>
                <label for="">wednesday</label>
                <input type="text" name="" value="" class="form-control">
                <br>
                <label for="">Thursday</label>
                <input type="text" name="" value="" class="form-control">
                <br>
                <label for="">Friday</label>
                <input type="text" name="" value="" class="form-control">
                <br>
            </div>


            <!-- THE REPORT IN REPORT OUT PAGE -->
            <div class="panel" id="report-body">
                <div class="panel-header">
                    <h3 class="text-center" id="title"></h3>
                </div>
                <div class="panel-body panel-success">
                    <p class="lead" id="name-display">Name:</p>
                    <p class="lead" id="idnumber-display">ID Number:</p>
                    <p class="lead" id="timein-display">Time in:</p>
                    <p class="lead" id="timeout-display">Time Out:</p>
                    <p class="lead" id="comment-display">Comment:</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" name="button" class="btn btn-success btn-outline-primary col-lg-12" >Submit</button>
            <br><br>
        </div>
    </div>
    <div class="card col-md-3 bg-white" id="display">
        <div class="card-header">
            <h2>Message from admin</h2>
        </div>
        <div class="card-body">
            Admin Name:
            <br>
            Admin Message:

        </div>
        <hr>
        <div class="card-header">
            <h2>Message From Supervisor</h2>
        </div>
        <div class="card-body">
            Supervisor's Name:
            <br>
            Message:
        </div>
    </div>
</div>


<!--THE REPORTING OUT MODAL-->
<div class="modal" id="reportOutModal">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">What have you done Today?</h4>
                <button type="button" class="close closeModal">X</button>

            </div>
            <div class="modal-body">
                <div class="card-body" id="job_container">
                    <div class="form-group">
                        <textarea id="job_area" class="form-group-lg " placeholder="State What you did today" style="width:100%;"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submit_job" class="btn btn-success ">Submit</button>
                <button type="button" class="btn btn-danger closeModal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>

</html>
