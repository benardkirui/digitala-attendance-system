<?php
session_start();
if($_SESSION['idnumber']==0)
{
    header('Location:logout.php');
}
include "database/DAO.php";
$dao= new DAO();
$_SESSION['error']="";
$number_attachees=$dao->get_number_attachees();
$number_admins=$dao->get_number_admins();
$number_supervisors=$dao->get_number_supervisors();
if(isset($_GET['delAttachee']))
{
    $idnumber=$_GET['idnumber'];
    if($dao->deleteAttachee($idnumber))
    {
        echo '
        <script>
        alert("Attachee Deleted");
        window.location.assign("attachees_table.php");
        </script>
        ';
    }
    else{
        echo '
        <script>
        alert("Failed to Delete Attachee");
        window.location.assign("attachees_table.php");
        </script>
        ';
    }

}
if(isset($_GET['delAdmin']))
{
    $idnumber=$_GET['idnumber'];
    if($dao->deleteAdmin($idnumber))
    {
        echo '
        <script>
        alert("Administrator Deleted");
        window.location.assign("admin_table.php");
        </script>
        ';
    }
    else{
        echo '
        <script>
        alert("Failed to Delete Administrator");
        window.location.assign("admin_table.php");
        </script>
        ';
    }

}
if(isset($_GET['delSup']))
{
    $idnumber=$_GET['idnumber'];
    if($dao->deleteSupervisor($idnumber))
    {
        echo '
        <script>
        alert("Supervisor Deleted");
         window.location.assign("supervisors_table.php");
        </script>
        ';
    }
    else{
        echo '
        <script>
        alert("Failed to Delete Supervisor");
        window.location.assign("supervisors_table.php");
        </script>
        ';
    }

}

if(isset($_POST['logout']))
{
    $dao->logout();
    
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">

    <!-- Start Global Mandatory Style
=====================================================================-->
    <link href="assets/dist/css/base.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- dataTables css -->
    <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style -->
    <link href="assets/dist/css/component_ui.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style rtl -->
    <link href="assets/dist/css/component_ui_rtl.css" rel="stylesheet" type="text/css">
    <!-- Custom css -->
    <link href="assets/dist/css/custom.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/modals/modal-component.css" rel="stylesheet" type="text/css">
    <!-- End Theme Layout Style
    =====================================================================-->
    <title></title>

    <script src="assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(
            function() {
                $("#attachees").click(
                    function()
                    {
                        window.location.assign('attachees_table.php');

                    }
                );
                $("#admin").click(
                    function()
                    {
                        window.location.assign('admin_table.php');
                    }
                );
                $("#supervisor").click(
                    function()
                    {
                        window.location.assign('supervisors_table.php');
                    }
                );
                $("#reports").click(
                    function()
                    {
                        window.location.assign('reports.php');
                    }
                );



            });
    </script>
</head>


<body >

<div class='text-center'> 
<h2>Admin Management</h2>
<div class="text-right" style="padding:10px;">  
<form action="" method="post">
<button type="submit" onClick="return confirm('Are you sure you want to Logout?')" name="logout" class="btn btn-danger btn-outline-dark">Logout</button>
</form>
 </div>
</div>

<hr>
<div class="container-fluid ">
    <div class="row">


        <div class="col-sm-3">
            <a>
            <div class="panel panel-white no-radius text-center" id="attachees">
                <div class="panel-body" >
                    <h2 class="StepTitle">Manage Attachees</h2>

                    <p class="links cl-effect-1">
                            Attachees: <?=$number_attachees?>
                    </p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-sm-3">
            <div class="panel panel-white no-radius text-center" id="admin">
                <div class="panel-body">
                    <h2 class="StepTitle">Manage Admins</h2>

                    <p class="cl-effect-1">

                            Total Admins: <?=$number_admins?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel panel-white no-radius text-center" id="supervisor">
                <div class="panel-body">
                    <h2 class="StepTitle"> Manage Supervisors</h2>

                    <p class="links cl-effect-1">
                            Total Supervisors: <?=$number_supervisors?>
                    </p>
                </div>
            </div>
          </div>
            <div class="col-sm-3">
                <a>
                <div class="panel panel-white no-radius text-center" id="reports">
                    <div class="panel-body" >
                        <h2 class="StepTitle">Report</h2>

                        <p class="links cl-effect-1">
                              Report section
                        </p>
                    </div>
                </div>
                </a>
            </div>
        </div>
</div>
<hr>
<div class="container" id="container">

</div>

</body>

<style>
    body{
        background: url("assets/images/bedge_grunge.png");
    }

    .panel-white:hover{
        height:150px;
        background-color: #1c94c4;
        color: white;
    }
    .panel-white{
        height:130px;
        background-color: white;
        color: #1c94c4;
    }

</style>




</html>
