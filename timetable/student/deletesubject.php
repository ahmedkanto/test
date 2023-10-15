<?php 
include('../config.php');

if (isset($_REQUEST['student_id']) && isset($_REQUEST['subject_id'])) {
    $student_id = $_REQUEST['student_id'];
    $subject_id = $_REQUEST['subject_id'];

    mysqli_query($con, "DELETE FROM student_subjects WHERE student_id='$student_id' AND subject_id='$subject_id'");
    
    header('location: studentdashboard.php?info=subjects');
} else {
    echo "Invalid request parameters.";
}
?>