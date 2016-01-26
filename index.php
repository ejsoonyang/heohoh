<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>香海禪寺住房信息管理系統</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
		<link rel="stylesheet" type="text/css" href="css/attribute_form.css"/>
		<link rel="stylesheet" type="text/css" href="css/pic_color.css"/>
	</head>
<?php
$login_name = $_SESSION["login_name"];
$login_permission = $_SESSION["login_permission"];
echo <<<dudu
	<body onkeypress="adjust_house_board(event)" onload="body_onload()">
		<div id="whole">
			<div id="pop_win"></div>
			<div id="head">
				<span class="color_8e9">香海禪寺住房信息管理系統</span>
			</div>
			<div id="navigation">
				<span id="nav_span1" class="nav_span" onclick="person_arrange_function(this)">[未住]</span>
				<span id="nav_span2" class="nav_span_static" onclick="person_arrange_function(this)">[已住]</span>
				<span id="nav_span3" class="nav_span" onclick="person_arrange_function(this)">[全部]</span>
				<a id="navigation_logout" href="logout.php">登出</a>
				<div id="navigation_login">歡迎你︰[$login_name]$login_permission</div>

				<div class="navigation_float_right">
					<div class="drop">
						<div>設置</div>
						<div class="drop_space"></div>
						<div id="drop_setting_house" class="drop_item" onclick="open_setting_house()">樓層設置</div>
						<div class="drop_space"></div>
						<div id="drop_setting_room" class="drop_item" onclick="open_setting_room_type()">房間類型</div>
						<div class="drop_space"></div>
						<div id="drop_setting_person" class="drop_item" onclick="open_setting_person_type()">人員類型</div>
						<div class="drop_space"></div>
dudu;
if ("超級管理員" == $login_permission) {
echo <<<dudu
						<div id="drop_setting_permission" class="drop_item" onclick="open_set_person_pms()">權限設置</div>
dudu;
} else {
echo <<<dudu
						<div id="drop_setting_password" class="drop_item" onclick="open_set_person_password()">密碼設置</div>
dudu;
}
echo <<<dudu
					</div>
				</div>
				<div class="navigation_float_right">
					<div id='drop_message' class="drop"></div>
				</div>
				<div class="navigation_float_right">
					<div class="drop">
						<div>統計</div>
						<div class="drop_space"></div>
						<div id="drop_statistics" class="drop_item" onclick="window.open('statistics.php')">七天人數統計</div>
						<div class="drop_space"></div>
						<div id="drop_all_person" class="drop_item" onclick="window.open('all_person.php')">全部人員信息</div>
					</div>
				</div>
			</div>
			<div id="house">
				<div id="house_left">
					<div id="house_list">
					</div>
					<div id="room_function">
						<button type="button" id="new" onclick="open_attribute(0)">新來</button>
						<button type="button" id="add" onclick="person_settle(0, this)">入住</button>
						<button type="button" id="update" onclick="view_set_specify()">更改</button>
						<br>
					</div>
					<div id='room_type_panel'>
						<div id="room_type_ab"></div>
					</div>
				</div>
				<div id="house_right"></div>
			</div>
			<div id="filter">
				<div id="which">
					<div id="which_arrange"></div>
					<div id="which_house"></div>
					<div id="which_room"></div>
					<div id="its_info"></div>
				</div>
				<form id="filter_form">
					<fieldset id="filter_arrange">
						<legend>範圍篩選</legend>
						類別 <select id="filter_type">
dudu;
							person_type_select_option(true, "");
echo <<<dudu
						</select>
						分組 <input type="input" id="filter_group" onkeydown="enter_filter(event)">
						<span class="left_35">性別 </span>
						<select id="filter_sexuality">
							<option></option>
							<option value=true>男</option>
							<option value=false>女</option>
						</select>
					</fieldset>
					<fieldset id="filter_exact">
						<legend>精確查找</legend>
						姓名 <input type="input" id="filter_name" onkeydown="enter_filter(event)">
						法號 <input type="input" id="filter_dharma" onkeydown="enter_filter(event)">
						<span class="left_35">身份證號 </span>
						<input type="input" id="filter_identity" onkeydown="enter_filter(event)">
					</fieldset>
					<button type="button" id="filter_submit" onclick="filter_function();">篩選</button>
				</form>
				<div id="which_count"></div>
				<div class='clear_float'></div>
			</div>
			<div id="hint"></div>
			<div id="person"></div>
		</div>
	<footer>
		<script src="js/index.js"></script>
		<script src="js/filter.js"></script>
		<script src="js/update_person.js"></script>
		<script src="js/pic_color.js"></script>
	</footer>
	</body>
dudu;
?>
</html>
