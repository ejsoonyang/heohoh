<?php
date_default_timezone_set("Asia/Taipei");

function person_type_select_option($is_filter, $person_type) {
	clearstatcache();
	if ($is_filter) {
		$person_type_file = fopen("./json/person.json", "r");
		$person_type_json = fread($person_type_file, filesize("./json/person.json"));
	} else {
		$person_type_file = fopen("../json/person.json", "r");
		$person_type_json = fread($person_type_file, filesize("../json/person.json"));
	}
	fclose($person_type_file);
	$person_type_array = json_decode($person_type_json)->person;

	//$is_all = ($is_filter ? "全部" : "");
	if ($is_filter) {
		echo "<option value='' style='font-size:20px'>$is_all</option>";
	}
	for ($x = 0; $x < count($person_type_array); $x++) {
		$person_type_bg_color = $person_type_array[$x]->color;
		$person_type_color = font_color($person_type_bg_color);
		echo "<option style='background-color:$person_type_bg_color;color:$person_type_color;font-size:20px;'";
		if ($person_type_array[$x]->name == $person_type) {
			echo " selected";
		}
		echo ">";
		echo $person_type_array[$x]->name;
		echo "</option>";
	}
}

function house_select_option($house) {
	clearstatcache();
	$house_file = fopen("../json/house.json", "r");
	$house_json = fread($house_file, filesize("../json/house.json"));
	fclose($house_file);
	$house_array = json_decode($house_json)->house;
	echo "<option></option>";
	for ($x = 0; $x < count($house_array); $x++) {
		echo "<option";
			if ($house_array[$x]->name == $house) {
				echo " selected";
			}
		echo ">";
		echo $house_array[$x]->name;
		echo "</option>";
	}
}

function time_select_option($the_time) {
	echo "<option></option>";
	$x = 6;
	while ($x <= 20) {
			echo '<option value="' . (string)$x . ':00:00"';
		if ($x . ':00:00"' == intval($the_time)) {//date("H"))) {
			echo " selected";
		}
			echo ">";
			echo $x;
			echo ":00";
			echo "</option>";
			$x += 1;
	}
	return;
}

function permission_select_option($permission) {
	$confirm_selection = array("管理員","超級管理員");
	foreach ($confirm_selection as $option) {
		echo "<option";
		if ($option == $permission) {
			echo " selected";
		}
		echo ">$option</option>";
	}
}

function confirm_select_option($confirm) {
	echo "<option></option>";
	$confirm_selection = array("十分確定","不大確定","可能提前","可能延後");
	foreach ($confirm_selection as $option) {
		echo "<option";
		if ($option == $confirm) {
			echo " selected";
		}
		echo ">$option</option>";
	}
}

function degree_select_option($degree) {
	echo "<option></option>";
	$degree_selection = array("博士", "碩士", "本科", "專科", "高中", "初中", "小學");
	foreach ($degree_selection as $option) {
		echo "<option";
			if ($option == $degree) {
				echo " selected";
			}
		echo ">";
		echo $option;
		echo "</option>";
	}
}

function append_color_panel($color_row) {
	for ($x = 1; $x < 16; $x++) {
		$color_value = ($x * 17);
	//for ($x = 0; $x < 16; $x++) {
		//$color_value = (($x + 1) * 16 - 1);
		switch ($color_row) {
			case "R":
				$color_string = "rgb(" . (string)$color_value . ",0,0)";
				break;
			case "G":
				$color_string = "rgb(0," . (string)$color_value . ",0)";
				break;
			case "B":
				$color_string = "rgb(0,0," . (string)$color_value . ")";
				break;
		}
		$col_class = "pic_color_" . "$color_row" . "_col";
		echo "<div class='$col_class' ";
		echo "id='$col_class" . "$x' ";
		echo "onclick='color_panel(this)' ";
		echo "style='background-color:$color_string;' ";
		echo "></div>";
	}
}

function font_color($bg_color) {
	$bg_color_class = explode(",", $bg_color);
	$R_num = intval(str_replace("rgb(", "", $bg_color_class[0]));
	$G_num = intval($bg_color_class[1]);
	$B_num = intval(str_replace(")", "", $bg_color_class[2]));
	$sum_num = $R_num + $G_num + $B_num;
	return ($sum_num > 382 ? "black" : "white");
}

function sort_all_person($x, $y) {
	if (strcmp($y['person_house'], $x['person_house']) == 0) {
		return intval($x['person_room']) - intval($y['person_room']);
	}
	return strcmp($y['person_house'], $x['person_house']);
}

function sort_filter_read($x, $y) {
	return intval($y['person_ID']) - intval($x['person_ID']);
}

function sort_history($x, $y) {
	if (strcmp($y['person_leave_date'], $x['person_leave_date']) == 0) {
		return strcmp($y['person_leave_time'], $x['person_leave_time']);
	}
	return strcmp($y['person_leave_date'], $x['person_leave_date']);
}

function sort_person_room($x, $y) {
	if (intval(intval($y['person_room']) / 100) == intval(intval($x['person_room']) / 100)) {
		return intval($x['person_room']) - intval($y['person_room']);
	}
	return intval($y['person_room']) - intval($x['person_room']);
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

//check if user is ligal
session_start();
if ("" == $_SESSION["login_name"]) {
	echo "<!DOCTYPE html>";
	echo "<html lang='en'>";
	echo "	<head>";
	echo "		<title>香海禪寺住房信息管理系統</title>";
	echo "		<meta http-equiv='Content-Type' content='text/html;charset=utf-8'/>";
	echo "		<meta http-equiv='refresh' content='3; url=login.php'/>";
	echo "	</head>";
	echo "	<body>";
	echo "！請登錄";
	echo "<br>";
	echo "<br>";
	echo "<a href='login.php'>點擊此處跳轉</a>";
	echo "	</body>";
	echo "</html>";
	die();
}

?>
