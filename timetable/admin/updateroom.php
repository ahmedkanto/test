<?php 
include('../config.php');
$room_id=$_REQUEST['room_id'];

$q=mysqli_query($con,"select * from room where room_id='$room_id'");
$res=mysqli_fetch_assoc($q);
extract($_POST);
if(isset($update))
{	
 

	mysqli_query($con,"update room set room_number='$s' , type='$type' where room_id='$room_id' ");
	
	$err= "Records updated";
	
	}
	
?>
<div class="row">
<div class="col-md-5">
              
               <h2>Update Room</h2>
<form method="POST" enctype="multipart/form-data">
  <table border="0" cellspacing="5" cellpadding="5" class="table">
  <tr>
  <td colspan="2"><?php echo @$err; ?></td>
  </tr>
  
  
   <tr>
    <th width="237" scope="row">Room Name </th>
    <td width="213"><input type="text" name="s" class="form-control" value="<?php echo $res['room_number'];?>"/></td>
  </tr>
    <tr>
    <th width="237" scope="row">Type </th>
    <td width="213">
		<input class="form-check-input" type="radio" name="type" value="Theory" <?php echo ($res['type'] === "Theory") ? "checked" : "" ?> >
  		<label class="form-check-label" for="Theory">Theory</label>
		<input class="form-check-input" type="radio" name="type" value="Lab" <?php echo ($res['type'] === "Lab") ? "checked" : "" ?>>
  		<label class="form-check-label" for="Lab">Lab</label>	  
	</td>
  </tr>
   
   <tr>
    <th colspan="2" scope="row" align="center">
<input type="submit" value="Update Records" name="update"/>
	</th>
  </tr>
</table>
</form>
</div>
</div>
               
                
                   