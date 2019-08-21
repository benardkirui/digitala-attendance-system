
<?php 
$conn = mysqli_connect("localhost","root","kiptoo","attendance_sys",3306);

if(!$conn){
	die("Connection error: " . mysqli_connect_error());	
}
?>