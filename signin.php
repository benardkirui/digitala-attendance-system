<?php
session_start();
include("database/DAO.php");
$_SESSION["error"]="";
$_SESSION["fullname"]="";
$_SESSION["username"]="";
$_SESSION["phone"]="";
$_SESSION["location"]="";
$_SESSION["passcode"]="";
$_SESSION["password"]="";
if(isset($_POST["submit"]))
{
	$fullname=$_POST["fullname"];
	$username=$_POST["username"];
	$phonenumber=$_POST["phonenumber"];
	$location=$_POST["location"];
	$passcode=$_POST["passcode"];
	$password=$_POST["password"];
	$password1=$_POST["password2"];
	$_SESSION["fullname"]=$fullname;
	$_SESSION["username"]=$username;
	$_SESSION["phone"]=$phonenumber;
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
		if($dao->insertNewUser($fullname,$username,$phonenumber,$location,$isAdmin,$password)){
			header("Location:/home/?Registration succesful");
		}
		else {
			$_SESSION["error"]= "There was a problem with registration";
		}
	}


}
 ?>
