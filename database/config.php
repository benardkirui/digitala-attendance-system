<?php

class Config{

  public function getConnected()
  {
    $host="localhost";
      $username="root";
      $password="kiptoo";
      $dbname="attendance";
      $port=3306;
      $con=mysqli_connect($host,$username,$password,$dbname,$port);
      if(!$con)
      {
        die("There was a connection error");
      }
      else{
      return $con;
        //connection was succesful
      }
    return $con;
  }
}

 ?>
