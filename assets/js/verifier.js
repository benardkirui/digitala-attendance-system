//function to show error
function showError(message)
{
    $("#modal").slideDown(1000);
    $(".modal-title").html(message);
    $(".modal-content").addClass("bg-danger");
    $("#modal").hide(5000);

}
//function to show success
function showSuccess(message)
{
    $("#modal").slideDown(1000);
    $(".modal-title").html(message);
    $(".modal-content").addClass("bg-success");
    $("#modal").hide(5000);

}

//function to check if empty
function check_if_empty(item,name)
{
 if(item =='')
 {
     showError("You cannot leave "+name+" empty");
     return true;
 }
 else{
     return true;
 }
}

//function to check minimum length
function check_min_length(item,name,length)
{
    if(item.length<length)
    {
        showError(name+" must be at least "+length+" characters of length");
        return false;
    }
    else{
        return true;
    }
}