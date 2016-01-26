<?php
include_once "../header.php";
if ("" != $_GET["house_id"]) {
	clearstatcache();
	$house_file = fopen("../json/house.json", "r");
	$house_json = fread($house_file, filesize("../json/house.json"));
	fclose($house_file);
	$house_array = json_decode($house_json)->house;

	clearstatcache();
	$person_file = fopen("../json/person.json", "r");
	$person_json = fread($person_file, filesize("../json/person.json"));
	fclose($person_file);
	$person_json_array = json_decode($person_json)->person;
	
	//read the person settled in the house through read_person.php
	$filter_house = $house_array[$_GET["house_id"]]->name;
	require "../php_person/read_person.php";
	usort($person_array, "sort_person_room");
	$out_room = array();//a person settle a wrong room
	
	$room_index = 0;
	echo "<div id='room_area'>";
	for ($x = count($house_array[$_GET["house_id"]]->row) - 1; $x >= 0; $x--) {
		for ($y = 0; $y < count($house_array[$_GET["house_id"]]->row[$x]); $y++) {
			$new_room_name = $house_array[$_GET["house_id"]]->row[$x][$y]->name;
			$new_room_color = $house_array[$_GET["house_id"]]->row[$x][$y]->color;
			$new_room_bed = $house_array[$_GET["house_id"]]->row[$x][$y]->bed;
			echo "<div class='room' id='room_$new_room_name' onclick='room_onclick(this)' style='background-color:$new_room_color;'>";
			echo "<div class='room_name'>$new_room_name</div>";

			//define bed_array and bed_color
			$bed_array = array();
			$bed_color = array();
			while ( $room_index < count($person_array) and $person_array[$room_index]["person_room"] == $new_room_name) {
				array_push($bed_array, $person_array[$room_index]["person_type"]);
				$room_index++;
			}
			sort($bed_array);
			foreach ($bed_array as $type_x) {
				foreach ($person_json_array as $type_y) {
					if ($type_x == $type_y->name) {
						array_push($bed_color, $type_y->color);
					}
				}
			}

			//echo bed
			echo "<div class='float_right_div'>";
			if ($new_room_bed > 6 || count($bed_color) > 6) {
				$sum_count = 0;
				for ($z = 0; $z < 6; $z++) {
					if ($z == 3) {
						echo "<div class='clear_right_float'></div>";
					}
					if ($sum_count < count($bed_color)){
						$type_z = $bed_color[$sum_count];
						$type_font = font_color($type_z);
						$new_count = 1;
						while ($bed_color[$sum_count] == $bed_color[$sum_count + 1]) {
							$new_count += 1;
							$sum_count += 1;
						}
						echo "<div class='bed' style='background-color:$type_z;color:$type_font;'>";
						echo "$new_count";
						echo "</div>";
						$sum_count += 1;
					} else {
					//last empty bed
						$last_count = $new_room_bed - $sum_count;
						if ($last_count < 0) {
							$b_f_color = " style='color:white;background-color:black'";
							$last_count *= -1;
						} else {
							$b_f_color = "";
						}
						echo "<div class='bed'$b_f_color>";
						echo $last_count;
						echo "</div>";
						break;
					}
				}
			} else {
				$z = 0;
				while ($z < 6) {
					if ($z == 3) {
						echo "<div class='clear_right_float'></div>";
					}
					if ($z < count($bed_color)) {
						$type_z = $bed_color[$z];
						echo "<div class='bed' style='background-color:$type_z;'>";
						echo "</div>";
					} else if ($new_room_bed < count($bed_color)) {
						$b_f_color = " style='color:white;background-color:black'";
						echo "<div class='bed'$b_f_color>";
						echo count($bed_color) - $new_room_bed;
						echo "</div>";
						break;
					} else if ($z < $new_room_bed) {
						echo "<div class='bed'>";
						echo "</div>";
					}
					$z++;
				}
			}
			echo "</div>";//float_div

			echo "</div>";//room
		}
		echo "<div class='clear_float'></div>";

		//count the out room person
		while (($x + 1) * 100  < intval($person_array[$room_index]["person_room"])) {
			array_push($out_room, $person_array[$room_index]["person_room"]);
			$room_index++;
		}
	}
	echo '</div>';//room_area

	//echo wrong room
	for ($out_index = 0; $out_index < count($out_room); $out_index++) {
		$new_room_name = $out_room[$out_index];
		echo "<div class='room' id='room_$new_room_name' onclick='room_onclick(this)' style='background-color:#000;'>";
		echo "<div class='room_name'>$new_room_name</div>";
		echo "</div>";//room
	}
}

?>
