<?php
session_start();
include("database/DAO.php");
$_SESSION["error"]="";
$_SESSION["fullname"]="";
$_SESSION["username"]="";
$_SESSION["idnumber"]="";
$_SESSION["phonenumber"]="";
$_SESSION["passcode"]="";
$_SESSION["password"]="";
if(isset($_POST["submit"]))
{
    $fullname=$_POST["fullname"];
    $username=$_POST["username"];
    $idnumber=$_POST["idnumber"];
    $phonenumber=$_POST["phonenumber"];
    $passcode=$_POST["passcode"];
    $password=$_POST["password"];
    $password1=$_POST["password2"];
    $_SESSION["fullname"]=$fullname;
    $_SESSION["username"]=$username;
    $_SESSION["idnumber"]=$idnumber;
    $_SESSION["phonenumber"]=$phonenumber;
    $_SESSION["passcode"]=$passcode;
    $_SESSION["password"]=$password;

    //set the variables to the session
    if(strlen($password)!=strlen($password1))
    {
        $_SESSION["error"]="Password one is not equal to second password";
        $_SESSION['message'] ="";
    }
    elseif (strlen($phonenumber)<10 || strlen($phonenumber)>10 )
    {
        $_SESSION["error"]="Phone number not correct length";
        $_SESSION['message'] ="";
    }
    elseif (!is_numeric($phonenumber))
    {
        $_SESSION["error"]="Phone number not acceptable";
        $_SESSION['message'] ="";
    }
    else {
        $isAdmin="not admin";
        if($passcode==9531)
        {
            $isAdmin="admin";
        }
        //the two passwords are equal so proceed to saving them in the database
        $dao= new DAO();
        $dao->insertNewUser($fullname,$username,$idnumber,$phonenumber,$isAdmin,md5($password));
        $_SESSION["fullname"]="";
        $_SESSION["username"]="";
        $_SESSION["idnumber"]="";
        $_SESSION["phonenumber"]="";
        $_SESSION["passcode"]="";
        $_SESSION["password"]="";
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
                <input type="text" class="form-control" name="phonenumber" placeholder="Phone Number"  required value=<?php echo $_SESSION["phonenumber"]; ?>>
            </div>
            <div class="form-holder">
                <span class="lnr lnr-user"></span>
                <input type="text" class="form-control" name="username" placeholder="Username" required autocomplete="off" >
            </div>
            <div class="form-holder">
                <span class="lnr lnr-lock"></span>
                <input type="password" class="form-control" name="password" placeholder="Password"  required >
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
