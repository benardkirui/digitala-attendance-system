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
    $dao->checkAdminLogin($username,md5($password));

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

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
   <a class="navbar-brand" href="#"><h1><?php include('animate/index.html');?></h1></a><br><br><br>

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
    <nav class="navbar navbar-light">
  <form class="form-inline">
    <!--<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><a href="index.php">Home<a href="login.php"></a></button>-->
    <a href="index.php" style="border:1px solid #cc5200;padding:30%;border-radius: 6px;position: absolute;">Home</a>
  </form>
</nav>

  </div>
</div>
</nav>


   <div class="col align-self-center">

   <div class="span6">
   <br> <br> <br>
  <!-- <div class="alert alert-warning hide alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>-->
<!--<div class="alert alert-warning hide"></div>-->
<center>
    <h3 id="notif-success"><?=$_SESSION['error']?></h3>
    <div class="container">
      <div class="col-lg-6">
        <form  action="#" method="POST">
       <div class="card autoHeight" style="border-top: 4px solid #00802b;border-bottom: 4px solid #00802b;border-radius: 4px;">
   <h1 class="card-header">Admin Area</h1>

   <div class="card-body">
    <div class="input-group input-group-lg">
        <span class="input-group-addon" id="sizing-addon1"><img src="assets/icon/32px-Crystal_Clear_app_kuser.png"></span>
         <input type="text" class="form-control" name="username" id="val1" placeholder="AttacheeID" aria-describedby="sizing-addon1" required="" />
     </div>
     <br>
        <div class="input-group input-group-lg">
        <span class="input-group-addon" id="sizing-addon1"><img src="assets/icon/32px-Crystal_Clear_app_password.png"></span>
         <input type="password" class="form-control" name="password" id="val5" placeholder="Password..." aria-describedby="sizing-addon1" required="" />
     </div><br>
     <div class="form-group">
     <input type="submit" value="Sign In" id ="dd" class="btn btn-success btn-block btn-lg" name="submit" />
 </div>
       <div class="row justify-content-lg-between">
           <a href="signup.php" class="btn-link">Click to Register</a>

           <a href="index.php" class="btn-link" >Attachee Login</a>
       </div>
        </form>
      </div>
   </div>
   <br>
   <div class="alert alert-info hide">All right Reserved &copy; <?php echo date('Y');?> Created By:Benard Kirui</div>
   </center>
 </div>
   <br>

</div><br>


    <script  src="assets/js/index.js"></script>
</body>
</div>
</div>
<script src = "assets/js/jsko/jquery.js"></script>
  <script src = "assets/js/jsko/bootstrap.js"></script>
</html>
  <br><br>




             <script type="text/javascript">
                             $("#dd").unbind('click').on("click", function () {


                                    uservalidate();
                                    passvalidate();



                                   if (uservalidate() === true
                                    && passvalidate() === true

                                    ) {



                           // console.log(arr)
                          };


                  });


                   function uservalidate() {
                           if ($('#val1').val() == '') {
                                $('#val1').css('border-color', '#dc3545');
                                return false;
                                 } else {
                                  $('#val1').css('border-color', '#28a745');
                                   return true;
                              }

                      };

                          function passvalidate() {
                           if ($('#val5').val() == '') {
                                $('#val5').css('border-color', '#dc3545');
                                return false;
                                 } else {
                                  $('#val5').css('border-color', '#28a745');
                                   return true;
                              }

                      };


</script>
