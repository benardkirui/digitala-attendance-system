<?php
include "database/DAO.php";
$dao= new DAO();
if(isset($_POST['name']))
{
    $dao->insertAttachee($_POST['name'],$_POST['email'],$_POST['start'],$_POST['specialization'],$_POST['gender'],$_POST['language'],$_POST['phonenumber'],$_POST['idnumber'],$_POST['subcounty'],$_POST['ward'],$_POST['institution'],$_POST['course']);
}
if(isset($_POST['supervisor']))
{

    $dao->insertSupervisor($_POST['fullname'],$_POST['idnumber'],$_POST['department'],$_POST['phonenumber'],$_POST['email'],$_POST['username'],$_POST['password']);
}

if(isset($_POST['reportin']))
{
    $dao->insertReportIn($_POST['fullname'],$_POST['idnumber'],$_POST['timein']);
}

if(isset($_POST['reportout']))
{
    $dao->insertReportOut($_POST['idnumber'],$_POST['timeout'],$_POST['date']);
}

if(isset($_POST['ifexist']))
{

    //check the report type
    $report = $_POST['report'];
    if($report=='reportin')
    {
        $dao->checkIfAlreadyReportedIn($_POST['idnumber'],$_POST['date']);

    }
    else{
        $dao->checkIfAlreadyReportedOut($_POST['idnumber'],$_POST['date']);
    }
}

if(isset($_POST['done']))
{
    $date = date('Y-m-d H:i:s');
    $dao->insertAttacheeJob($_POST['idnumber'],$_POST['fullname'],$_POST['job_done'],$date);
}

?>
