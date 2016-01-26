<?php
include_once "../header.php";
$command = intval(test_input($_GET["command"]));

$input_person_type = test_input($_GET["input_person_type"]);
$input_color = test_input($_GET["input_color"]);
//echo "$command\n";
//echo "$input_person_type\n";
//echo "$input_color";
class person_type {
	function person_type($person_type_name, $person_type_color) {
		$this->name = $person_type_name;
		$this->color = $person_type_color;
	}
}

clearstatcache();
$setting_person_type_file = fopen("../json/person.json", "r");
$setting_person_type_json = fread($setting_person_type_file, filesize("../json/person.json"));
fclose($setting_person_type_file);
$setting_person_type_object = json_decode($setting_person_type_json);

$new_person_type = new person_type($input_person_type, $input_color);

if (0 == $command) {
	array_push($setting_person_type_object->person, $new_person_type);
	//echo "\n";
	//echo "new person type " . $input_person_type . " is adding successfully!!!";
} else {
	$update_person_type = array($new_person_type);
	//echo "\n\n\nyour command is '$command'";

	try {
		include "../connect_db.php";
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$original_person_type =$setting_person_type_object->person[$command - 1]->name;
		//echo $original_person_type;
		if ($command > 0) {
	    	$sql_execution = "UPDATE person_main SET person_type='$input_person_type' WHERE person_type = '$original_person_type'";
		} else {
	    	$sql_execution = "UPDATE person_main SET person_type='' WHERE person_type = '$original_person_type'";
		}
	    $conn->exec($sql_execution);
	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

	if ($command > 0) {
		array_splice($setting_person_type_object->person, $command - 1, 1, $update_person_type);
	} else {
		array_splice($setting_person_type_object->person, -$command - 1, 1);
	}
}

$setting_person_type_file = fopen("../json/person.json", "w");
fwrite($setting_person_type_file, json_encode($setting_person_type_object));
fclose($setting_person_type_file);

//echo the selection at filter
echo "<option value='' style='font-size:20px'></option>";
person_type_select_option(false, "");
?>
