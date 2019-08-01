<?php

class Config{
  public $conn;
  public function __construct()
  {
    $host="localhost";
      $username="root";
      $password="";
      $dbname="attendance";
      $port=3306;
      $con=mysqli_connect($host,$username,$password,$dbname,$port);
      if(!$con)
      {
        die("There was a connection error");
      }
      else{
        $this->conn=$con;
        //connection was succesful
      }
  }
  public function getConnected()
  {
    return $this->conn;
  }
}

 ?>
