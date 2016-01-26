<?php
//use $person_array to display the person board
include_once "../header.php";
include "../php_person/read_person.php";

echo '<table id="person_table">';
echo "<tr>";
if ("filter_read" == $read_type) {
	echo "<th>功能</th>";
//} else if ("all_person" == $read_type) {
}

echo "<th>姓名</th><th>性別</th><th>生日</th><th>手機號碼</th><th>樓名</th><th>房號</th><th>類別</th><th>組名</th><th>法號</th><th>學歷</th><th>身份證號</th><th>身份證地址</th><th>現住地址</th><th>乂</th><th>備注</th><th>預到時間</th><th>-</th><th>預到確定程度</th><th>到達時間</th><th>-</th><th>預離時間</th><th>-</th><th>預離確定程度</th><th>離開時間</th><th>-</th><th>請假開始時間</th><th>-</th><th>請假結束時間</th><th>-</th><th>健康狀況</th><th>婚姻狀況</th><th>電子郵箱</th><th>QQ號碼</th><th>緊急聯繫人</th><th>緊急聯繫人與本人關係</th><th>緊急聯繫人聯繫電話</th><th>工作單位</th><th>職務</th><th>工作經歷(詳細)</th><th>專長/特長</th><th>義工能否服從分配</th><th>義工其他建議要求</th><th>義工爲何申請加入</th></tr>";

$person_array_length = count($person_array);
for ($i = 0; $i < count($person_array); $i++) {
	echo "<tr class='person_tr'>";
   	foreach($person_array[$i] as $j=>$k) {
		if ("person_credit" == $j) {
			continue;
		}
		if ("person_ID" != $j or "all_person" != $read_type) {
			echo '<td class="person_table_' . $j . '">';
		}
		if ("person_ID" == $j && "filter_read" == $read_type) {
			if ($person_array[$i]["person_house"] != "" && $person_array[$i]["person_room"] != "" ) {
				echo "<button class='person_leave_button' onclick='person_leave($k)'>離</button>";
			} else if ($person_array[$i]["person_arrive_date"] != "0000-00-00" && $person_array[$i]["person_arrive_time"] != "00:00:00" && $person_array[$i]["person_preleave_date"] != "0000-00-00" && $person_array[$i]["person_preleave_time"] != "00:00:00" && $person_array[$i]["person_preleave_confirm"] != "") {
				echo "<button class='person_settle_button' id='person_settle_button$k' onclick='person_settle($k, this)'>住</button>";
			}
			echo "<button class='person_update_button' onclick='open_attribute($k)'>改</button>";
            $k = "";
		//} else if ("person_ID" == $j && "all_person" == $read_type) {
		}
        if ("0000-00-00" == $k || "00:00:00" == $k) {
            $k = "";
        } else if ($j == "person_sexuality") {
            $k = ($k == "true" ? "男" : "女");
        }
		if ("person_ID" != $j or "all_person" != $read_type) {
			echo $k . "</td>";
		}
	}
       echo "</tr>" . "\n";
}
echo "</table>";

?>
