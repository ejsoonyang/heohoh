<?php
//use $history_array to display the history board
include_once "../header.php";

$filter_ID = test_input($_REQUEST["filter_ID"]);
include "../php_person/read_history.php";

echo '<table id="history_table">';
echo "<tr><th>到達時間</th><th>-</th><th>離開時間</th><th>-</th><th>樓名</th><th>房號</th><th>類別</th><th>組名</th></tr>";

$history_array_length = count($history_array);
for ($i = 0; $i < count($history_array); $i++) {
	echo "<tr class='history_tr'>";
	foreach($history_array[$i] as $j=>$k) {
		echo '<td class="history_table_' . $j . '">';
        if ("0000-00-00" == $k || "00:00:00" == $k) {
            $k = "";
        }
		echo $k . "</td>";
	}
       echo "</tr>" . "\n";
}
echo "</table>";

?>
