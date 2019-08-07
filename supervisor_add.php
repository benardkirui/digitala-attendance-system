<div class="card">
<form  action="" method="post">
  <div class="card-header">
    <h1>Add Supervisor</h1>
  </div>
  <div class="card-body">
    <div id="card" class="card">
      <div class="card-body" id="body1">
        <div class="form-group">
          <label>Full Supevisor Name</label>
          <input type="text" class="form-control" id="fullname" placeholder="Name" >
        </div>
        <div class="form-group">
          <label >Id Number</label>
          <input type="number" class="form-control" id="idnumber" placeholder="ID Number" >
        </div>
        <div class="form-group">
          <label>Department</label>
          <input type="text" class="form-control" id="department" placeholder="Department" >
        </div>

        <div class="form-group">
          <label>Phone Number</label>
          <input type="tel" class="form-control" id="phonenumber" placeholder="Phone Number" >
        </div>
      </div>
      <div class="card-body" id="body2">
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" id="email" placeholder="Email" >
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" id="username" placeholder="Username" >
        </div>
        <div class="form-group">
          <label>Enter Supevisors Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password" >
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer">
    <button type="submit"  class="btn btn-success btn-lg btn-block">Submit</button>
  </div>
</form>
</div>
<style media="screen">
  #card{
    display: flex;
    flex-flow: wrap;
    justify-content: space-between;
  }
  #container1,#container2{
    height: auto;
    width: 300px;
  }
  .card-header,.card-footer
  {
    background-color: #1c94c4;
    color: white;
  }
</style>
<script type="text/javascript">
$("#submit").click(
    function()
    {
      preventDefault();
      var fullname=$("#fullname").val();
      var idnumber=$("#idnumber").val();
      var department=$("#department").val();
      var phonenumber=$("#phonenumber").val();
      var username=$("#username").val();
      var password=$("#password").val();
      var email=$("#email").val();


      $.post("register.php",{fullname:fullname,idnumber:idnumber,department:department,phonenumber:phonenumber,email:email,username:username,password:password},function(data,status)
      {
        alert(status);
      });
    }
);
</script>
