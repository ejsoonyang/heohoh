<?php
include_once "../header.php";

$the_house = intval(test_input($_GET["the_house"]));
$the_room = test_input($_GET["the_room"]);
$the_row = intval(substr($the_room ,0 ,strlen($the_room) - 2)) - 1;
$the_col = intval(substr($the_room ,strlen($the_room) - 2)) - 1;
$the_bed = test_input($_GET["the_bed"]);

clearstatcache();
$set_house_file = fopen("../json/house.json", "r");
$set_house_json = fread($set_house_file, filesize("../json/house.json"));
fclose($set_house_file);
$set_house_object = json_decode($set_house_json);

$set_house_object->house[$the_house]->row[$the_row][$the_col]->bed = $the_bed;

$set_house_file = fopen("../json/house.json", "w");
fwrite($set_house_file, json_encode($set_house_object));
fclose($set_house_file);

?>
