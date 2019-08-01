<?php
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title></title>
    <script src="assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(
            function()
            {
                $("#notif1").slideToggle(1);
                $("#notif2").slideToggle(1);
                $("#subcounty").change(
                    function()
                    {
                        var subcounty=$("#subcounty").val();
                        $("#ward").load("subcounties.php",{subcounty:subcounty});
                    }
                );
                $("button").click(
                    function(event)
                    {
                        event.preventDefault();
                        var name= $("#name").val();
                        var email= $("#email").val();
                        var start= $("#start").val();
                        var specialization= $("#specialization").val();
                        var gender= $("#gender").val();
                        var language= $("#language").val();
                        var phonenumber= $("#phonenumber").val();
                        var idnumber= $("#idnumber").val();
                        var subcounty= $("#subcounty").val();
                        var ward= $("#ward").val();
                        var institution= $("#institution").val();
                        var course= $("#course").val();

                        if(name=='')
                        {

                            $("#notif1").slideToggle(1000);
                            $("#notif1").html("Name cannot be empty");
                            $("#notif1").css("color","red");
                            $("#notif1").slideToggle(1000);

                        }
                        else if(email=='')
                        {
                            $("#notif1").slideToggle(1000);
                            $("#notif1").html("Email cannot be empty");
                            $("#notif1").css("color","red");
                            $("#notif1").slideToggle(1000);
                        }
                        else if(start=='')
                        {
                            $("#notif1").slideToggle(1000);
                            $("#notif1").html("Start cannot be empty");
                            $("#notif1").css("color","red");
                            $("#notif1").slideToggle(1000);
                        }
                        else if(phonenumber=='')
                        {
                            $("#notif2").slideToggle(1000);
                            $("#notif2").html("Phone Number cannot be empty");
                            $("#notif2").css("color","red");
                            $("#notif2").slideToggle(1000);
                        }
                        else if(phonenumber.length!==10)
                        {
                            $("#notif2").slideToggle(1000);
                            $("#notif2").html("Enter correct phone length");
                            $("#notif2").css("color","red");
                            $("#notif2").slideToggle(1000);
                        }
                        else if(idnumber=='')
                        {
                            $("#notif2").slideToggle(1000);
                            $("#notif2").html("ID Number cannot be empty");
                            $("#notif2").css("color","red");
                            $("#notif2").slideToggle(1000);
                        }
                        else if(idnumber.length >=9 )
                        {
                            $("#notif2").slideToggle(1000);
                            $("#notif2").html("Enter correct ID length");
                            $("#notif2").css("color","red");
                            $("#notif2").slideToggle(1000);
                        }
                        else if(course=='')
                        {
                            $("#notif2").slideToggle(1000);
                            $("#notif2").html("Course cannot be empty");
                            $("#notif2").css("color","red");
                            $("#notif2").slideToggle(1000);
                        }
                        else if(institution=='')
                        {
                            $("#notif2").slideToggle(1000);
                            $("#notif2").html("Institution cannot be empty");
                            $("#notif2").css("color","red");
                            $("#notif2").slideToggle(1000);
                        }

                        else if(ward=='')
                        {
                            $("#notif2").slideToggle(1000);
                            $("#notif2").html("Ward cannot be empty");
                            $("#notif2").css("color","red");
                            $("#notif2").slideToggle(1000);
                        }
                        else{
                            $("h2").toggle(1);
                            //everything is correct
                            $.post("register.php",{name:name,email:email,start:start,specialization:specialization,gender:gender,language:language,phonenumber:phonenumber,idnumber:idnumber,subcounty:subcounty,ward:ward,institution:institution,course:course},function(data,status)
                                {

                                    $("h2").html(data);
                                    $("h2").css("padding","70px 0")
                                    $("h2").toggle(2000);
                                    $("div").slideUp(2000);
                                }
                            );
                        }

                    }
                );
            }

        );
    </script>
</head>
<body >

<center>  <h2>Absolute Attachee registration</h2></center>
<br><br>



<form>

    <div class="container">
        <div id="container1">
            <h4 id="notif1"></h4>
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input type = "text" id = "name" class="form-control" >
                        <span class = "error"> </span>
                    </td>
                </tr>

                <tr>
                    <td>E-mail: </td>
                    <td><input type = "text" id = "email" class="form-control">
                        <span class = "error"> </span>
                    </td>
                </tr>

                <tr>
                    <td>Starting date:</td>
                    <td> <input type = "date" id = "start" class="form-control">
                        <span class = "error"></span>
                    </td>
                </tr>

                <tr>
                    <td>Specialisation:</td>
                    <td><select id="specialization" class="form-control">
                            <option value="">Programming</option>
                            <option value="">Networking</option>
                            <option value="">OS Installation</option>
                            <option value="">Technical</option>
                            <option value="">Other</option>
                        </select></td>
                </tr>

                <tr>
                    <td>Gender:</td>
                    <td>
                        <select id="gender" class="form-control">
                            <option value="">Male</option>
                            <option value="">Female</option>
                        </select>
                        <span class = "error"></span>
                    </td>
                </tr>

                <tr>
                    <td>Select:</td>
                    <td>
                        <select id = "language" class="form-control">
                            <option value = "Android">Android</option>
                            <option value = "Java">Java</option>
                            <option value = "C#">C#</option>
                            <option value = "Data Base">Data Base</option>
                            <option value = "Hadoop">Hadoop</option>
                            <option value = "VB script">VB script</option>
                        </select>
                    </td>
                </tr>





            </table>
        </div>
        <div id="container2">
            <h4 id="notif2"></h4>
            <table>
                <tr>
                    <td>Phone Number:</td>
                    <td> <input type = "text" id = "phonenumber" class="form-control">
                        <span class = "error"></span>
                    </td>
                </tr>
                <tr>
                    <td>ID Number:</td>
                    <td> <input type = "text" id = "idnumber" class="form-control">
                        <span class = "error"></span>
                    </td>
                </tr>

                <tr>
                    <td>Sub County:</td>
                    <td> <select id="subcounty" class="form-control">
                            <option>Bomet East</option>
                            <option>Bomet Central</option>
                            <option>Chepalungu</option>
                            <option>Sotik</option>
                            <option>Konoin</option>
                        </select>
                        <span class = "error"></span>
                    </td>
                </tr>

                <tr>
                    <td>Ward:</td>

                    <td>
                        <select id="ward" class="form-control">

                        </select>
                        <span class = "error"></span>
                    </td>
                </tr>

                <tr>
                    <td>Institution:</td>
                    <td>
                        <input type = "text" id = "institution" class="form-control">
                        <span class = "error"></span>
                    </td>
                </tr>

                <tr>
                    <td>Course:</td>
                    <td> <input type = "text" id = "course" class="form-control">
                        <span class = "error"></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
<br><br>
    <center>
        <div id="button">
            <button type="submit" id="button"  >Submit</button>
        </div>
    </center>

</form>
</body>

<style media="screen">
    td{
        padding:20px;
    }
    h2{
        color:blue;
        justify-content: center;
    }

    h3{
        justify-content: center;
    }
    body{
        font-size: 20px;
        font-style: normal;
        font-family: sans-serif;
        background-color: rgba(46, 46, 63,0.4);

    }
    button{
        color: #3f4db0;
        background: white;
        border-radius: 20px;
        border: 3px solid #3f4db0;
        width:500px;
        height: 40px;
    }
    button:hover{
        color: white;
        background: #3f4db0;
        border-radius: 20px;
        border: 3px solid white;
        width:500px;
        height: 40px;
    }
    #container1:hover
    {
        background-color: rgba(46, 46, 63,0.7);
        color:white;
    }
    #container2:hover
    {
        background-color: rgba(46, 46, 63,0.7);
        color:white;
    }
    #container1,#container2{
        background-color: rgba(46, 46, 63,0.6);

    }

    .form-control,textarea{
        width: 300px;
        border-radius: 20px;
        border: 3px solid blue;
    }
    .form-control:hover {
        border: 3px solid grey;
    }
    h2{
        color:royalblue;
    }
    .container{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

    }
</style>
</html>
