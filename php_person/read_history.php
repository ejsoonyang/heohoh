<?php
//use the given filter_value to return $history_array
include_once "../header.php";

//history filter
try {
	include "../connect_db.php";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_execution = "SELECT person_arrive_date, person_arrive_time, person_leave_date, person_leave_time, person_house, person_room, person_type, person_group FROM person_history WHERE person_ID = '$filter_ID'";

    $stmt = $conn->prepare($sql_execution);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$history_array = $stmt->fetchAll();
	usort($history_array, "sort_history");
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>
