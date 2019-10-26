<?php
session_start();
include "../database/DAO.php";
$dao = new DAO();
if(isset($_POST['assignTask']))
{
    $date = date('l  d F, Y ');
    $dao->asssign_task($_POST['attachee'],$_SESSION['idnumber'],$date,$_POST['task']);
}

if(isset($_POST['makeComments']))
{
    $dao->make_comments($_POST['report_id'],$_POST['comments']);
}
if(isset($_POST['checkPassword']))
{
    $dao->check_supervisor_old_pass($_POST['sup_id'],md5($_POST['old_pass']));
}
if(isset($_POST['changePassword']))
{
    $dao->change_supervisor_password($_POST['sup_id'],md5($_POST['password']));
}
if(isset($_POST['checkusername']))
{
    $dao->check_supervisor_username($_POST['username']);
}

if(isset($_POST['updateSupervisor']))
{
    $dao->update_supervisor($_POST['idnumber'],$_POST['fullname'],$_POST['department'],$_POST['phonenumber'],$_POST['email'],$_POST['username']);

}