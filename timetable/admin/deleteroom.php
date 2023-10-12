<?php 
include('../config.php');
$room_id=$_REQUEST['room_id'];
if(isset($_REQUEST['room_id']))
{

mysqli_query($con,"delete from room where room_id='$room_id'");


header('location:admindashboard.php?info=room');
}
?>
