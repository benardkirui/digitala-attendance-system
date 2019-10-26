<?php
session_start();
include "../database/DAO.php";
$dao= new DAO();
$result = $dao->select_attachee_supervisor_daily_reports($_SESSION['idnumber']);
if(isset($_POST['logout']))
{
    $dao->logout_supervisor();

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
include 'head.php';
?>


<body >

<div class='text-center'>
    <h2>Supervisor Section</h2>
    <div class="text-right" style="padding:10px;">
        <form action="" method="post">
            <button type="submit" onClick="return confirm('Are you sure you want to Logout?')" name="logout" class="btn btn-danger btn-outline-dark">Logout</button>
        </form>
    </div>
</div>

<hr>
<?php
include 'template.php';
?>
<hr>
<div class="container" id="container">
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
                                    <h3 class="panel-title" >Attaches Daily Report</h3>
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
                                                <th>Job Done</th>
                                                <th>Date</th>
<!--                                                <th>Action</th>-->
                                            </tr>
                                            </thead>

                                            <?php
                                            $count=1;
                                            if(mysqli_num_rows($result)>0)
                                            {
                                                while($row=mysqli_fetch_assoc($result))
                                                {
                                                    ?>
                                                    <tr class="md-trigger m-b-5 m-r-2" data-modal="modal-13">
                                                    <?php

                                                    echo '
                                                   
                                                  <td>'.$count++.'</td>
                                                    <td>'.$row['fullname'].'</td>
                                                    <td>'.$row['idnumber'].'</td>
                                                    <td>'.$row['phone'].'</td>
                                                    <td>'.$row['jobdone'].'</td>
                                                    <td>'.$row['date'].'</td>
                                             
                                                    
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
                <button class="btn btn-danger md-close col-md-5" style="margin: 10px">Exit</button>
            </div>
        </div>
    </div>
</div>


</body>

<style>
    body{
        background: url("../assets/images/bedge_grunge.png");
    }

    .panel-white:hover{
        height:150px;
        background-color: #1c94c4;
        color: white;
    }
    .panel-white{
        height:140px;
        background-color: white;
        color: #1c94c4;
    }

</style>

<!-- jQuery -->
<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
<!-- jquery-ui -->
<script src="../assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<!-- Bootstrap js -->
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- lobipanel js -->
<script src="../assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
<!-- animsition js -->
<script src="../assets/plugins/animsition/js/animsition.min.js" type="text/javascript"></script>
<!-- bootsnav js -->
<script src="../assets/plugins/bootsnav/js/bootsnav.js" type="text/javascript"></script>
<!-- SlimScroll js -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick js-->
<script src="../assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
<!-- End Core Plugins
=====================================================================-->
<!-- Start Page Lavel Plugins
=====================================================================-->
<!-- dataTables js -->
<script src="../assets/plugins/datatables/dataTables.min.js" type="text/javascript"></script>
<!-- Start Theme label Script
=====================================================================-->
<!-- Dashboard js -->
<script src="../assets/dist/js/dashboard.js" type="text/javascript"></script>
<!-- End Theme label Script
=====================================================================-->
<script src="../assets/plugins/modals/classie.js" type="text/javascript"></script>
<script src="../assets/plugins/modals/modalEffects.js" type="text/javascript"></script>
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



    });

  $("tr").click(
      function()
      {
          $("#list").html('');
          var children = $(this).children();
          var elem1 = "<li>Full Name: "+children[1].innerHTML+"</li>";
          var elem2 = "<li>ID Number: "+children[2].innerHTML+"</li>";
          var elem3 = "<li>Phone Number: "+children[3].innerHTML+"</li>";
          var elem4 = "<li>Job Done: "+children[4].innerHTML+"</li>";
          var elem5 = "<li>Date: "+children[5].innerHTML+"</li>";
          $("#list").append(elem1+elem2+elem3+elem4+elem5);



      }
  );
</script>


</html>
