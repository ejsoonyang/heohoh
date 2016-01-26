<?php
include_once "../header.php";

$command = intval(test_input($_GET["command"]));

$input_house = test_input($_GET["input_house"]);
$input_row = test_input($_GET["input_row"]);
$input_col = test_input($_GET["input_col"]);
$input_bed = test_input($_GET["input_bed"]);

class house {
	function house($house_name, $bed) {
		$this->name = (string)$house_name;
		$this->row = array();
		$this->bed = intval($bed);
	}
}
class room {
	function room($room_name, $color, $bed) {
		$this->name = (string)$room_name;
		$this->color = (string)$color;
		$this->bed = intval($bed);
	}
}
function build_house($pu_house, $pu_row, $pu_col, $pu_bed, $df_color) {
	$yigo = new house($pu_house, $pu_bed);
	for ($x = 1; $x <= $pu_row; $x++) {
		$qica = array();
		for ($y = 1; $y <= $pu_col; $y++) {
			$wugo = new room($x * 100 + $y, "$df_color", $pu_bed);
			array_push($qica, $wugo);
		}
		array_push($yigo->row, $qica);
	}
	return $yigo;
}

clearstatcache();
$set_house_file = fopen("../json/house.json", "r");
$set_house_json = fread($set_house_file, filesize("../json/house.json"));
fclose($set_house_file);
$set_house_object = json_decode($set_house_json);

clearstatcache();
$set_room_file = fopen("../json/room.json", "r");
$set_room_json = fread($set_room_file, filesize("../json/room.json"));
fclose($set_room_file);
$set_room_object = json_decode($set_room_json);

$df_color = $set_room_object->room[0]->color;
if (0 == $command) {
	$new_house = build_house($input_house, $input_row, $input_col, $input_bed, $df_color);

	array_push($set_house_object->house, $new_house);

} else {
	$new_house = array(build_house($input_house, $input_row, $input_col, $input_bed ,$df_color));

	try {
		include "../connect_db.php";
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$original_house =$set_house_object->house[$command - 1]->name;
		echo $original_house;
		if ($command > 0) {
	    	$sql_execution = "UPDATE person_main SET person_house='$input_house' WHERE person_house = '$original_house'";
		} else {
	    	$sql_execution = "UPDATE person_main SET person_house='' WHERE person_house = '$original_house'";
		}
	    $conn->exec($sql_execution);
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

	if ($command > 0) {
		array_splice($set_house_object->house, $command - 1, 1, $new_house);
	} else {
		array_splice($set_house_object->house, -$command - 1, 1);
	}
}
$set_house_file = fopen("../json/house.json", "w");
fwrite($set_house_file, json_encode($set_house_object));
fclose($set_house_file);

?>
