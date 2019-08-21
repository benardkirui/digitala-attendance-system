<?php session_start(); ?>
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
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <link rel="stylesheet" href="assets/css/notif.css">
  </head>
  <script src="assets/js/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(
      function()
      {
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
            var fullname= $("#fullname").val();
            var idnumber= $("#idnumber").val();
            var date=getNow();

            

          }
        );

        $("#report_out").click(
          function()
          {
            alert("you clicked report out");
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

    <div id="container" >
      <div class="card bg-white">
          <div class="btn-group-vertical" id="button-container">
             <button type="button" name="button" class="btn btn-primary navigation_button" id="report_in" >Report In</button>
            <button type="button" name="button" class="btn btn-primary navigation_button " id="report_out" >Report out</button>
            <button type="button" name="button" class="btn btn-primary navigation_button" id="previous_week" >Previous Week Report</button>
            <button type="button" name="button" class="btn btn-primary navigation_button" id="current_week" >This Week</button>
            <button type="button" name="button" class="btn btn-primary navigation_button" id="tasks" >Tasks</button>
          </div>

      </div>
      <div class="card bg-white" id="body">
        <div class="card-header">
          Attachee Report
        </div>
        <div class="card-body">
          <div class="form-group">
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
        </div>
        <div class="card-footer">
          <button type="button" name="button" class="btn btn-success btn-outline-primary col-lg-12" >Submit</button>
          <br><br>
        </div>
      </div>
      <div class="card bg-white" id="display">
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
  </body>
  <style media="screen">
  .card{

  }
  #container
  {
    background-color: grey;
    margin-top: 30px;
    display: flex;
    flex-flow: wrap;
    justify-content: space-around;
  }
  #navigation{
    width: 19%;
  }
  #body{

    width: 50%;
  }
  #display{
    width: 30%;

  }
  .navigation_button{
    width:100%;
    height:180px;
    padding:30px;
    font-size: 25px;
    font-weight: bold;
    background-color: rgba(50, 71, 124,0.7);
    color: white;

  }
  .navigation_button:hover{
  background-color: rgba(50, 71, 124,1.0);
  color: rgb(43, 124, 211);

  }

  </style>
</html>
