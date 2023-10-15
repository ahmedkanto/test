

<?php 
include('../config.php');



//<!--data display-->


echo "<table border='1' class='table'>";

echo "<tr class='danger'><th colspan='5'><a href='admindashboard.php?info=add_room'>Add New</a></th></tr>";

echo "<Tr><th>Room Id</th><th>Room Number</th><th>Type</th><th>Update</th><th>Delete</th></tr>";

	$que=mysqli_query($con,"select *  from room");
	while($res=mysqli_fetch_array($que))
	{
	echo "<Tr>";
	echo "<td>".$res['room_id']."</td>" ;
	echo "<td>".$res['room_number']."</td>" ;
	echo "<td>".$res['type']."</td>" ;
	//display department name
	//$que1=mysqli_query($con,"select *  from department where department_id='".$res['department_id']."'");
	//$res1=mysqli_fetch_array($que1);
	
	//echo "<td>".$res1['department_name']."</td>" ;
	echo "<td><a href='admindashboard.php?info=updateroom&room_id=$res[room_id]'>Update</a></td>";
	echo "<td><a href='admindashboard.php?info=deleteroom&room_id=$res[room_id]'>Delete</a></td>";
	echo "</tr>";
	}
	
echo "</table>";	

?>
