<?php
session_start();
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

if(isset($_POST['report_weekly']))
{
    $dao->insert_weekly_report($_POST['work_done'],$_POST['challenges'],$_POST['solutions'],$_POST['engagement'],$_POST['plan'],$_POST['date'],$_SESSION['idnumber']);
}

if(isset($_POST['checkid']))
{
    $dao->check_supervisor($_POST['idnumber']);
}
if(isset($_POST['checkusername']))
{
    $dao->check_supervisor_username($_POST['username']);
}
if(isset($_POST['assignSup']))
{
    $supervisor=$_POST['sup'];
    $array= explode('-',$supervisor);
    $sup_id = $array[count($array)-1];
    $dao->assign_supervisor($_POST['attachee'],$sup_id);
}

?>
