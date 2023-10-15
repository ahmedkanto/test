<?php
include('../config.php');

extract($_POST);
if(isset($save))
{
	//$que=mysqli_query($con,"select * from student, subject where stu_id='".$_SESSION['stu_id']."'");
	//$row=mysqli_num_rows($que);
	//if($row)
	//{
	//$err="<font color='red'>This Subject already exists</font>";
	//}
	//else
	{

		mysqli_query($con, "INSERT INTO student_subjects VALUES (null,'" . $_SESSION['stu_id'] . "','$s')");

		$err="<font color='blue'>Congrats Your Data Saved!!!</font>";
	}
	
}
?>
 


<div class="row">
<div class="col-md-8">
<h2>Register Subject</h2>
<form method="POST" enctype="multipart/form-data">
  <table border="0" cellspacing="5" cellpadding="5" class="table">
  <tr>
  <td colspan="2"><?php echo @$err; ?></td>
  </tr>

<tr>
    <th width="237" scope="row">Select Term</th>
    <td width="213">
        <select name="t" id="term" class="form-control">
            <option disabled selected>Select Term</option>
            <?php
            $sub2 = mysqli_query($con, "select * from semester");
            while ($sem = mysqli_fetch_array($sub2)) {
                $sem_id = $sem[0];
                echo "<option value='$sem_id'>" . $sem[1] . "</option>";
            }
            ?>
        </select>
    </td>
</tr>

<tr>
    <th width="237" scope="row">Select Subject</th>
    <td width="213">
        <select name="s" id="subject" class="form-control">
            <option disabled selected>Select Subject</option>
        </select>
    </td>
</tr>

<script>
    // Get references to the select elements
    const termSelect = document.getElementById('term');
    const subjectSelect = document.getElementById('subject');

    // Add an event listener to the term select element
    termSelect.addEventListener('change', function () {
        // Get the selected term value
        const selectedTerm = termSelect.value;

        // Use AJAX to fetch subjects based on the selected term
        // You need to implement this part using JavaScript and PHP
        // Here's a simplified example using jQuery AJAX:

        // Make an AJAX request to get subjects based on the selected term
        $.ajax({
            url: 'get_subjects.php', // Replace with the actual URL for fetching subjects
            method: 'POST',
            data: { term: selectedTerm },
            success: function (response) {
                // Clear the current options in the subject select element
                subjectSelect.innerHTML = '<option disabled selected>Select Subject</option>';

                // Add new options based on the response
                subjectSelect.innerHTML += response;
            }
        });
    });
</script>




  <tr>
    <th colspan="1" scope="row"></th>
	<td>
	<input type="submit" value="Add subject" name="save" class="btn btn-success" />
	
	<input type="reset" value="Reset" class="btn btn-success"/>
	</td>
  </tr>
  
  </table>
  </form>
  </div>
  </div>