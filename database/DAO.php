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
  public function insertNewUser($fullname,$username,$idnumber,$phonenumber,$isAdmin,$password)
  {
  if($this->checkIfExists($idnumber))
  {
    $_SESSION['error'] = "User details already exists";
    $_SESSION['message'] ="";
  }
  else{
    $sql="INSERT INTO users VALUES('$fullname','$username','$idnumber','$phonenumber','$isAdmin','$password')";
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
      $_SESSION['fullname']=$result['fullname'];
      $_SESSION['idnumber']=$result['idnumber'];
      $_SESSION['phonenumber']=$result['phonenumber'];


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
      echo "<span style='color: darkred'>The data has already been saved!</span>";
    }
  }

  public function selectAttachees()
  {
    $sql="SELECT * FROM attachees";
    $result=mysqli_query($this->conn,$sql);

    return $result;

  }
  public function selectAdmins()
  {
    $sql="SELECT * FROM users where level='admin'";
    $result=mysqli_query($this->conn,$sql);

    return $result;

  }

  public function get_number_attachees()
  {
    $sql="select count(*) from attachees;";
    $result=mysqli_query($this->conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
      $row=mysqli_fetch_assoc($result);
      return $row['count(*)'];
    }

  }
  public function get_number_admins()
  {
    $sql="select count(*) from users where level='admin'";
    $result=mysqli_query($this->conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
      $row=mysqli_fetch_assoc($result);
      return $row['count(*)'];
    }

  }
  public function get_number_supervisors()
  {
    $sql="select count(*) from supervisors";
    $result=mysqli_query($this->conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
      $row=mysqli_fetch_assoc($result);
      return $row['count(*)'];
    }

  }


  public function deleteAttachee($idnumber)
  {
    $sql1= "DELETE FROM attachees WHERE idnumber='$idnumber'";
    $sql2= "DELETE FROM users WHERE idnumber='$idnumber'";
    $result1=mysqli_query($this->conn,$sql1);
    $result2=mysqli_query($this->conn,$sql2);

    if($result1 && $result2)
    {
      return true;
    }
    else{
      return false;
    }

  }

  public function deleteAdmin($idnumber)
  {
    $sql2= "DELETE FROM users WHERE idnumber='$idnumber'";

    $result2=mysqli_query($this->conn,$sql2);

    if($result2)
    {
      return true;
    }
    else{
      return false;
    }

  }

  public function deleteSupervisor($idnumber)
  {
    $sql2= "DELETE FROM supervisors WHERE idnumber='$idnumber'";

    $result2=mysqli_query($this->conn,$sql2);

    if($result2)
    {
      return true;
    }
    else{
      return false;
    }

  }

  public function insertSupervisor($fullname,$idnumber,$department,$phonenumber,$email,$username,$password)
  {
    $password=md5($password);
    $sql="INSERT INTO supervisors VALUES('$idnumber','$fullname','$department','$phonenumber','$email','$username','$password')";
    $result=mysqli_query($this->conn,$sql);
    if($result)
    {
    echo "success";
    }
    else{
      echo $sql;
    }
  }

  public function selectSupervisors()
  {
    $sql="SELECT * FROM `supervisors`";
    $result=mysqli_query($this->conn,$sql);

    return $result;
  }
}

 ?>
