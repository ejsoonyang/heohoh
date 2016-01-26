<?php
include_once "../header.php";

//echo room type list
clearstatcache();
$setting_room_type_file = fopen("../json/room.json", "r");
$setting_room_type_json = fread($setting_room_type_file, filesize("../json/room.json"));
fclose($setting_room_type_file);
$setting_room_type_object = json_decode($setting_room_type_json);

//echo the room type setting board
echo "<div id='setting_room_type'>\n";
echo "<div id='setting_room_type_title_div'><span id='setting_room_type_title'>　房　間　類　型　設　置　</span><span id='pop_close' onclick='close_pop_win()'>close</span></div>\n";

echo "<div class='setting_room_type_nav_left'>增加:</div>\n";
echo "<div id='room_type_area'>\n";
echo "<form id='add_room_type_form' class='room_type_form'>\n";
echo "<input type='hidden' class='pic_color_hidden' value='rgb(255,0,0)'>\n";
echo "<label class='room_type_label'>類型名稱</label> <input type='input' id='add_room_type' class='update_room_type'>\n";

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

echo "<input type='button' value='增加' onclick='setting_room_type_function(0)'>\n";
echo "<input type='button' value='重設' onclick='reset_setting_room_type()'>\n";
echo "</form>\n";
echo "</div>\n";
echo "<div class='clear_float'></div>\n";

echo "<div class='setting_room_type_nav_left'>更改:</div>\n";


echo "<div id='room_type_area'>\n";

for ($x = 0; $x < count($setting_room_type_object->room); $x++) {
	$room_type_name = $setting_room_type_object->room[$x]->name;
	$room_color = $setting_room_type_object->room[$x]->color;
	$item_id = $command_update = $x + 1;
	$command_delete = -($x + 1);
	if (0 == $x) {
		$i_ro = " readonly";
		$d_ds = " disabled";
	} else {
		$i_ro = "";
		$d_ds = "";
	}

	echo "<form class='room_type_form'>\n";
	echo "<input type='hidden' class='pic_color_hidden' value='$room_color'>\n";
	echo "<label class='room_type_label'>類型名稱</label> <input type='input' class='update_room_type' value='$room_type_name'$i_ro>\n";
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

	echo "<input type='button' value='確定' onclick='setting_room_type_function($command_update)'>\n";
	echo "<input type='button' value='刪除' onclick='setting_room_type_function($command_delete)'$d_ds>\n";
	echo "</form><br>\n";
}
echo "</div>\n";
echo "<div class='clear_float'></div>\n";
echo "</div>\n";

?>
