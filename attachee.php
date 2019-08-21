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
  <body>
    <div id="container" >
      <div class="card bg-white" id="navigation">

          <button type="button" name="button"id="navigation-button" class="btn ">Report In</button>
          <button type="button" name="button"id="navigation-button" class="btn">Report out</button>
          <button type="button" name="button"id="navigation-button" class="btn">Previous Week Report</button>
          <button type="button" name="button"id="navigation-button" class="btn">Tasks Todo</button>

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
  #navigation-button{
    width:100%;
    height:180px;
    padding:30px;
    font-size: 25px;
    font-weight: bold;
    background-color: rgb(43, 124, 211);
    color: white;

  }
  #navigation-button:hover{
    background-color: white;
  color: rgb(43, 124, 211);

  }

  </style>
</html>
