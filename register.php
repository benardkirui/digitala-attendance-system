<?php
include "database/DAO.php";
if(isset($_POST['name']))
{
    $dao= new DAO();
    $dao->insertAttachee($_POST['name'],$_POST['email'],$_POST['start'],$_POST['specialization'],$_POST['gender'],$_POST['language'],$_POST['phonenumber'],$_POST['idnumber'],$_POST['subcounty'],$_POST['ward'],$_POST['institution'],$_POST['course']);
}
?>