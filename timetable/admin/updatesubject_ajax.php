<option value="" selected="selected" disabled="disabled">Select Subject</option>
<?php 
include('../config.php');
$q=mysqli_query($con,"select * from  semester");
while($res=mysqli_fetch_assoc($q))
{
echo "<option value='".$res['sem_id']."'>".$res['semester_name']."</option>";
				
}
?>