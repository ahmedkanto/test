<?php 
include('../config.php');
extract($_POST);
if(isset($save))
{
$que=mysqli_query($con,"select * from room where room_id=''");	
$row=mysqli_num_rows($que);
	if($row)
	{
	$err="<font color='red'>This Room already exists</font>";
	}
	else
	{
mysqli_query($con,"insert into room values(null,'$s')");	

	$err="<font color='blue'>Congrates Your Data Saved!!!</font>";
	}
	
}

?>

<div class="row">
<div class="col-md-5">
<h2>Add Room</h2>
<form method="POST" enctype="multipart/form-data">
  <table border="0" cellspacing="5" cellpadding="5" class="table">
  <tr>
  <td colspan="2"><?php echo @$err; ?></td>

 
   <tr>
    <th width="237" scope="row">Room Name </th>
    <td width="213"><input type="text" name="s" class="form-control"/></td>
  </tr>
  
 <tr>
    <td colspan="2" align="center">
	<input type="submit" value="Add Room" name="save" class="btn btn-success" />
	
	<input type="reset" value="Reset" class="btn btn-success"/>
	
	</td>
  </tr>
  
  </table>
  </form>
</div>
</div>