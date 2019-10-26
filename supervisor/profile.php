<?php
session_start();
include "../database/DAO.php";
$dao= new DAO();
if(isset($_POST['logout']))
{
    $dao->logout_supervisor();

}
$sup_id=$_SESSION['idnumber'];
$result = $dao->select_supervisor_details($sup_id);
$row=mysqli_fetch_assoc($result);

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

<input type="hidden" id="sup_id" value="<?=$sup_id?>">
<hr>
<div class="container" id="container">
    <div class="text-right">
        <button class="btn btn-info md-trigger m-b-5 m-r-2" data-modal="modal-11" >Change Password</button>
    </div>
    <div class="card">
        <div class="card-header">
            <h1>My Profile </h1>

        </div>
        <div class="card-body">
            <div id="card" class="card">
                <div class="card-body" id="body1">
                    <div class="form-group">
                        <label>Full Supevisor Name</label>
                        <input type="text" class="form-control" id="fullname" placeholder="Name" value="<?=$row['fullname']?>" >
                    </div>
                    <div class="form-group">
                        <label >Id Number</label>
                        <input type="number" class="form-control" id="idnumber" placeholder="ID Number" value="<?=$row['idnumber']?>" >
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <input type="text" class="form-control" id="department" placeholder="Department"  value="<?=$row['department']?>">
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" class="form-control" id="phonenumber" placeholder="Phone Number" value="<?=$row['phonenumber']?>">
                    </div>
                </div>
                <div class="card-body" id="body2">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" value="<?=$row['email']?>" >
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Username" value="<?=$row['username']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" id="submit"  class="btn btn-success btn-lg btn-block">Submit</button>
        </div>

    </div>
    <style media="screen">
        #card{
            display: flex;
            flex-flow: wrap;
            justify-content: space-between;
        }
        .form-group,.form-control{
            width:90%;
        }
        #body1,#body2{
            height: auto;
            width:50%;
        }
        .card-footer
        {
            background-color: #1c94c4;
            color: white;
        }
    </style>
    <!--        //THE MODAL-->
    <div class="modal" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bomet County Government</h4>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/verifier.js"></script>
    <script type="text/javascript">
        $(document).ready(
            function()
            {
                $("#submit").click(
                    function()
                    {

                        // preventDefault();
                        var fullname=$("#fullname").val();
                        var idnumber=$("#idnumber").val();
                        var department=$("#department").val();
                        var phonenumber=$("#phonenumber").val();
                        var username=$("#username").val();
                        var email=$("#email").val();
                        if(fullname=='' || idnumber=='' || department=='' || username=='' || email=='' || phonenumber=='' )
                        {
                            showError("You cannot leave some fields empty");
                        }
                        else{
                            $.post("linking.php",{updateSupervisor:"updateSupervisor",fullname:fullname,idnumber:idnumber,department:department,phonenumber:phonenumber,email:email,username:username},function(data,status)
                            {


                                if(data=='yes')
                                {
                                    window.location.assign("profile.php");
                                }
                                else{
                                    showError("Failed to insert supervisor");
                                }
                            });
                        }

                    }
                );

                $("#idnumber").attr("disabled",true);

                $("#username").focusout(
                    function()
                    {
                        var username = $(this).val();
                        $.post("linking.php",{checkusername:"checkusername",username:username},
                            function(data,status)
                            {
                                if(data == "yes")
                                {
                                    showError("Username already exists");
                                }

                            }
                        );
                    }
                );
                $("#old_password").focusout(
                    function () {
                        var old_pass= $(this).val();
                        var sup_id= $("#sup_id").val();
                        $.post('linking.php',{checkPassword:"checkPassword",old_pass:old_pass,sup_id:sup_id},
                            function (data,status) {
                                if(data=='yes')
                                {
                                    $("#notif-p").removeClass('alert-danger').addClass('alert-success').html("Old Password verified");
                                }
                                else{
                                    $("#old_password").val('');
                                    $("#notif-p").removeClass('alert-success').addClass('alert-danger').html("Old Password is not correct");
                                }
                            }
                        );
                    }
                );
                $('#confirm_new').keyup(
                    function () {
                        var pass1= $("#new_password").val();
                        var pass2= $(this).val();

                        if(pass1 == pass2)
                        {
                            $("#notif-p").removeClass('alert-danger').addClass('alert-success').html("Passwords Match");
                        }
                        else{
                            $("#notif-p").removeClass('alert-success').addClass('alert-danger').html("Passwords do not match");
                        }

                    }
                );
                $("#change").click(
                    function()
                    {
                        var sup_id=$("#sup_id").val();
                        var password=$("#new_password").val();

                        if(password.length<6)
                        {
                            $("#notif-p").removeClass('alert-success').addClass('alert-danger').html("Password Length should be at least 6 characters");
                        }
                        else{
                            $.post('linking.php',{changePassword:"changePassword",sup_id:sup_id,password:password},
                                function (data,status) {
                                    if(data=='yes')
                                    {
                                        $(".md-content").addClass('bg-success');
                                        $("#title").html("Password update succesfully");
                                        $(".tohide").remove();
                                        $(".md-close").click(
                                            function(){
                                                window.location.assign('profile.php');
                                            }
                                        );
                                    }
                                    else{
                                        $(".md-content").addClass('bg-warning');
                                        $("#title").html("Password Failed to update ");
                                        $(".tohide").remove();
                                    }
                                }
                            );
                        }
                    }
                );
            }
        );
    </script>


</div>
<div class="md-modal md-effect-11" id="modal-11">
    <div class="md-content">
        <h3 id="title">Bomet County Government</h3>
        <div class="n-modal-body">
            <p id="notif-p" class="tohide">Change Password</p>
            <div class="form-group tohide">
                <input type="password" placeholder="Enter old Password" id="old_password" class="form-group">
            </div>
            <div class="form-group tohide">
                <input type="password" placeholder="Enter New Password" id="new_password" class="form-group">
            </div>
            <div class="form-group tohide">
                <input type="password" placeholder="Confirm New Password" id="confirm_new" class="form-group">
            </div>
            <div class="row">
                <button class="btn btn-danger md-close col-md-5" style="margin: 10px">Exit</button>
                <button class="btn btn-success col-md-5 tohide" style="margin: 10px" id="change">Change</button>
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
</script>


</html>

