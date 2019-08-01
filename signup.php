<?php
session_start();
include("database/DAO.php");
$_SESSION["error"]="";
$_SESSION["fullname"]="";
$_SESSION["username"]="";
$_SESSION["idnumber"]="";
$_SESSION["location"]="";
$_SESSION["passcode"]="";
$_SESSION["password"]="";
if(isset($_POST["submit"]))
{
    $fullname=$_POST["fullname"];
    $username=$_POST["username"];
    $idnumber=$_POST["idnumber"];
    $location=$_POST["location"];
    $passcode=$_POST["passcode"];
    $password=$_POST["password"];
    $password1=$_POST["password2"];
    $_SESSION["fullname"]=$fullname;
    $_SESSION["username"]=$username;
    $_SESSION["idnumber"]=$idnumber;
    $_SESSION["location"]=$location;
    $_SESSION["passcode"]=$passcode;
    $_SESSION["password"]=$password;

    //set the variables to the session
    if(strlen($password)!=strlen($password1))
    {
        $_SESSION["error"]="Password one is not equal to second password";
    }
    else {
        $isAdmin="not admin";
        if($passcode==9531)
        {
            $isAdmin="admin";
        }
        //the two passwords are equal so proceed to saving them in the database
        $dao= new DAO();
        $dao->insertNewUser($fullname,$username,$idnumber,$location,$isAdmin,md5($password));

    }


}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- LINEARICONS -->
    <link rel="stylesheet" href="assets/fonts/linearicons/style.css">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/notif.css">
</head>

<body>

<div class="wrapper">
    <div class="inner">
        <img src="images/image-1.png" alt="" class="image-1">

        <form action="" method="post">

            <h3>New Account</h3>
            <p id="notif-success"><?=$_SESSION['message'];?></p>
            <p id="notif-failed"><?=$_SESSION['error'];?></p>
            <div class="form-holder">
                <span class="lnr lnr-user"></span>
                <input type="text" class="form-control" name="fullname" placeholder="Full Name" required value=<?php echo $_SESSION["fullname"]; ?>>
            </div>
            <div class="form-holder">
                <span class="lnr lnr-phone-handset"></span>
                <input type="text" class="form-control" name="idnumber" placeholder="Id Number"  required value=<?php echo $_SESSION["idnumber"]; ?>>
            </div>
            <div class="form-holder">
                <span class="lnr lnr-envelope"></span>
                <input type="text" class="form-control" name="location" placeholder="Location"  required value=<?php echo $_SESSION["location"]; ?>>
            </div>
            <div class="form-holder">
                <span class="lnr lnr-user"></span>
                <input type="text" class="form-control" name="username" placeholder="Username" required value=<?php echo $_SESSION["username"]; ?>>
            </div>
            <div class="form-holder">
                <span class="lnr lnr-lock"></span>
                <input type="password" class="form-control" name="password" placeholder="Password"  required value=<?php echo $_SESSION["password"]; ?>>
            </div>
            <div class="form-holder">
                <span class="lnr lnr-lock"></span>
                <input type="password" class="form-control" name="password2"placeholder="Confirm Password">
            </div>
            <div class="form-holder">
                <span class="lnr lnr-lock"></span>
                <input type="password" class="form-control" name="passcode" placeholder="Admin Passcode(Be Admin)" value=<?php echo $_SESSION["passcode"]; ?>>
            </div>
            <button type="submit" name="submit" value="submit">
                <span>Register</span>
            </button>
            <a href="index.php" class="btn-link">Already have an Account</a>
        </form>
        <img src="images/image-2.png" alt="" class="image-2">
    </div>

</div>

<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
