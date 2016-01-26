<?php
include_once "./header.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>七天人數統計</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	</head>
	<body>

<?php
clearstatcache();
$person_type_file = fopen("./json/person.json", "r");
$person_type_json = fread($person_type_file, filesize("./json/person.json"));
fclose($person_type_file);
$person_type_object = json_decode($person_type_json);
$person_type_array = $person_type_object->person;

$person_type_name = array();
for ($z = 0; $z < count($person_type_array); $z++) {
	$person_type_name_key = $person_type_array[$z]->name;
	$person_type_name[$person_type_name_key] = 0;
}

clearstatcache();
$house_file = fopen("./json/house.json", "r");
$house_json = fread($house_file, filesize("./json/house.json"));
fclose($house_file);
$house_object = json_decode($house_json);
$house_array = $house_object->house;

$house_name = array();
for ($z = 0; $z < count($house_array); $z++) {
	$house_name_key = $house_array[$z]->name;
	$house_name[$house_name_key] = 0;
}

$time_array = array("06:00:00", "11:00:00", "17:00:00");
$col_sum = 4 + count($person_type_name) + count($house_name);

try {
	include "connect_db.php";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	echo "<table style='border:1px solid black'>";
	for ($x = 0; $x < 7; $x++) {
			echo "<tr>";
			echo "<th colspan=$col_sum>";
			echo " date: ";
			echo date("Y-m-d", time() + $x * 24 * 60 * 60);
			echo "</tr>";
	    foreach ($time_array as $the_time) {
	    	$sql_execution = "SELECT * FROM person_main WHERE (DATEDIFF(person_arrive_date,'" . date('Y-m-d') . "') < $x";
	    	$sql_execution .= " OR (DATEDIFF(person_arrive_date,'" . date('Y-m-d') . "') = $x AND person_arrive_time <= '$the_time'))";
	    	$sql_execution .= " AND (DATEDIFF(person_preleave_date,'" . date('Y-m-d') . "') > $x";
	    	$sql_execution .= " OR (DATEDIFF(person_preleave_date,'" . date('Y-m-d') . "') = $x AND person_preleave_time >= '$the_time'))";

	    	$stmt = $conn->prepare($sql_execution);
	    	$stmt->execute();
	    	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$day_array = $stmt->fetchAll();

			for ($y = 0; $y < count($day_array); $y++) {
	    		foreach ($person_type_name as $key => $value) {
	    			if ($day_array[$y]['person_type'] == $key) {
	    				$person_type_name[$key] += 1;
	    			}
	    		}
	    		foreach ($house_name as $key => $value) {
	    			if ($day_array[$y]['person_house'] == $key) {
	    				$house_name[$key] += 1;
	    			}
	    		}
			}
	
			echo "<td style='border:1px solid black'>";
			echo " time: ";
			echo "$the_time";
			echo "</td>";
			echo "<td style='border:1px solid black'>";
			echo " sum: ";
			echo count($day_array);
			echo "</td>";

			echo "<td>　　</td>";
	    	foreach ($person_type_name as $key => $value) {
				echo "<td style='border:1px solid black'>";
				echo " $key: ";
				echo "$value";
				echo "</td>";
				$person_type_name[$key] = 0;
	    	}
			echo "<td>　　</td>";
	    	foreach ($house_name as $key => $value) {
				echo "<td style='border:1px solid black'>";
				echo " $key: ";
				echo "$value";
				echo "</td>";
				$house_name[$key] = 0;
	    	}

			echo "</tr>";
		}
	}
	echo "</table>";
	echo "<br>";
	echo "<br>";
	echo "<br>";

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>
	</body>
</html>
