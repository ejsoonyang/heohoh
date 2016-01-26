<?php
include_once "../header.php";
$command = intval(test_input($_GET["command"]));

$input_room_type = test_input($_GET["input_room_type"]);
$input_color = test_input($_GET["input_color"]);
echo "$command\n";
echo "$input_room_type\n";
echo "$input_color";
class room_type {
	function room_type($room_type_name, $room_type_color) {
		$this->name = $room_type_name;
		$this->color = $room_type_color;
	}
}

clearstatcache();
$setting_room_type_file = fopen("../json/room.json", "r");
$setting_room_type_json = fread($setting_room_type_file, filesize("../json/room.json"));
fclose($setting_room_type_file);
$setting_room_type_object = json_decode($setting_room_type_json);

$new_room_type = new room_type($input_room_type, $input_color);

if (0 == $command) {
	array_push($setting_room_type_object->room, $new_room_type);
	echo "\n";
	echo "new room type " . $input_room_type . " is adding successfully!!!";
} else {
	$update_room_type = array($new_room_type);
	if ($command > 0) {
		array_splice($setting_room_type_object->room, $command - 1, 1, $update_room_type);
	} else {
		array_splice($setting_room_type_object->room, -$command - 1, 1);
	}
	echo "\n\n\nyour command is '$command'";
}

$setting_room_type_file = fopen("../json/room.json", "w");
fwrite($setting_room_type_file, json_encode($setting_room_type_object));
fclose($setting_room_type_file);
?>
