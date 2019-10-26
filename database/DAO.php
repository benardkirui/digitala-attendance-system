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

  //function to logout
  public function logout()
  {
    echo '
    <script>
    alert("Logged out");
    </script>
    ';
    session_destroy();
    header("Location:view_attendance.php");

  }
  //function to logout
  public function logout_attachee()
  {
    echo '
    <script>
    alert("Logged out");
    </script>
    ';
    session_destroy();
    header("Location:index.php");

  }
    //function to logout
    public function logout_supervisor()
    {
        echo '
    <script>
    alert("Logged out");
    </script>
    ';
        session_destroy();
        header("Location:../view_attendance.php");

    }

  //function to insert report in
  public function insertReportIn($fullname,$idnumber,$reportin)
  {
    $sql="INSERT INTO reporting (fullname,idnumber,reportin) VALUES('$fullname','$idnumber','$reportin')";
    $result=mysqli_query($this->conn,$sql);
    if($result)
    {
      echo "yes";
    }
    else{
      echo "no";
    }
  }

  //function to insert report out
  public function insertReportOut($idnumber,$reportout,$date)
  {
//    $date = date('d-m-Y');//24-8-2019

    $sql = "UPDATE reporting SET reportout='$reportout' WHERE idnumber='$idnumber' AND reportin LIKE '%$date%'";
    $result=mysqli_query($this->conn,$sql);
    if($result)
    {
      $sql="SELECT * FROM reporting WHERE idnumber='$idnumber' AND reportout='$reportout'";// sql to select reporting details
      $result=mysqli_query($this->conn,$sql);
      $date=date('Y-m-d');

      $sql2="SELECT * FROM done WHERE idnumber='$idnumber' AND date LIKE '%$date%'";//sql to select the job done
    
      $row= mysqli_fetch_assoc($result);
      $result=mysqli_query($this->conn,$sql2);//selects the job done for the day
      $row2=mysqli_fetch_assoc($result);
      $data= array(
          'fullname'=>$row['fullname'],
        'idnumber'=>$row['idnumber'],
        'reportin'=>$row['reportin'],
        'reportout'=>$row['reportout'],
        'jobdone'=>$row2['jobdone']
      );

      echo json_encode($data);
    }
    else{
      echo $sql;
    }
  }

  //function to check if the attachee already reported in
  public function checkIfAlreadyReportedIn($idnumber,$date)
  {
    $sql="SELECT * FROM reporting WHERE idnumber='$idnumber' AND reportin LIKE '%$date%'";
    $result=mysqli_query($this->conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
      echo 'yes';
    }
    else{
      echo 'no';
    }
  }



  public function checkIfAlreadyReportedOut($idnumber,$date)
  {
    $sql="SELECT * FROM reporting WHERE idnumber='$idnumber' AND reportout LIKE '%$date%'";
    $result=mysqli_query($this->conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
      echo 'yes';
    }
    else{
      echo 'no';
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
          Header("Location:panels.php?Login succesful");
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

      $this->check_supervisor_login($username,$password);

      $_SESSION['error']='Sorry your details are not present';
    }
  }

  //function to get the name of the supervisor
  public function get_supervisor_name($idnumber)
  {
    $sql ="SELECT * FROM supervisors WHERE idnumber=$idnumber";
    $result = mysqli_query($this->conn,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row['fullname'];
  }

  //function to check supervisor login
  public function check_supervisor_login($username,$password)
  {
    $sql = "SELECT * FROM supervisors WHERE username='$username' AND password='$password'";
    $result = mysqli_query($this->conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
      //not return anything coz it will switch to another page
      $row = mysqli_fetch_assoc($result);
      $_SESSION['idnumber']=$row['idnumber'];
      Header("Location:supervisor/supervisor.php");
    }
    else{
      return false;
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

  //function to check if supervisor id already exist
  public function check_supervisor($id)
  {
    $sql = "SELECT * FROM supervisors WHERE idnumber=$id";
    $result = mysqli_query($this->conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
      echo "yes";
    }
    else{
      echo 'no';
    }
  }

  //function to check if the username already exist
  public function check_supervisor_username($username)
  {
    $sql = "SELECT * FROM supervisors WHERE username='$username'";
    $result = mysqli_query($this->conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
      echo "yes";
    }
    else{
      echo 'no';
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
    $sql="SELECT * FROM supervisors";
    $result=mysqli_query($this->conn,$sql);

    return $result;
  }


  // a function to insert a job done by attachee
  public function insertAttacheeJob($idnumber,$fullname,$job_done,$date)
  {
    $sql= "INSERT INTO done (idnumber,fullname,jobdone,date) VALUES('$idnumber','$fullname','$job_done','$date')";
    $result=mysqli_query($this->conn,$sql);
    if($result)
    {
      echo 'yes';
    }
    else{
      echo $sql;
    }
  }


  //FUNCTION TO SELECT THE JOBS DONE
    public function select_jobs_done($id)
    {
        $sql = "SELECT * FROM done WHERE idnumber=$id ORDER BY id DESC ";
        $result=mysqli_query($this->conn,$sql);
        return $result;
    }

    //function to select the attendance
    public function select_attendance($id)
    {
        $sql = "SELECT * FROM reporting ORDER BY id DESC";
        $result=mysqli_query($this->conn,$sql);
        return $result;
    }

    //function ot inset the weekly report
  public function insert_weekly_report($work_done,$challenges,$solutions,$engagement,$plan,$week_ending,$attachee_id)
  {
    $sql = "INSERT INTO weekly ( work_done, challenges, solutions, engagement, plan, week_ending, attachee_id)
    VALUES('$work_done','$challenges','$solutions','$engagement','$plan','$week_ending',$attachee_id)
";
    $result=mysqli_query($this->conn,$sql);
    if($result)
    {
      echo "yes";
    }
    else{
      echo "no";
    }
  }

  //function to select attachee weekly report
  public function select_attachee_weekly_report($id)
  {
    $sql = "SELECT * FROM weekly WHERE attachee_id=$id";
    $result=mysqli_query($this->conn,$sql);
    return $result;

  }

  //function to select all the attendance
  public function select_all_attendance()
  {
    $sql = "SELECT * FROM reporting ORDER BY reportout DESC ";
    $result=mysqli_query($this->conn,$sql);
    return $result;
  }

  //function to assign a supervisor
  public function assign_supervisor($attachee,$supervisor)
  {
    $sql ="UPDATE attachees SET supervisor=$supervisor WHERE idnumber=$attachee";
    $result=mysqli_query($this->conn,$sql);
    if($result)
    {
      echo 'yes';
    }
    else{
      echo 'no';
    }
  }

  //function to select the supervisor attachees
  public function select_supervisor_attachees($idnumber)
  {
    $sql ="SELECT * FROM attachees WHERE supervisor=$idnumber";
    $result=mysqli_query($this->conn,$sql);
    return $result;
  }

  //function to assign task
  public function asssign_task($assigned_to,$assigned_by,$date,$description)
  {
    $sql = "INSERT INTO task (assigned_to,assigned_by,date,description)
VALUES($assigned_to,$assigned_by,'$date','$description')
";
    $result=mysqli_query($this->conn,$sql);
    if($result)
    {
      echo 'yes';
    }
    else{
      echo 'no';
    }
  }

    //function to select daily reports for a supervisors attachees
    public function select_attachee_supervisor_daily_reports($sup_id)
    {
        $sql = "SELECT d.* ,att.phone,att.supervisor  FROM done d,attachees att WHERE att.supervisor=$sup_id AND d.idnumber=att.idnumber ORDER BY d.date DESC";
        $result=mysqli_query($this->conn,$sql);
//        echo $sql;
        return $result;

    }

    //function to select weekly reports for a supervisors attachees
    public function select_attachee_supervisor_weekly_reports($sup_id)
    {
        $sql = "SELECT w.* ,att.phone,att.name  FROM weekly w,attachees att WHERE att.supervisor=$sup_id AND w.attachee_id=att.idnumber ORDER BY w.week_ending DESC";
        $result=mysqli_query($this->conn,$sql);
//        echo $sql;
        return $result;

    }

    //function to get the existing comments
    public function get_existing_comments($id)
    {
        $sql = "SELECT comments FROM weekly WHERE id=$id";
        $result = mysqli_query($this->conn,$sql);
        return $result;
    }

    //function to make comments
    public function make_comments($id,$comments)
    {
        $sql = "UPDATE weekly SET comments='$comments' WHERE id=$id";
        $result=mysqli_query($this->conn,$sql);
        if($result)
        {
            echo 'yes';
        }
        else{
            echo 'no';
        }
    }

    //function to select the supervisors details
    public function select_supervisor_details($id)
    {
        $sql = "SELECT * FROM supervisors WHERE idnumber=$id";
        $result = mysqli_query($this->conn,$sql);
        return $result;
    }

    //function to check old supervisor password
    public function check_supervisor_old_pass($sup_id,$password)
    {
        $sql= "SELECT * FROM supervisors WHERE idnumber=$sup_id AND password='$password'";
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_num_rows($result)>0)
        {
            echo "yes";
        }
        else{
            echo "no";
        }
    }
    //function ot change the supervisor password
    public function change_supervisor_password($sup_id,$password)
    {
        $sql= "UPDATE supervisors SET password='$password' WHERE idnumber=$sup_id";
        $result = mysqli_query($this->conn,$sql);
        if($result)
        {
            echo "yes";
        }
        else{
            echo "no";
        }
    }

    //function to select the filtered attendance dates
  public function select_filtered_attendance($from,$to)
  {
    $sql = "SELECT * FROM reporting WHERE reportout>='$from' AND reportout<='$to'";
    echo $sql;
  }


    //function to update the supervisor
    public function update_supervisor($idnumber,$fullname,$department,$phonenumber,$email,$username)
    {
        $sql ="
            UPDATE supervisors SET
            idnumber=$idnumber,fullname='$fullname',department='$department',phonenumber='$phonenumber',
            email='$email',username='$username' WHERE idnumber=$idnumber
        ";
        $result = mysqli_query($this->conn,$sql);
        if($result)
        {
            echo "yes";
        }
        else{
            echo "no";
        }
    }

    //function to select the tasks assigned to the attachee
  public function select_attachee_tasks($id)
  {
    $sql = "SELECT t.*, sup.fullname FROM task t , supervisors sup WHERE t.assigned_to=$id AND sup.idnumber=t.assigned_by ORDER BY t.id DESC";
    $result = mysqli_query($this->conn,$sql);
    return $result;
  }
}

 ?>
