<?php
//js open_attribute() to execute this php file
include_once "../header.php";

$filter_ID = intval(test_input($_GET["filter_ID"]));
if (0 != $filter_ID) {
	//update a person
	include "../php_person/read_person.php";
	$this_person = $person_array[$filter_ID - 1];
	$person_credit = $this_person["person_credit"];

	$person_name = $this_person["person_name"];
	$person_sexuality = $this_person["person_sexuality"];
	$person_birth = $this_person["person_birth"];
	$person_phone = $this_person["person_phone"];

	$person_house = $this_person["person_house"];
	$person_room = $this_person["person_room"];
	$person_type = $this_person["person_type"];
	$person_group = $this_person["person_group"];

	$person_dharma = $this_person["person_dharma"];
	$person_degree= $this_person["person_degree"];
	$person_identity = $this_person["person_identity"];
	$person_identity_address = $this_person["person_identity_address"];
	$person_current_address = $this_person["person_current_address"];

	$person_x = ("1" == $this_person["person_x"] ? "checked" : "");
	$person_remarks = $this_person["person_remarks"];

	$person_prearrive_date = $this_person["person_prearrive_date"];
	$person_prearrive_time = $this_person["person_prearrive_time"];
	$person_prearrive_confirm = $this_person["person_prearrive_confirm"];
	$person_arrive_date = $this_person["person_arrive_date"];
	$person_arrive_time = $this_person["person_arrive_time"];

	$person_preleave_date = $this_person["person_preleave_date"];
	$person_preleave_time = $this_person["person_preleave_time"];
	$person_preleave_confirm = $this_person["person_preleave_confirm"];
	//$person_leave_date = $this_person["person_leave_date"];
	//$person_leave_time = $this_person["person_leave_time"];

	$person_healthy = $this_person["person_healthy"];
	$person_marriage = $this_person["person_marriage"];
	$person_email = $this_person["person_email"];
	$person_QQ = $this_person["person_QQ"];
	$person_emergency_person = $this_person["person_emergency_person"];
	$person_emergency_relationship = $this_person["person_emergency_relationship"];
	$person_emergency_contact = $this_person["person_emergency_contact"];
	$person_employer = $this_person["person_employer"];
	$person_job = $this_person["person_job"];
	$person_work_experience = $this_person["person_work_experience"];
	$person_specialty_features = $this_person["person_specialty_features"];

	$person_volunteer_obey = $this_person["person_volunteer_obey"];
	$person_volunteer_advise = $this_person["person_volunteer_advise"];
	$person_volunteer_reason = $this_person["person_volunteer_reason"];

	$person_birth = ($person_birth == "0000-00-00" ? "": $person_birth);
	$person_prearrive_date = ($person_prearrive_date == "0000-00-00" ? "" : $person_prearrive_date);
	$person_arrive_date = ($person_arrive_date == "0000-00-00" ? "" : $person_arrive_date);
	$person_preleave_date = ($person_preleave_date == "0000-00-00" ? "" : $person_preleave_date);
	$person_leave_date = ($person_leave_date == "0000-00-00" ? "" : $person_leave_date);
	$person_sexuality_selected_male = ("true" == $person_sexuality?" selected":"");
	$person_sexuality_selected_female = ("true" == $person_sexuality?"":" selected");
	$person_volunteer_obey_yes = ("能" == $person_volunteer_obey?" selected":"");
	$person_volunteer_obey_no = ("不能" == $person_volunteer_obey?" selected":"");
} else {
	$person_house = test_input($_GET["filter_house"]);
	$person_room = test_input($_GET["filter_room"]);
}

echo '<form id="attribute_main">';
echo '<br><span id="attribute_title">人員信息表格</span><br><br><br>';
echo "<div id='basic_infor'>";
echo "<input type='hidden' name='person_ID' id='person_ID' value='$filter_ID'>";
echo "<div class='float_div'>";
echo "<span class='left_35'>姓名 </span><input type='input' name='person_name' id='person_name' value='$person_name'><br><br>";
echo "<span class='left_35'>法號 </span><input type='input' name='person_dharma' id='person_dharma' value='$person_dharma'><br><br>";
echo "</div>";

echo "<div class='float_div'>";
echo "<span class='left_35'>性別 </span><select name='person_sexuality' id='person_sexuality'>";
echo "	<option value=true$person_sexuality_selected_male>男</option>";
echo "	<option value=false$person_sexuality_selected_female>女</option></select><br><br>";
echo "<span class='left_35'>學歷 </span><select name='person_degree' id='person_degree'>";
degree_select_option($person_degree);
echo "	</select><br><br>";
echo "</div>";

echo "<div class='float_div'>";
echo "<span class='left_35'>出生日期 </span><input type='input' name='person_birth' id='person_birth' value='$person_birth'><br><br>";
echo "<span class='left_35'>手機號碼 </span><input type='input' name='person_phone' id='person_phone' value='$person_phone'><br>";
echo "</div>";
echo "<div class='clear_float'></div>";

echo "<span class='left_35'>身份證號　 </span><input type='input' name='person_identity' id='person_identity' value='$person_identity'><br>";
echo "<span class='left_35'>身份證地址 </span><input type='input' name='person_identity_address' id='person_identity_address' value='$person_identity_address'><br>";
echo "<span class='left_35'>現住地址　 </span><input type='input' name='person_current_address' id='person_current_address' value='$person_current_address'><br>";
echo "<span class='left_35'>備注:　　　　　　　　　　　　</span>";
echo "<input type='hidden' name='person_credit' id='person_credit' value='$person_credit'>";
echo "<span class='left_35'>\$person_credit 乂</span><input type='checkbox' name='person_x' id='person_x' $person_x><br>";
echo "<textarea name='person_remarks' id='person_remarks'>$person_remarks</textarea>";
echo "<hr>";
echo "<span class='left_35' id='person_prearrive_span'>預到時間 </span><input type='input' name='person_prearrive_date' id='person_prearrive_date' value='$person_prearrive_date'><select name='person_prearrive_time' id='person_prearrive_time' class='select_time'>";
time_select_option($person_prearrive_time);
echo "	</select>";
echo "<span class='left_35' id='person_prearrive_arrow'>確定程度 </span><select name='person_prearrive_confirm' id='person_prearrive_confirm'>";
confirm_select_option($person_prearrive_confirm);
echo "	</select>";
echo "<span class='left_35' id='person_arrive_span'>到達日期 </span><input type='input' name='person_arrive_date' id='person_arrive_date' value='";
echo ($person_arrive_date == "" ? date('Y-m-d') : $person_arrive_date);
echo "'><select name='person_arrive_time' id='person_arrive_time' class='select_time'>";
time_select_option(("00:00:00" == $person_arrive_time or "" ==  $person_arrive_time) ? date("H") . ':00:00' : $person_arrive_time);
echo "	</select>";

if ($person_arrive_date == "") {
	echo "<span class='left_35' id='person_arrive_arrow'>&#60;--- </span><button type='button' id='switch_person_arrive_button' onclick='switch_person_arrive()'>？未到達</button>";
}
echo "<br>";
echo "<span class='left_35' id='person_preleave_span'>預離日期 </span><input type='input' id='person_preleave_date' value='$person_preleave_date'><select id='person_preleave_time' class='select_time'>";
time_select_option($person_preleave_time);
echo "	</select>";
echo "<span class='left_35'>確定程度 </span><select id='person_preleave_confirm'>";
confirm_select_option($person_preleave_confirm);
echo "	</select><br>";
echo "<hr>";
echo "<span class='left_35'>樓名 </span><select name='person_house' id='person_house'>";
house_select_option($person_house);
echo "	</select>";
echo "<span> 房間 </span><input type='input' name='person_room' id='person_room' value='$person_room'>";
echo "<span class='left_35'>類別 </span><select name='person_type' id='person_type'>";
person_type_select_option(false, $person_type);
echo "</select>";
echo "<span> 分組 </span><input type='input' name='person_group' id='person_group'><br>";
echo "</div>";

echo "<div id='extend_infor'>";
/*
echo "<span class='left_35'>離開時間</span><input type='input' name='person_leave_date'><select name='person_leave_time' class='select_time'>";
echo "	<?php time_select_option(false); ?>";
echo "	</select><br>";
echo "<span class='left_35'>請假開始時間</span><input type='input' name='person_break_start_date'><select name='person_break_start_time' class='select_time'>";
echo "	<?php time_select_option(false); ?>";
echo "	</select>";
echo "<span class='left_35'>請假結束時間</span><input type='input' name='person_break_end_date'><select name='person_break_end_time' class='select_time'>";
echo "	<?php time_select_option(false); ?>";
echo "<hr>";
*/
echo "<span class='left_35'>健康狀況 </span><input type='input' id='person_healthy' value='$person_healthy'>";
echo "<span class='left_35'>婚姻狀況 </span><input type='input' id='person_marriage' value='$person_marriage'><br>";
echo "<span class='left_35'>電子郵箱 </span><input type='input' id='person_email' value='$person_email'>";
echo "<span class='left_35'>QQ號碼 </span><input type='input' id='person_QQ' value='$person_QQ'><br>";
echo "<span class='left_35'>緊急聯繫 </span><input type='input' id='person_emergency_person' value='$person_emergency_person'>";
echo "<span class='left_35'>關係 </span><input type='input' id='person_emergency_relationship' value='$person_emergency_relationship'>";
echo "<span class='left_35'>&#160;電話 </span><input type='input' id='person_emergency_contact' value='$person_emergency_contact'><br>";
echo "<span class='left_35'>工作單位 </span><input type='input' id='person_employer' value='$person_employer'>";
echo "<span class='left_35'>&#160;&#160;職務 </span><input type='input' id='person_job' value='$person_job'><br>";
echo "<span class='left_35'>工作經歷 </span>";
echo "<textarea name='person_work_experience' id='person_work_experience'>$person_work_experience</textarea>";
echo "<span class='left_35'>&#160;&#160;專長 </span>";
echo "<textarea name='person_specialty_features' id='person_specialty_features'>$person_specialty_features</textarea>";
echo "<hr>";
echo "<span class='left_35'>義工:能否服從分配 </span>";
echo "<select id='person_volunteer_obey'>";
echo "	<option></option><option$person_volunteer_obey_yes>能</option><option$person_volunteer_obey_no>不能</option>";
echo "	</select>";
echo "<span class='left_35'>建議要求 </span><input type='input' id='person_volunteer_advise' value='$person_volunteer_advise'>";
echo "<span class='left_35'>爲何加入 </span><input type='input' id='person_volunteer_reason' value='$person_volunteer_reason'><br>";
echo "<hr>";
echo "<div id='person_history_div'></div>";
echo '</div>';

echo "<br><br>";
echo "<input type='button' value='更多>>>' id='switch_more' onclick='more_attribute(this)'>";
echo "<input type='button' name='person_submit' value='";
echo (0 == $filter_ID ? "加入" : "確認更改");
echo "' id='person_submit' onclick='update_person()'>";
echo "<input type='button' value='取消' id='person_cancel' onclick='close_attribute()'>";
if (0 != $filter_ID) {
	$person_house = $this_person["person_house"];
	$person_room = $this_person["person_room"];
	if ($person_house != "" && $person_room != "") {
		echo "<input type='button' value='離開' id='leave_button' onclick='person_leave($filter_ID)'>";
	}
	echo "<input type='button' value='刪除' id='person_delete' onclick='delete_attribute();'>";
//！目前不提供此功能\n如有需要請聯繫:ejsoon@126.com')'>";
}
echo "<br><br>";
echo '</form>';

?>
