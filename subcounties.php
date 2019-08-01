<?php
$central=array("Silibwet","Singorwet","Ndarawetta","Chesoen","Mutarakwa");
$east=array("Longisa","Kembu","Chemaner","Merigi","Kipreres");
$chepalungu=array("Sigor","Kongasis","Chebunyo","Nyongores","Siongiroi");
$sotik=array("Ndanai","Kipsonoi","Kapletundo","Chemagel","Manaret");
$konoin=array("Kimulot","Mogogosiek","Boito","Embomos","Chepchabas");
if(isset($_POST['subcounty']))
{
    $subcounty=$_POST['subcounty'];
    if($subcounty=="Bomet Central")
    {
        foreach ($central as $value)
        {
            echo "<option>".$value."</option>";
        }
    }
    elseif ($subcounty=="Bomet East"){
        foreach ($east as $value)
        {
            echo "<option>".$value."</option>";
        }
    }
    elseif ($subcounty=="Chepalungu"){
        foreach ($chepalungu as $value)
        {
            echo "<option>".$value."</option>";
        }
    }
    elseif ($subcounty=="Sotik"){
        foreach ($sotik as $value)
        {
            echo "<option>".$value."</option>";
        }
    }
    elseif ($subcounty=="Konoin"){
        foreach ($konoin as $value)
        {
            echo "<option>".$value."</option>";
        }
    }
}
?>