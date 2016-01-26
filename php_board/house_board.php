<?php
//echo person table
include_once "../header.php";
clearstatcache();
$house_file = fopen("../json/house.json", "r");
$house_json = fread($house_file, filesize("../json/house.json"));
fclose($house_file);
$house_array = json_decode($house_json)->house;
for ($x = 0; $x < count($house_array); $x++) {
	echo "<div id='house_list$x' class='house_list_up' onclick='house_selected(this.id)'>";
	echo "<span class='vertical_middle'></span>";
	echo '<span class="house_list_in">';
	echo $house_array[$x]->name;
	echo "</span></div>\n";
}

?>
