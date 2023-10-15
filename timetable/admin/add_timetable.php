<?php

$host = "localhost";
$dbname = "ahmeuyde_timetable";
$username = "ahmeuyde_root";
$password = "Ahmed@31122002";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$timetable = array_fill(0, 5, array_fill(0, 5, []));

function isSlotAvailable($timetable, $day, $block, $type, $rooms) {
    foreach ($timetable[$day][$block] as $room_slot) {
        if ($room_slot && $rooms[$room_slot["Room"]]['type'] == $type) {
            return true;
        }
    }
    return false;
}

function assignSubjectToSlot(&$timetable, $day, $block, $subject, $roomId) {
    $timetable[$day][$block][] = ["Sub" => $subject, "Room" => $roomId];
}

function getRandomSlot($timetable, $type, $rooms, $maxSubjectsPerSlot = 3) {
    $days = range(0, 4);
    $blocks = range(0, 4);
    shuffle($days);
    shuffle($blocks);

    foreach ($days as $day) {
        foreach ($blocks as $block) {
            if (count($timetable[$day][$block]) < $maxSubjectsPerSlot) { // This slot has not reached its max capacity
                $suitableRooms = array_filter($rooms, function($room) use ($type) {
                    return $room['type'] == $type;
                });
                if (!empty($suitableRooms)) {
                    return [$day, $block];
                }
            }
        }
    }
    return null;
}

$stmt = $conn->prepare("SELECT room_id, room_number, type FROM room");
$stmt->execute();
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);


$roomMap = [];
foreach ($rooms as $room) {
    $roomMap[$room["room_number"]] = $room;
}
$stmt = $conn->prepare("SELECT sem_id, semester_name FROM semester");
$stmt->execute();

$semesters = $stmt->fetchAll();
if (isset($_POST['save_timetable'])) {
	$filename = "timetable_" . $_POST["semester"] . ".json"; // Naming the file based on the semester
    file_put_contents($filename, json_encode($timetable, JSON_PRETTY_PRINT));
	
    $filename = "timetable_" . $_POST["semester"] . ".xml"; // Naming the file based on the semester
    
    $dom = new DOMDocument('1.0', 'UTF-8');
    $root = $dom->createElement('timetable');
    $dom->appendChild($root);
    
    foreach ($timetable as $day => $blocks) {
        $dayElement = $dom->createElement('day', $day);
        $root->appendChild($dayElement);
        foreach ($blocks as $block => $subjects) {
            $blockElement = $dom->createElement('block', $block);
            $dayElement->appendChild($blockElement);
            foreach ($subjects as $subject) {
                $subjectElement = $dom->createElement('subject');
                $subjectElement->setAttribute('Room', $subject["Room"]);
                $subjectElement->appendChild($dom->createTextNode($subject["Sub"]));
                $blockElement->appendChild($subjectElement);
            }
        }
    }
    
    $dom->formatOutput = true; // Makes the output prettier
    $dom->save($filename);
} elseif (isset($_POST['load_timetable'])) {
    $filenameLoad = "timetable_" . $_POST["semester"] . ".json";

	if (!file_exists($filenameLoad)) {
		echo "file '$filenameLoad' not found";
	}
	else{
		// Load JSON data
		$json_data = file_get_contents($filenameLoad);
		$timetable = json_decode($json_data, true);
	}

} elseif (isset($_POST['delete_timetable'])) {
	$filenamedel = "timetable_1.json";

	if (file_exists($filenamedel)) {
		if (unlink($filenamedel)) {
			echo "File '$filenamedel' has been deleted successfully.";
		} else {
			echo "Error deleting file '$filenamedel'.";
		}
	} else {
		echo "File '$filenamedel' does not exist.";
	}
	$filenamedel = "timetable_2.json";

	if (file_exists($filenamedel)) {
		if (unlink($filenamedel)) {
			echo "File '$filenamedel' has been deleted successfully.";
		} else {
			echo "Error deleting file '$filenamedel'.";
		}
	} else {
		echo "File '$filenamedel' does not exist.";
	}
} else {
    $sem_id = $_POST["semester"];
	$stmt = $conn->prepare("SELECT subject_id, subject_name, lecture_per_week, type FROM subject WHERE sem_id = :sem_id");
	$stmt->bindParam(':sem_id', $sem_id, PDO::PARAM_INT);
    $stmt->execute();

    $subjects = $stmt->fetchAll();

	foreach ($subjects as $subject) {
		$lectures = $subject["lecture_per_week"];
		for ($i = 0; $i < $lectures; $i++) {
			list($day, $block) = getRandomSlot($timetable, $subject["type"], $roomMap);
			if ($day !== null && $block !== null) { // Check if we got a valid slot
				$suitableRooms = array_filter($rooms, function($room) use ($subject) {
					return $room['type'] == $subject['type'];
				});
				$randomRoom = $suitableRooms[array_rand($suitableRooms)];
				assignSubjectToSlot($timetable, $day, $block, $subject["subject_name"], $randomRoom["room_number"]);
			} else {
				// Handle case where no slot is available. Maybe log an error or break out of the loop.
			}
		}
	}
	$filename = "timetable_" . $_POST["semester"] . ".json"; // Naming the file based on the semester
    file_put_contents($filename, json_encode($timetable, JSON_PRETTY_PRINT));


}


?>




<!DOCTYPE html>
<html lang="en">

<head>

    <title>Timetable Generator</title>

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
        table, th, td {

            border: 1px solid black;

            padding: 10px;

        }

    </style>

</head>

<body>

 

<form action="" method="post">

    <label for="semester">Choose a Term:</label>

    <select name="semester">

        <?php foreach ($semesters as $semester): ?>

            <option value="<?php echo $semester["sem_id"]; ?>"><?php echo $semester["semester_name"]; ?></option>

        <?php endforeach; ?>

    </select>

    <br>

    <input type="submit" value="Generate New Timetable and save">
	
	<input type="submit" name="load_timetable" value="Load existing Timetable">
	
	<input type="submit" name="delete_timetable" value="Delete all saved Timetable">

</form>

 

<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>

<h3>Generated Timetable:</h3>

    <button id="printButton" onclick="printTable()">Print Timetable</button>
	
    <div id="timetable">
		<table>

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

				<?php

				$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

				foreach ($days as $index => $day): ?>

					<tr>

						<td><?php echo $day; ?></td>

						<?php for ($block = 0; $block < 5; $block++): ?>

							<td>

								<?php

								// Handle arrays and filter out null values

								$subjectsInSlot = array_map(function($entry) {

									return $entry["Sub"] . " (Room: " . $entry["Room"] . ")";

								}, array_filter($timetable[$index][$block]));

		 

								echo $subjectsInSlot ? implode('<br>', $subjectsInSlot) : '-';

								?>

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

<?php endif; ?>

 

 

 

</body>

</html>