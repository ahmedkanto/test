<?php
include('../config.php');


// Check if the term parameter has been sent via POST
if (isset($_POST['term'])) {
    $selectedTerm = $_POST['term'];

    // Use a prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($con, "SELECT * FROM subject WHERE sem_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $selectedTerm);
    mysqli_stmt_execute($stmt);

    // Get the result of the query
    $result = mysqli_stmt_get_result($stmt);

    // Build the HTML options for the subject dropdown
    $options = '<option disabled selected>Select Subject</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row['subject_id'] . '">' . $row['subject_name'] . '</option>';
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Return the HTML options
    echo $options;
} else {
    // Handle the case where 'term' parameter is not set
    echo '<option disabled selected>Error: Invalid Request</option>';
}

// Close the database connection
mysqli_close($con);
?>
