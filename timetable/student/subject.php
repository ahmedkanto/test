

<?php 
include('../config.php');

echo  "<h2>My Subjects</h2>";
echo "<table border='1' class='table'>";

echo "<tr class='danger'><th colspan='9'><a href='studentdashboard.php?info=addsubjects'>Register New</a></th></tr>";

echo "<Tr><th>Subject Id</th><th>Subject Name</th><th>Term</th>
<th>Lecture/Week</th><th>Type</th><th>Delete</th></tr>";

	$que=mysqli_query($con,"select *  from student_subjects");
	while($res=mysqli_fetch_array($que))
	{
	echo "<Tr>";
	echo "<td>".$res['subject_id']."</td>" ;
	$que1 = mysqli_query($con, "SELECT * FROM subject WHERE subject_id = " . $res['subject_id']);
    $res1 = mysqli_fetch_array($que1);
	
    echo "<td>" . $res1['subject_name'] . "</td>";
	
	
	//display semester name


	echo "<td>".$res1['sem_id']."</td>" ;
	

	echo "<td>".$res1['lecture_per_week']."</td>" ;
		

	echo "<td>".$res1['type']."</td>" ;

	
	echo "<td><a href='studentdashboard.php?info=deletesubject&student_id=$res[student_id]&subject_id=$res[subject_id]'>Delete</a></td>";
	
	echo "</tr>";
	}
	
echo "</table>";	

?>
