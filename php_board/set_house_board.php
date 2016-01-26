<?php
include_once "../header.php";

//echo house list
clearstatcache();
$setting_house_file = fopen("../json/house.json", "r");
$setting_house_json = fread($setting_house_file, filesize("../json/house.json"));
fclose($setting_house_file);
$setting_house_object = json_decode($setting_house_json);

//echo "<div id='setting'>";
echo "<div id='setting_house'>";
echo "<div id='setting_house_nav'>樓　房　設　置<span id='pop_close' onclick='close_pop_win()'>close</span></div>";
echo "<div class='setting_house_nav_left'>增加:</div>";
echo "<div id='add_house_div'>";
echo "<form id='add_house_form' class='setting_house_form'>";
echo "樓:<input type='input' class='update_house' id='add_house'>\n";
echo "層:<input type='input' class='update_row' id='add_row' class='setting_short'>\n";
echo "房:<input type='input' class='update_col' id='add_col' class='setting_short'>\n";
echo "床:<input type='input' class='update_bed' id='add_bed' class='setting_short'>\n";
echo "<input type='button' value='增加' onclick='setting_house_function(0)'>\n";
echo "<input type='button' value='重設' onclick='reset_setting_house()'>\n";
echo "</form>";
echo "</div>";

echo "<div class='clear_float'></div>";
echo "<div class='setting_house_nav_left'>更改:</div>";
echo "<div id='update_house_div'>";

for ($x = 0; $x < count($setting_house_object->house); $x++) {
	$house_name_current = $setting_house_object->house[$x]->name;
	$row_count = count($setting_house_object->house[$x]->row);
	$col_count = count($setting_house_object->house[$x]->row[0]);
	$original_bed = $setting_house_object->house[$x]->bed;
	$command_update = $x + 1;
	$command_delete = -($x + 1);
	echo '<form class="setting_house_form">';
	echo "樓:<input type='input' class='update_house' value='$house_name_current'>\n";
	echo "層:<input type='input' class='update_row' value='$row_count'>\n";
	echo "房:<input type='input' class='update_col' value='$col_count'>\n";
	echo "床:<input type='input' class='update_bed' value='$original_bed'>\n";
	echo "<input type='button' id='update_submit' value='更改' onclick='setting_house_function($command_update)'>\n";
	echo "<input type='button' id='update_delete' value='刪除' onclick='setting_house_function($command_delete)'>\n";
	echo '</form>';
}

echo "</div>";
echo "<div class='clear_float'></div>";
echo "</div>";
?>
