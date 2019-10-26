<?php
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
        $_SESSION['error']="data deleted !!";
        $number_attachees=$dao->get_number_attachees();
    }
    else{
        $_SESSION['error']="Not Deleted!!";
    }

}
if(isset($_GET['delAdmin']))
{
    $idnumber=$_GET['idnumber'];
    if($dao->deleteAdmin($idnumber))
    {
        $_SESSION['error']="data deleted !!";
        $number_admins=$dao->get_number_admins();
    }
    else{
        $_SESSION['error']="Not Deleted!!";
    }

}
if(isset($_GET['delSup']))
{
    $idnumber=$_GET['idnumber'];
    if($dao->deleteSupervisor($idnumber))
    {
        $_SESSION['error']="data deleted !!";
        $number_supervisors=$dao->get_number_supervisors();
    }
    else{
        $_SESSION['error']="Not Deleted!!";
    }

}

if(isset($_POST['logout']))
{
    $dao->logout();

}
{

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
                        <h2 class="StepTitle">Attendance</h2>

                        <p class="links cl-effect-1">
                            Attendance section
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<hr>
<div class="container" id="container">
    <?php
    $result=$dao->selectAttachees();

    ?>




    <div class="wrapper animsition">

        <!-- /.content-wrapper -->
        <div class="content-wrapper">
            <div class="container">
                <!-- main content -->
                <div class="content">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel  lobidrag">
                                <div class="panel-heading">
                                    <h3 class="panel-title" >County Attachees</h3>
                                </div>
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Full Name</th>
                                                <th>Id Number</th>
                                                <th>Phone Number</th>
                                                <th>Institution</th>
                                                <th>Course</th>
                                                <th>Sub-County</th>
                                                <th>Specialization</th>
                                                <th>Supervisor</th>

                                            </tr>
                                            </thead>

                                                <?php
                                                $count=1;
                                                if(mysqli_num_rows($result)>0)
                                                {
                                                while($row=mysqli_fetch_assoc($result))
                                                {
                                                 $sup_id= $row['supervisor'];
                                                 $supname='';
                                                 $assign='';
                                                 if($sup_id==0 )
                                                 {
                                                     $assign='Assign';
                                                     $supname='Not Assigned';
                                                 }
                                                 else
                                                 {
                                                     $assign='Reassign';
                                                     $supname=$dao->get_supervisor_name($sup_id);
                                                 }
                                                echo '
                                                    <tr class="md-trigger m-b-5 m-r-2" data-modal="modal-13">
                                                    
                                                    <td>'.$count++.'</td>
                                                    <td>'.$row['name'].'</td>
                                                    <td>'.$row['idnumber'].'</td>
                                                    <td>'.$row['phone'].'</td>
                                                    <td>'.$row['institution'].'</td>
                                                    <td>'.$row['course'].'</td>
                                                    <td>'.$row['subcounty'].'</td>
                                                    <td>'.$row['specialization'].'</td>
                                                    <td>'.$supname.'</td>
                                                    <input type="hidden" value="'.$row['idnumber'].'"> 
					'
                                                ?>
                                            </tr>

                                            <?php
                                            }
                                            }
                                            else{
                                                echo '<tr>There is no data in the database</tr>';
                                            }

                                            ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.main content -->
            </div> <!-- /.container -->
        </div> <!-- /.content-wrapper -->


    </div> <!-- ./wrapper -->


</div>

<div class="md-modal md-effect-13" id="modal-13">
    <div class="md-content">
        <h3>Bomet County Government</h3>
        <div class="n-modal-body">

            <ul id="list">
            </ul>
            <div class="row">
                <button class="btn btn-danger md-close col-md-3" style="margin: 10px">Exit</button>
                <a    class="btn btn-success col-md-3" id="assign" style="margin: 10px"></a>
                <a  onClick="return confirm('Are you sure you want Delete?')" style="margin: 10px"  id="delete" class="btn btn-warning col-md-3">Delete</a>
            </div>
        </div>
    </div>
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

<!-- jQuery -->
<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
<!-- jquery-ui -->
<script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<!-- Bootstrap js -->
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- lobipanel js -->
<script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
<!-- animsition js -->
<script src="assets/plugins/animsition/js/animsition.min.js" type="text/javascript"></script>
<!-- bootsnav js -->
<script src="assets/plugins/bootsnav/js/bootsnav.js" type="text/javascript"></script>
<!-- SlimScroll js -->
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick js-->
<script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
<!-- End Core Plugins
=====================================================================-->
<!-- Start Page Lavel Plugins
=====================================================================-->
<!-- dataTables js -->
<script src="assets/plugins/datatables/dataTables.min.js" type="text/javascript"></script>
<!-- Start Theme label Script
=====================================================================-->
<!-- Dashboard js -->
<script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
<!-- End Theme label Script
=====================================================================-->
<script src="assets/plugins/modals/classie.js" type="text/javascript"></script>
<script src="assets/plugins/modals/modalEffects.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {

        "use strict"; // Start of use strict

        $('#dataTableExample1').DataTable({
            "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "lengthMenu": [[6, 25, 50, -1], [6, 25, 50, "All"]],
            "iDisplayLength": 6
        });

        $("#dataTableExample2").DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {extend: 'copy', className: 'btn-sm'},
                {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print', className: 'btn-sm'}
            ]
        });

        $("tr").click(
            function()
            {
                $("#list").html('');

                var children = $(this).children();
                var id =$(this).children().last().val();
                var elem1 = "<li><b>Full Name:<b> "+children[1].innerHTML+"</li>";
                var elem2 = "<li><b>ID Number:</b> "+children[2].innerHTML+"</li>";
                var elem3 = "<li><b>Phone Number: </b> "+children[3].innerHTML+"</li>";
                var elem4 = "<li><b>Institution: </b> "+children[4].innerHTML+"</li>";
                var elem5 = "<li><b>Course: </b> "+children[5].innerHTML+"</li>";
                var elem6 = "<li><b>Sub-County: </b> "+children[6].innerHTML+"</li>";
                var elem7 = "<li><b>Specialization: </b> "+children[7].innerHTML+"</li>";
                var elem8 = "<li><b>Supervisor: </b> "+children[8].innerHTML+"</li>";
                $("#list").append(elem1+elem2+elem3+elem4+elem5+elem6+elem7+elem8);
                var assign=children[8].innerHTML=='Not Assigned'?"Assign":"Re-Assign";
                $("#assign").attr("href","assign_supervisor.php?assignSup='' & idnumber="+id).html(assign);
                $("#delete").attr("href","admin.php?delAttachee='' & idnumber="+id);


            }
        );
    });
</script>

</html>
