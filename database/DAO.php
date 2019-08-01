<?php
include("config.php");
class DAO{
  public $conn;
  public function __construct()
  {
    $config= new Config();
    $this->conn=$config->getConnected();
  }

  //function to select everything from the users table
  public function selectAllUsers()
  {
    $sql="SELECT * FROM users ";
    $result=mysqli_query($this->conn,$sql);
    if($result)
    {
      return $result;
    }
    else {
      echo "There was a problem with the database ";
    }
  }

  //function to insert into the users database
  public function insertNewUser($fullname,$username,$idnumber,$location,$isAdmin,$password)
  {
  if($this->checkIfExists($idnumber))
  {
    $_SESSION['error'] = "User details already exists";
    $_SESSION['message'] ="";
  }
  else{
    $sql="INSERT INTO users VALUES('$fullname','$username','$idnumber','$location','$isAdmin','$password')";
    if(mysqli_query($this->conn,$sql)){
      $_SESSION['message'] ="Inserted Succesfully";
      $_SESSION['error'] ="";
    }
    else {

      $_SESSION['error'] = "Failed To insert data";
      $_SESSION['message'] ="";
    }
  }
  }

  //a function to check if exists
  public function checkIfExists($idnumber)
  {
    $sql='SELECT * FROM users WHERE idnumber='.$idnumber;
    $result=mysqli_query($this->conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
      return true;
    }
    else{
      return false;
    }

  }

  public function checkAttacheeLogin($username,$password)
  {
    $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result=mysqli_query($this->conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
      $result=mysqli_fetch_assoc($result);
      $_SESSION['username']=$result['username'];
      $_SESSION['idnumber']=$result['idnumber'];
      $isAdmin=$result['level'];
      if($isAdmin=='admin')
      {
        $_SESSION['error']='This is not your page';
      }
      else{
        if($this->checkRegistered($result['idnumber']))
        {
          //the user has already registered take them to their page
          Header("Location:attachee.php?Login succesful");
        }
        else{
          //the user has not registered take him to the register page
          Header("Location:registration.php?Login succesful");
        }
      }

    }
    else{
      $_SESSION['error']='Sorry your details are not present';
    }
  }

  public function checkAdminLogin($username,$password)
  {
    $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result=mysqli_query($this->conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
      $result=mysqli_fetch_assoc($result);
      $_SESSION['username']=$result['username'];
      $_SESSION['idnumber']=$result['idnumber'];
      $isAdmin=$result['level'];
      if($isAdmin=='admin')
      {
        Header("Location:admin.php?Login succesful");

      }
      else{
        $_SESSION['error']='This is not your page';
      }

    }
    else{
      $_SESSION['error']='Sorry your details are not present';
    }
  }

  //check if the attachee has fully registered
  public function checkRegistered($idnumber)
  {
    $sql="SELECT * FROM attachees where idnumber='$idnumber'";
    $result=mysqli_query($this->conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
      return true;
    }
    else{
      return false;
    }

  }
  
  public function insertAttachee($name,$email,$start,$specialization,$gender,$language,$phone,$idnumber, $subcounty,$ward,$institution,$course)
  {
    $sql="INSERT INTO attachees VALUES('$name','$email','$start','$specialization','$gender','$language','$phone','$idnumber','$subcounty','$ward','$institution','$course')";
    $result=mysqli_query($this->conn,$sql);
    if($result)
    {
      echo "Success data saved";
    }
    else{
      echo "Failed to insert data";
    }
  }
}

 ?>
