<?php
//echo fill room color panel
include_once "../header.php";

clearstatcache();
$room_file = fopen("../json/room.json", "r");
$room_json = fread($room_file, filesize("../json/room.json"));
fclose($room_file);
$room_array = json_decode($room_json)->room;

echo "<div id='room_type_main'>";
echo "<div class='vertical_middle'></div><div id='room_type_main_in' onclick='select_room_type_col(this)'>房 間 填 色</div><input type='hidden' id='room_type_main_hidden' value=''>";
echo "</div><!--";

for ($x = 0; $x < count($room_array); $x++) {
	$name = $room_array[$x]->name;
	$bg_color = $room_array[$x]->color;
	$color = font_color($bg_color);
	echo "--><div class='room_type_col' id='room_type_col$x' style='background-color:$bg_color'>";
	echo "<div class='vertical_middle'></div><div class='room_type_in' onclick='select_room_type_col(this)' style='color:$color'>";
	echo $name;
	echo "</div><input type='hidden' class='room_type_in_hidden' value='$bg_color'>";
	echo "</div><!--";
}
echo "-->";

?>
