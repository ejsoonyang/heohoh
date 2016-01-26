<?php
include_once "../header.php";

$house_id = intval(test_input($_GET["house_id"]));
$room_row = intval(test_input($_GET["room_row"])) - 1;
$room_col = intval(test_input($_GET["room_col"])) - 1;
$room_color = test_input($_GET["room_color"]);

clearstatcache();
$house_file = fopen("../json/house.json", "r");
$house_json = fread($house_file, filesize("../json/house.json"));
fclose($house_file);
$house_object = json_decode($house_json);

$new_room_color = $house_object->house[$_GET["house_id"]]->row[$x][$y]->color;
$house_object->house[$house_id]->row[$room_row][$room_col]->color = $room_color;

$house_file = fopen("../json/house.json", "w");
fwrite($house_file, json_encode($house_object));
fclose($house_file);
?>
