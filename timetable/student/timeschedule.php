<?php
try {
    $db_host = 'localhost'; // Database Host
    $db_name = 'ahmeuyde_timetable'; // Database Name
    $db_user = 'ahmeuyde_root'; // Database User
    $db_password = 'Ahmed@31122002'; // Database User's Password

    // Set up the database connection
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

// Assuming you have the teacher's ID stored in the session.
$student_id = isset($_SESSION['stu_id']) ? $_SESSION['stu_id'] : null;

// Define the days
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

function getSubjectsByStudentId($student_id) {
    global $pdo; // Make the $pdo object available inside the function

    try {
        // Prepare the SQL query
        $query = "SELECT subject.subject_name
                  FROM student_subjects
                  INNER JOIN subject ON student_subjects.subject_id = subject.subject_id
                  WHERE student_subjects.student_id = :student_id";
        $stmt = $pdo->prepare($query);

        // Bind the teacher_id parameter
        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch all the subjects
        $subjects = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        return $subjects; // This returns an array of subjects
    } catch(PDOException $e) {
        die("ERROR: Could not execute query: $query. " . $e->getMessage());
    }
}


// Assuming you have a way to get the subjects associated with the teacher.
$teacher_subjects = getSubjectsByStudentId($student_id); // You should replace this with your method.

$selected_semester = $_POST['semester'] ?? '1'; // Default to semester 1 if not specified.

$timetable_file = "../admin/timetable_" . $selected_semester . ".json";

if (!file_exists($timetable_file)) {
    die("Timetable file does not exist.");
}

// Load the selected timetable file
$timetable_json = file_get_contents($timetable_file);
$timetable = json_decode($timetable_json, true);

$filtered_timetable = [];

foreach ($timetable as $dayIndex => $blocks) {
    foreach ($blocks as $blockIndex => $subjects) {
        foreach ($subjects as $subject) {
            if (in_array($subject['Sub'], $teacher_subjects)) {
                $filtered_timetable[$days[$dayIndex]][$blockIndex] = $subject;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lecturer's Timetable</title>
    <style>
        /* Add any additional styling here */
        @media print {
            /* Style adjustments for Print. Hide everything except the table. */
            body * {
                visibility: hidden;
            }
            #timetable, #timetable * {
                visibility: visible;
            }
            #timetable {
                position: absolute;
                left: 0;
                top: 0;
            }
            #printButton {
                display: none; /* Hide the print button */
            }
        }
    </style>
</head>
<body>
    <h2>My Timetable for Term <?php echo htmlspecialchars($selected_semester); ?></h2>

	<!-- Semester selection form -->
	<form method="post">
		<label for="semester">Select Term:</label>
		<select name="semester" id="semester" onchange="this.form.submit()">
			<option value="1" <?php if ($selected_semester === '1') echo 'selected'; ?>>1st Term</option>
			<option value="2" <?php if ($selected_semester === '2') echo 'selected'; ?>>2nd Term</option>
		</select>
	</form>

    <!-- Print Button -->
    <button id="printButton" onclick="printTable()">Print Timetable</button>

    <!-- Your table -->
    <div id="timetable">
        <table border="1">
			<thead>
				<tr>
					<th>Day/Time</th>
					<th>8:00-10:00</th>
					<th>10:00-12:00</th>
					<th>12:00-14:00</th>
					<th>14:00-16:00</th>
					<th>16:00-18:00</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($days as $day): ?>
					<tr>
						<td><?php echo htmlspecialchars($day); ?></td>
						<!-- Display the subjects for each time block -->
						<?php for ($block = 0; $block < 5; $block++): ?>
							<td>
								<?php if (isset($filtered_timetable[$day][$block])): ?>
									<?php echo htmlspecialchars($filtered_timetable[$day][$block]['Sub']); ?>
									<br>
									<?php echo htmlspecialchars($filtered_timetable[$day][$block]['Room']); ?>
								<?php else: ?>
									<!-- Empty cell if no subject -->
									&nbsp;
								<?php endif; ?>
							</td>
						<?php endfor; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
    </div>

    <script>
        function printTable() {
            // JavaScript function to invoke the print functionality
            window.print();
        }
    </script>
</body>
</html>