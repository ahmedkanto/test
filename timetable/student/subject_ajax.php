<option value="" selected="selected" disabled="disabled">Select subject</option>
<?php 
include('../config.php');
$q=mysqli_query($con,"select * from  student);
//echo $_GET['id'];
while($res=mysqli_fetch_assoc($q))
{
echo "<option value='".$res['stu_id']."'></option>";
				
}
?>