<strong><option value="" selected="selected" disabled="disabled">Select Room</option>
<?php 
include('../config.php');
$q=mysqli_query($con,"select * from  room");
while($res=mysqli_fetch_assoc($q))
{
echo "<option value='".$res['rrom_id']."'>".$res['room_number']."</option>";
				
}
?>
