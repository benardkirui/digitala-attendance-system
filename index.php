<?php
session_start();
include "database/DAO.php";
$_SESSION['message']='';
$_SESSION['error']='';
if(isset($_POST['submit']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $dao= new DAO();
    $dao->checkAttacheeLogin($username,md5($password));

}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title></title>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!--   <meta http-equiv="refresh" content="30"> -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
       <link rel="stylesheet" type="text/css" href="assets/css/style1.css">
       <link rel="stylesheet" type="text/css" href="assets/css/notif.css">
      <script type="text/javascript" src="form_validationko.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
      <script src="assets/js/jquery-slim.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-light " style="background-color: black">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="container">
            <a class="navbar-brand" href="#">
                <br>
               <h1><?php include('animate/index.html');?>


                </h1>
            </a>
            <br><br><br>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
               <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item active">
                     <a class="nav-link" href="#"></a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"></a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link disabled" href="#"></a>
                  </li>
               </ul>

            </div>
         </div>
      </nav>
      <div class="container">
      <div class="row">
      <div class="col-lg-6">
         <div id="clock">
            <div class="hour">
               <div class="min"></div>
               <div class="min"></div>
               <div class="min"></div>
               <div class="min"></div>
               <div class="min"></div>
            </div>
            <div class="hour">
               <div class="min"></div>
               <div class="min"></div>
               <div class="min"></div>
               <div class="min"></div>
               <div class="min"></div>
            </div>
            <div id="alarm"> </div>
            <div id="min"></div>
            <div id="hour"></div>
            <div id="sec"></div>
            <ol>
               <li></li>
               <li></li>
               <li></li>
               <li></li>
               <li></li>
               <li></li>
               <li></li>
               <li></li>
               <li></li>
               <li></li>
               <li></li>
               <li></li>
            </ol>
            <hr>
            <center>
               <div class="date">
                  <?php
                     date_default_timezone_set("Africa/Nairobi");
                      $time = date("h:i A",strtotime("+0 HOURS"));
                      $date = date("M-d-Y");
                      ?>
                  <strong style="font-size: 1.6em;"><?php echo  $date;?>&nbsp;&nbsp;<font style="color:#ffc107;">|</font>&nbsp;&nbsp; <span style="color: #ff6666;font-size: 1em;" id="tick2" class="timeh1"></strong>
            </center>
            </div>
         </div>
         <div class="col align-self-center">
            <div class="span10">
               <!-- <div class="alert alert-warning hide alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </div>-->
               <!--<div class="alert alert-warning hide"></div>-->
                <br><br>

               <form id="register_form" novalidate  action="#" method="POST">
                  <div class="card autoHeight" >
                      <p id="notif-failed"><?=$_SESSION['error']?></p>
                      <br>
                     <h3 class="card-header">Attachee Login</h3>

                     <div class="card-body ">
                        <div class="input-group input-group-lg">
                           <span class="input-group-addon" id="sizing-addon1"><img src="assets/icon/users.ico"></span>
                           <input type="text" class="form-control" name="username" id="val1" placeholder="Username" aria-describedby="sizing-addon1" required="" />
                        </div>
                        <br>
                        <div class="input-group input-group-lg">
                           <span class="input-group-addon" id="sizing-addon1"><img src="assets/icon/lock_blue.ico"></span>
                           <input type="password" class="form-control" name="password" id="val5" placeholder="Password..." aria-describedby="sizing-addon1" required="" />
                        </div>
                        <br>
                        <div class="form-group">
                           <button type="submit" class="btn btn-lg btn-outline-primary col-lg-8" id ="submit" name="submit" >Login</button>
                        </div>
                        <br>
                         <div class="row justify-content-lg-between">
                             <a href="signup.php" class="btn-link">Click to Register</a>

                             <a href="view_attendance.php" class="btn-link" >Admin Login</a>
                         </div>
               </form>
               </div>
               </div>
               <br>

            </div>

            <br>
            <!--<div class="alert alert-info hide alert-dismissible fade show" role="alert"><strong>All right Reserved @ 2018 By:Juniltoledo</strong>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
               </div>-->
            <script  src="assets/js/index.js"></script>
   </body>
   </div>
   </div>
   <script src = "assets/js/jsko/jquery.js"></script>
   <script src = "assets/js/jsko/bootstrap.js"></script>
</html>
<br><br>
<script>
   // <!--/. tells about the time  -->
                 function show2(){
                 if (!document.all&&!document.getElementById)
                 return
                 thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
                 var Digital=new Date()
                 var hours=Digital.getHours()
                 var minutes=Digital.getMinutes()
                 var seconds=Digital.getSeconds()
                 var dn="PM"
                 if (hours<12)
                 dn="AM"
                 if (hours>12)
                 hours=hours-12
                 if (hours==0)
                 hours=12
                 if (minutes<=9)
                 minutes="0"+minutes
                 if (seconds<=9)
                 seconds="0"+seconds
                 var ctime=hours+":"+minutes+":"+seconds+" "+dn
                 thelement.innerHTML=ctime
                 setTimeout("show2()",1000)
                 }
                 window.onload=show2
         //-->


</script> <!--/. Script where the format of the interface time,month,day and year relies -->
<script type="text/javascript">
   $(document).ready (function(){

               $("#success-alerts").fadeOut(15000);

               $("#id").unbind('click').on("click", function () {
                   $("#success-alerts").fadeTo(1000, 0).slideUp(5000, function(){
                    //$(this).remove();
                   });
               }, 5000);

               $("#success-alert").fadeOut(15000);
               $("#id").unbind('click').on("click", function () {
                   $("#success-alert").fadeTo(1000, 0).slideUp(5000, function(){
                  // $(this).remove();
                   });
               }, 5000);
    });

</script>
<script type="text/javascript">
   $(document).ready (function(){
               $("#danger-alert").fadeOut(15000);
               $("#id").unbind('click').on("click", function () {
                   $("#danger-alert").fadeTo(1000, 0).slideUp(5000, function(){
                    //$(this).remove();
                   });
               }, 5000);

               $("#danger-alerts").fadeOut(15000);
               $("#id").unbind('click').on("click", function () {
                   $("#danger-alerts").fadeTo(1000, 0).slideUp(5000, function(){
                  // $(this).remove();
                   });
               }, 5000);
    });

</script>
<!-- <script type="text/javascript">
  var content = $('#id');
content.fadeOut().load(page, function() {
    content.fadeIn();
});
</script> -->
