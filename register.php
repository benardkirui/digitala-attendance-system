<?php
include "database/DAO.php";
$dao= new DAO();
if(isset($_POST['name']))
{
    $dao->insertAttachee($_POST['name'],$_POST['email'],$_POST['start'],$_POST['specialization'],$_POST['gender'],$_POST['language'],$_POST['phonenumber'],$_POST['idnumber'],$_POST['subcounty'],$_POST['ward'],$_POST['institution'],$_POST['course']);
}
if(isset($_POST['fullname']))
{

    $dao->insertSupervisor($_POST['fullname'],$_POST['idnumber'],$_POST['department'],$_POST['phonenumber'],$_POST['email'],$_POST['username'],$_POST['password']);
}


?>
