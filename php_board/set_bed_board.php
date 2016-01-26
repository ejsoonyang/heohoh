<?php
//echo set room bed form
include_once "../header.php";
$the_house = intval(test_input($_GET["the_house"]));
$the_room = test_input($_GET["the_room"]);
$the_row = intval(substr($the_room ,0 ,strlen($the_room) - 2)) - 1;
$the_col = intval(substr($the_room ,strlen($the_room) - 2)) - 1;

clearstatcache();
$set_house_file = fopen("../json/house.json", "r");
$set_house_json = fread($set_house_file, filesize("../json/house.json"));
fclose($set_house_file);
$set_house_object = json_decode($set_house_json);

$the_house_name = $set_house_object->house[$the_house]->name;
$the_room_name = $set_house_object->house[$the_house]->row[$the_row][$the_col]->name;
$the_bed = $set_house_object->house[$the_house]->row[$the_row][$the_col]->bed;

echo "<div id='set_bed'>";
echo "<div id='set_bed_left'>";
echo "<div class='set_bed_left_nav'>床　位　設　置:</div>";
echo "<br>";
echo "<div class='set_bed_left_nav_house'>樓:$the_house_name</div>";
echo "<div class='set_bed_left_nav_room'>房:$the_room_name</div>";
echo "</div>";
echo "<div id='set_bed_div'>";
echo "<form id='set_bed_form'>";
echo "床數:<input type='input' id='set_bed_input' value='$the_bed'>\n";
echo "<input type='button' value='更改' onclick='set_bed_function()'>\n";
echo "<input type='button' value='取消' onclick='close_pop_win()'>\n";
echo "</form>";
echo "</div>";
?>

