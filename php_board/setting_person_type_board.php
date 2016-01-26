<?php
include_once "../header.php";

//echo person type list
clearstatcache();
$setting_person_type_file = fopen("../json/person.json", "r");
$setting_person_type_json = fread($setting_person_type_file, filesize("../json/person.json"));
fclose($setting_person_type_file);
$setting_person_type_object = json_decode($setting_person_type_json);

//echo the person type setting board
echo "<div id='setting_person_type'>\n";
echo "<div id='setting_person_type_title_div'><span id='setting_person_type_title'>　人　員　類　型　設　置　</span><span id='pop_close' onclick='close_pop_win()'>close</span></div>\n";

echo "<div class='setting_person_type_nav_left'>增加:</div>\n";
echo "<div id='person_type_area'>\n";
echo "<form id='add_person_type_form' class='person_type_form'>\n";
echo "<input type='hidden' class='pic_color_hidden' value='rgb(255,0,0)'>\n";
echo "<label class='person_type_label'>類型名稱</label> <input type='input' id='add_person_type' class='update_person_type'>\n";

echo "<div class='pic_color_button_outer'>\n";
echo "<input type='button' id='pic_color_button0' value='更改顏色' onclick='open_pic_color(this)'>\n";
echo "<br>\n";
echo "<div class='pic_color_outer' id='pic_color_outer0'>\n";
echo "<div class='pic_color'>\n";
echo "<div class='pic_color_R'>";
append_color_panel("R");
echo "</div><br>\n";
echo "<div class='pic_color_G'>";
append_color_panel("G");
echo "</div><br>\n";
echo "<div class='pic_color_B'>";
append_color_panel("B");
echo "</div>\n";
echo "<div class='clear_float'></div>\n";
echo "</div>\n";
echo "</div>\n";
echo "</div>\n";

echo "<input type='button' value='增加' onclick='setting_person_type_function(0)'>\n";
echo "<input type='button' value='重設' onclick='reset_setting_person_type()'>\n";
echo "</form>\n";
echo "</div>\n";
echo "<div class='clear_float'></div>\n";

echo "<div class='setting_person_type_nav_left'>更改:</div>\n";


echo "<div id='person_type_area'>\n";

for ($x = 0; $x < count($setting_person_type_object->person); $x++) {
	$person_type_name = $setting_person_type_object->person[$x]->name;
	$person_color = $setting_person_type_object->person[$x]->color;
	$item_id = $command_update = $x + 1;
	$command_delete = -($x + 1);
	$is_readonly = ($x == 0 ? " readonly" : "");
	$is_disabled = ($x == 0 ? " disabled" : "");

	echo "<form class='person_type_form'>\n";
	echo "<input type='hidden' class='pic_color_hidden' value='$person_color'>\n";
	echo "<label class='person_type_label'>類型名稱</label> <input type='input' class='update_person_type' value='$person_type_name'$is_readonly>\n";
	echo "<div class='pic_color_button_outer'>\n";
	echo "<input type='button' id='pic_color_button$item_id' value='更改顏色' onclick='open_pic_color(this)'>\n";
	echo "<br>\n";
	echo "<div class='pic_color_outer' id='pic_color_outer$item_id'>\n";
	echo "<div class='pic_color'>\n";
	echo "<div class='pic_color_R'>";
	append_color_panel("R");
	echo "</div><br>\n";
	echo "<div class='pic_color_G'>";
	append_color_panel("G");
	echo "</div><br>\n";
	echo "<div class='pic_color_B'>";
	append_color_panel("B");
	echo "</div>\n";
	echo "<div class='clear_float'></div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
	
	echo "<input type='button' value='確定' onclick='setting_person_type_function($command_update)'>\n";
	echo "<input type='button' value='刪除' onclick='setting_person_type_function($command_delete)'$is_disabled>\n";
	echo "</form><br>\n";
}
echo "</div>\n";
echo "<div class='clear_float'></div>\n";
echo "</div>\n";

?>
