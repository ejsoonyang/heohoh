var pop_win = document.getElementById("pop_win");
var setting = document.getElementById("setting");

var house_list = document.getElementById("house_list");
var house_right = document.getElementById("house_right");

var room_type_ab = document.getElementById("room_type_ab");

var timer_message_handle;
var count_msg_sum;
var timer_pictures_handle;
var swc_img_src = ["main", "screenshot", "info", "try", "browser", "author", "thanks"];
var swc_img_index = 0;

function close_pop_win() {
	pop_win.style.display = "none";
	pop_win.innerHTML = "";
}

function open_attribute(filter_ID) {
	attribute_str = "php_board/attribute_board.php";
	attribute_str += "?filter_ID=" + filter_ID;
	if (0 == filter_ID) {
		var filter_house_class = document.getElementsByClassName("house_list_down");
		var filter_room_class = document.getElementsByClassName("room_selected");
		if (filter_room_class.length == 1) {
			var filter_house = filter_house_class[0].getElementsByClassName("house_list_in")[0];
			var filter_room = filter_room_class[0].getElementsByClassName("room_name")[0];
			attribute_str += "&filter_house=" + encodeURI(filter_house.innerHTML);
			attribute_str += "&filter_room=" + encodeURI(filter_room.innerHTML);
   		}
   	}
	var attribute_xml = new XMLHttpRequest();
	attribute_xml.onreadystatechange = function() {
		if (attribute_xml.readyState == 4 && attribute_xml.status == 200) {
			pop_win.innerHTML = attribute_xml.responseText;
			pop_win.style.display = "block";
		}
	}
	attribute_xml.open("GET", attribute_str, true);
	attribute_xml.send();
}

function close_attribute() {
	pop_win.style.display = "none";
	pop_win.innerHTML = "";
}

function view_house_function() {
	var view_house = new XMLHttpRequest();
	view_house.onreadystatechange = function() {
		if (view_house.readyState == 4 && view_house.status == 200) {
			house_list.innerHTML = view_house.responseText;
		}
	}
	view_house.open("GET", "php_board/house_board.php", true);
	view_house.send();
}

function view_setting_house_function() {
	var setting_xml = new XMLHttpRequest();
	setting_xml.onreadystatechange = function() {
		if (setting_xml.readyState == 4 && setting_xml.status == 200) {
			pop_win.innerHTML = setting_xml.responseText;
		}
	}
	setting_xml.open("GET", "php_board/set_house_board.php", true);
	setting_xml.send();
}

function open_setting_house() {
	view_setting_house_function();
	pop_win.style.display = "block";
}

function reset_setting_house() {
	document.getElementById("add_house_form").reset();
}

function setting_house_function(command) {
	if (check_same("update_house")) {
		return;
	}
	var url = "php_setting/setting_house.php?command=" + String(command);
	if (0 == command) {
		var add_house = document.getElementById("add_house");
		var add_row = document.getElementById("add_row");
		var add_col = document.getElementById("add_col");
		var add_bed = document.getElementById("add_bed");
		if (add_house.value == "" || add_row.value == "" || add_col.value == "" || add_bed.value == "") {
			alert('！不能爲空');
			return;
		}
		url += "&input_house=" + encodeURI(add_house.value);
		url += "&input_row=" + encodeURI(add_row.value);
		url += "&input_col=" + encodeURI(add_col.value);
		url += "&input_bed=" + encodeURI(add_bed.value);
	} else {
		if (confirm(command > 0 ? "確認更改!!!" : "確認刪除!!!")) {
			var update_house = document.getElementsByClassName("update_house");
			var update_row = document.getElementsByClassName("update_row");
			var update_col = document.getElementsByClassName("update_col");
			var update_bed = document.getElementsByClassName("update_bed");
			if (update_house[Math.abs(command)] == "" || update_row[Math.abs(command)] == "" || update_col[Math.abs(command)] == "" || update_bed[Math.abs(command)] == "") {
				alert('！不能爲空');
				return;
			}
			url += "&input_house=" + encodeURI(update_house[Math.abs(command)].value);
			url += "&input_row=" + encodeURI(update_row[Math.abs(command)].value);
			url += "&input_col=" + encodeURI(update_col[Math.abs(command)].value);
			url += "&input_bed=" + encodeURI(update_bed[Math.abs(command)].value);
		} else {
			return;
		}
	}
	var setting_xml = new XMLHttpRequest();
	setting_xml.onreadystatechange = function() {
		if (setting_xml.readyState == 4 && setting_xml.status == 200) {
			view_setting_house_function();
			view_house_function();
			house_right.innerHTML = "";
			filter_function();
		}
	}
	setting_xml.open("GET", url, true);
	setting_xml.send();
}

function person_arrange_function(nav_span) {
	var add = document.getElementById("add");
	var filter_form = document.getElementById("filter_form");
	if (add.innerHTML == "取消") {
		return;
	}
	for (var i = 1; i <= 3; i++) {
		document.getElementById("nav_span" + String(i)).className = "nav_span";
	}
	nav_span.className = "nav_span_static";

	house_right.innerHTML = "";
	var house_class = document.getElementsByClassName("house_list_down")
	if (house_class.length == 1) {
		house_class[0].className = "house_list_up";
	}
	filter_form.reset();
	filter_function();
}

function house_selected(house_list_id, room_selected_id) {
	var add = document.getElementById("add");
	var filter_form = document.getElementById("filter_form");
	if (add.innerHTML == "取消") {
		return;
	}
	var count_house = house_list.childElementCount;
	for (var i = 0; i < count_house; i++) {
		document.getElementById("house_list" + String(i)).className = "house_list_up";
	}
	document.getElementById(house_list_id).className = "house_list_down";

	var url_room_board = "php_board/room_board.php?house_id=";
	url_room_board += house_list_id.slice(10);
	var view_room = new XMLHttpRequest();
	view_room.onreadystatechange = function() {
		if (view_room.readyState == 4 && view_room.status == 200) {
			house_right.innerHTML = view_room.responseText;
			document.getElementById("nav_span1").className = "nav_span";
			document.getElementById("nav_span2").className = "nav_span_static";
			document.getElementById("nav_span3").className = "nav_span";
			if (room_selected_id != undefined) {
				var room_selected = document.getElementById(room_selected_id);
				room_onclick(room_selected);
			} else {
				filter_form.reset();
				filter_function();
			}
		}
	}
	view_room.open("GET", url_room_board, false);
	view_room.send();
}

function view_setting_room_type() {
	var setting_xml = new XMLHttpRequest();
	setting_xml.onreadystatechange = function() {
		if (setting_xml.readyState == 4 && setting_xml.status == 200) {
			pop_win.innerHTML = setting_xml.responseText;
		}
	}
	setting_xml.open("GET", "php_board/setting_room_type_board.php", false);
	setting_xml.send();
}

function open_setting_room_type() {
	view_setting_room_type();
	set_all_form_color("room_type_form");
	pop_win.style.display = "block";
}

function reset_setting_room_type() {
	document.getElementById("add_room_type_form").reset();
}

function setting_room_type_function(command) {
	if (check_same("update_room_type") || check_same("pic_color_hidden")) {
		return;
	}
	var url = "php_setting/setting_room_type.php?command=" + String(command);
	if (0 == command) {
		var input_room_type = document.getElementById("add_room_type");
		if (input_room_type.value == "") {
			alert('請填寫房間類型名稱');
			return;
		}
		var pic_color_hidden = document.getElementsByClassName("pic_color_hidden");
		url += "&input_room_type=" + encodeURI(input_room_type.value);
		url += "&input_color=" + pic_color_hidden[0].value;
	} else {
		if (confirm(command > 0 ? "確認更改!!!" : "確認刪除!!!")) {
			var update_room_type = document.getElementsByClassName("update_room_type");
			if (update_room_type[Math.abs(command)].value == "") {
				alert('請填寫房間類型名稱');
				return;
		}
			var pic_color_hidden = document.getElementsByClassName("pic_color_hidden");
			url += "&input_room_type=" + encodeURI(update_room_type[Math.abs(command)].value);
			url += "&input_color=" + encodeURI(pic_color_hidden[Math.abs(command)].value);
		} else {
			return;
		}
	}

	var setting_xml = new XMLHttpRequest();
	setting_xml.onreadystatechange = function() {
		if (setting_xml.readyState == 4 && setting_xml.status == 200) {
			//alert(setting_xml.responseText);
			view_setting_room_type();
			set_all_form_color("room_type_form");
			view_room_type_panel();
		}
	}
	setting_xml.open("GET", url, true);
	setting_xml.send();
}

/*
function refresh_setting_person_type() {
	var filter_type = document.getElementById("filter_type");
	filter_type.innerHTML="<option>gugu</option>";
}
*/

function view_setting_person_type() {
	var setting_xml = new XMLHttpRequest();
	setting_xml.onreadystatechange = function() {
		if (setting_xml.readyState == 4 && setting_xml.status == 200) {
			pop_win.innerHTML = setting_xml.responseText;
		}
	}
	setting_xml.open("GET", "php_board/setting_person_type_board.php", false);
	setting_xml.send();
}

function open_setting_person_type() {
	view_setting_person_type();
	set_all_form_color("person_type_form");
	pop_win.style.display = "block";
}

function setting_person_type_function(command) {
	if (check_same("update_person_type") || check_same("pic_color_hidden")) {
		return;
	}
	var url = "php_setting/setting_person_type.php?command=" + String(command);
	if (0 == command) {
		var input_person_type = document.getElementById("add_person_type");
		if (input_person_type.value == "") {
			alert('！請填寫人員類型名稱');
			return;
		}
		var pic_color_hidden = document.getElementsByClassName("pic_color_hidden");
		url += "&input_person_type=" + encodeURI(input_person_type.value);
		url += "&input_color=" + pic_color_hidden[0].value;
	} else {
		if (confirm(command > 0 ? "確認更改!!!" : "確認刪除!!!")) {
			var update_person_type = document.getElementsByClassName("update_person_type");
			if (update_person_type[Math.abs(command)].value == "") {
				alert('！請填寫人員類型名稱');
				return;
			}
			var pic_color_hidden = document.getElementsByClassName("pic_color_hidden");
			url += "&input_person_type=" + encodeURI(update_person_type[Math.abs(command)].value);
			url += "&input_color=" + encodeURI(pic_color_hidden[Math.abs(command)].value);
		} else {
			return;
		}
	}

	var setting_xml = new XMLHttpRequest();
	setting_xml.onreadystatechange = function() {
		if (setting_xml.readyState == 4 && setting_xml.status == 200) {
			//alert(setting_xml.responseText);
			view_setting_person_type();
			set_all_form_color("person_type_form");
//refresh_setting_person_type();
	var filter_type = document.getElementById("filter_type");
	filter_type.innerHTML=setting_xml.responseText;

	    	//above is to refresh the house and room board, 10 lines
			var room_class = document.getElementsByClassName("room_selected");
			var house_class = document.getElementsByClassName("house_list_down");
			if (room_class.length == 1) {
				var room_id = room_class[0].id;
				house_selected(house_class[0].id, room_id);
			} else if (house_class.length == 1) {
				house_selected(house_class[0].id);
			} else {
				filter_function();
			}
		}
	}
	setting_xml.open("GET", url, true);
	setting_xml.send();
}

function check_same(class_name) {
	var o_array = [];
	var o_class = document.getElementsByClassName(class_name);
	for (var arr_x = 0; arr_x < o_class.length; arr_x++) {
		o_array.push(o_class[arr_x].value);
	}
	o_array.sort();
	for (arr_x = 1; arr_x < o_array.length; arr_x++) {
		if (o_array[arr_x - 1] == o_array[arr_x]) {
			alert('！請勿與其他項同值');
			return true;
		}
	}
	return false;
}

function view_room_type_panel() {
	var rtp_xml = new XMLHttpRequest();
	rtp_xml.onreadystatechange = function() {
		if (rtp_xml.readyState == 4 && rtp_xml.status == 200) {
			room_type_ab.innerHTML = rtp_xml.responseText;
		}
	}
	rtp_xml.open("GET", "php_board/room_type_board.php", false);
	rtp_xml.send();
}	

function select_room_type_col(itself) {
	var room_type_main_in = document.getElementById("room_type_main_in");
	switch (room_type_state()) {
		case 0:
			room_type_ab.style.overflow = "visible";
			break;
		case 1:
			room_type_ab.style.overflow = "hidden";
			if (itself.innerHTML != "房 間 填 色") {
				room_type_main_in.innerHTML = itself.innerHTML;
				var in_hidden = itself.parentNode.getElementsByClassName("room_type_in_hidden")[0];
				room_type_main_in.style.backgroundColor = in_hidden.value;
			}
			break;
		case 2:
			itself.innerHTML = "房 間 填 色";
			itself.style.backgroundColor = "initial";
			break;
	}
}

//state 2 stands for filling color
function room_type_state() {
	var room_type_main_in = document.getElementById("room_type_main_in");
	if (room_type_ab.style.overflow == "visible") {
		return 1;
	} else {
		if (room_type_main_in.innerHTML != "房 間 填 色") {
			return 2;
		} else {
			return 0;
		}
	}
}

function room_onclick(itself) {
	if (2 == room_type_state()) {
		var room_type_main_in = document.getElementById("room_type_main_in");
		var house_id = document.getElementsByClassName("house_list_down")[0];
		var src_str = "php_setting/set_room_color.php";
		src_str += "?house_id=" + house_id.id.substr(10);
		src_str += "&room_row=" + itself.id.substr(5,1);
		src_str += "&room_col=" + itself.id.substr(6,2);
		src_str += "&room_color=" + room_type_main_in.style.backgroundColor;
	
		var src_xml = new XMLHttpRequest();
		src_xml.onreadystatechange = function() {
			if (src_xml.readyState == 4 && src_xml.status == 200) {
				house_selected(house_id.id);
			}
		}
		src_xml.open("GET", src_str, true);
		src_xml.send();
	} else {
		var filter_form = document.getElementById("filter_form");
		var add = document.getElementById("add");
		if (add.innerHTML == "取消") {
			return;
		}
		var room_selected = document.getElementsByClassName("room_selected");
		if (room_selected.length == 1) {
			room_selected[0].className = "room";
		}
		if (itself.className == "room") {
			itself.className = "room_selected";
		} else {
			itself.className = "room";
		}

		if (add.innerHTML == "返回") {
		//settle a person who was selected below

			var settle_button_class = document.getElementsByClassName("person_settle_button_up");
			var settle_person_ID = settle_button_class[0].id.replace("person_settle_button", "");
			var filter_house_class = document.getElementsByClassName("house_list_down");
			var filter_house = filter_house_class[0];
			var filter_house_name = filter_house.getElementsByClassName("house_list_in")[0];
			var filter_room_name = itself.getElementsByClassName("room_name")[0];
			var settle_url = "php_person/person_settle.php";
			settle_url += "?settle_person_ID=" + settle_person_ID;
			settle_url += "&settle_house=" + encodeURI(filter_house_name.innerHTML);
			settle_url += "&settle_room=" + encodeURI(filter_room_name.innerHTML);
		
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					var hint = document.getElementById("hint");
			    	hint.innerHTML = xmlhttp.responseText;
					var filter_room_id = itself.id;
					add.innerHTML = "入住";
					add.style.color = "initial";
					house_selected(filter_house.id, filter_room_id);
			    }
			}
			xmlhttp.open("GET", settle_url, true);
			xmlhttp.send();
		} else {
			filter_form.reset();
			filter_function();
		}
	}
}

function view_set_specify() {
	var room_selected = document.getElementsByClassName("room_selected");
	if (room_selected.length == 1) {
		var house_clicked = document.getElementsByClassName("house_list_down")[0];

		var set_bed_str = "php_board/set_bed_board.php";
		set_bed_str += "?the_house=" + house_clicked.id.substr(10);
		set_bed_str += "&the_room=" + room_selected[0].id.substr(5);

		var set_bed_xml = new XMLHttpRequest();
		set_bed_xml.onreadystatechange = function() {
			if (set_bed_xml.readyState == 4 && set_bed_xml.status == 200) {
				pop_win.innerHTML = set_bed_xml.responseText;
				pop_win.style.display = "block";
			}
		}
		set_bed_xml.open("GET", set_bed_str, true);
		set_bed_xml.send();
	} else {
		alert("！請選擇房間");
	}
}
function set_bed_function() {
	var set_bed_input = document.getElementById("set_bed_input");
	var room_selected_class = document.getElementsByClassName("room_selected");
	var house_clicked = document.getElementsByClassName("house_list_down")[0];
	var room_selected = room_selected_class[0];
	var set_bed_str = "php_setting/set_bed.php";
	set_bed_str += "?the_house=" + house_clicked.id.substr(10);
	set_bed_str += "&the_room=" + room_selected.id.substr(5);
	if ("" == + set_bed_input.value) {
		alert("！請勿爲空");
		return;
	} else if (isNaN(parseInt(set_bed_input.value))) {
		alert("！請輸入數字");
		return;
	} else {
		set_bed_str += "&the_bed=" + String(parseInt(set_bed_input.value));
	}
	//alert(set_bed_input.value);

		var set_bed_xml = new XMLHttpRequest();
		set_bed_xml.onreadystatechange = function() {
			if (set_bed_xml.readyState == 4 && set_bed_xml.status == 200) {
				alert("床數改爲" + String(parseInt(set_bed_input.value)));
				close_pop_win();
				house_selected(house_clicked.id);
				room_onclick(document.getElementById(room_selected.id));
			}
		}
		set_bed_xml.open("GET", set_bed_str, true);
		set_bed_xml.send();
}

function open_set_person_password() {
	var pw_str = "php_board/set_pw_board.php";
	pw_str += "?the_person=" ;

	var pw_xml = new XMLHttpRequest();
	pw_xml.onreadystatechange = function() {
		if (pw_xml.readyState == 4 && pw_xml.status == 200) {
			pop_win.innerHTML = pw_xml.responseText;
			pop_win.style.display = "block";
		}
	}
	pw_xml.open("GET", "php_board/set_pw_board.php", true);
	pw_xml.send();
}

function set_pw_function() {
	var set_pw_original = document.getElementById("set_pw_original");
	var set_pw_new = document.getElementById("set_pw_new");
	var set_pw_twice = document.getElementById("set_pw_twice");
	if ("" == set_pw_original.value || "" == set_pw_new.value || "" == set_pw_twice.value) {
		alert("！請勿爲空");
		return;
	}
	if (set_pw_new.value != set_pw_twice.value) {
		alert("！兩次密碼不一致");
		return;
	}
	if (set_pw_new.value == set_pw_original.value) {
		alert("！請輸入一個新密碼");
		return;
	}
	var set_pw_str = "original_password=" + encodeURI(set_pw_original.value);
	set_pw_str += "&new_password=" + encodeURI(set_pw_new.value);

	var set_pw_xml = new XMLHttpRequest();
	set_pw_xml.onreadystatechange = function() {
		if (set_pw_xml.readyState == 4 && set_pw_xml.status == 200) {
			alert(set_pw_xml.responseText);
			//close_pop_win();
		}
	}
	set_pw_xml.open("POST","php_person/set_pw.php",true);
	set_pw_xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	set_pw_xml.send(set_pw_str);
}

function open_set_person_pms() {
	viem_set_person_pms();
	pop_win.style.display = "block";
}

function viem_set_person_pms() {
	var pms_xml = new XMLHttpRequest();
	pms_xml.onreadystatechange = function() {
		if (pms_xml.readyState == 4 && pms_xml.status == 200) {
			pop_win.innerHTML = pms_xml.responseText;
			pop_win.style.display = "block";
		}
	}
	pms_xml.open("GET", "php_board/set_pms_board.php", true);
	pms_xml.send();
}

function reset_person_pms() {
	var set_pms_form = document.getElementById("set_pms_form");
	set_pms_form.reset();
}

function pms_function(pms_type) {
	if ("pms_type_add" == pms_type) {
		var add_pms_name = document.getElementById("add_pms_name");
		var add_pms_permission = document.getElementById("add_pms_permission");
		var add_pms_identity = document.getElementById("add_pms_identity");
		var add_pms_password = document.getElementById("add_pms_password");
		if (add_pms_name.value == "" || add_pms_permission.value == "" || add_pms_identity.value == "" || add_pms_password.value == "") {
			alert("！請把信息填寫完整");
			return;
		}
		var pms_str = "pms_type=add";
		pms_str += "&pms_name=" + add_pms_name.value;
		pms_str += "&pms_permission=" + add_pms_permission.value;
		pms_str += "&pms_identity=" + add_pms_identity.value;
		pms_str += "&pms_password=" + add_pms_password.value;
	} else {
		var update_pms_name = document.getElementsByClassName("update_pms_name");
		var update_pms_permission = document.getElementsByClassName("update_pms_permission");
		var update_pms_password = document.getElementsByClassName("update_pms_password");
		if (0 == pms_type.indexOf("pms_type_update")) {
			var pms_str = "pms_type=update";
			var pms_num = parseInt(pms_type.replace("pms_type_update", ""));
			if (update_pms_name[pms_num].value == "" || update_pms_permission[pms_num].value == "" || update_pms_password[pms_num].value == "") {
				alert("！請把信息填寫完整");
				return;
			}
		}
		if (0 == pms_type.indexOf("pms_type_delete")) {
			var pms_str = "pms_type=delete";
			var pms_num = parseInt(pms_type.replace("pms_type_delete", ""));
		}
		pms_str += "&pms_name=" + update_pms_name[pms_num].value;
		pms_str += "&pms_permission=" + update_pms_permission[pms_num].value;
		pms_str += "&pms_password=" + update_pms_password[pms_num].value;
	}

	var pms_xml = new XMLHttpRequest();
	pms_xml.onreadystatechange = function() {
		if (pms_xml.readyState == 4 && pms_xml.status == 200) {
			alert(pms_xml.responseText);
			viem_set_person_pms();
		}
	}
	pms_xml.open("POST","php_person/set_pms.php",true);
	pms_xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	pms_xml.send(pms_str);
}

function view_not_leave() {
	var vnl_xml = new XMLHttpRequest();
	vnl_xml.onreadystatechange = function() {
		if (vnl_xml.readyState == 4 && vnl_xml.status == 200) {
			pop_win.innerHTML = vnl_xml.responseText;
			pop_win.style.display = "block";
		}
	}
	vnl_xml.open("GET", "php_board/not_leave_board.php", false);
	vnl_xml.send();
}

function view_not_confirm() {
	var vnc_xml = new XMLHttpRequest();
	vnc_xml.onreadystatechange = function() {
		if (vnc_xml.readyState == 4 && vnc_xml.status == 200) {
			pop_win.innerHTML = vnc_xml.responseText;
			pop_win.style.display = "block";
		}
	}
	vnc_xml.open("GET", "php_board/not_confirm_board.php", false);
	vnc_xml.send();
}

function view_message() {
	var drop_message = document.getElementById("drop_message");

	var msg_xml = new XMLHttpRequest();
	msg_xml.onreadystatechange = function() {
		if (msg_xml.readyState == 4 && msg_xml.status == 200) {
			clearInterval(timer_message_handle);
			drop_message.innerHTML = msg_xml.responseText;
			flash_message();
		}
	}
	msg_xml.open("GET", "php_board/drop_message_board.php", true);
	msg_xml.send();
}

function flash_message() {
	var msg_sum = document.getElementById("msg_sum");
	if (parseInt(msg_sum.innerHTML)) {
		count_msg_sum = msg_sum.innerHTML;
		timer_message_handle = setInterval(timer_message, 1000);
	} else {
		msg_sum.innerHTML = "消息";
		msg_sum.onclick = function(){alert("！沒有消息")};
	}
}

function timer_message() {
	var msg_sum = document.getElementById("msg_sum");
	if (msg_sum.innerHTML == "消息") {
		msg_sum.innerHTML = count_msg_sum;
	} else {
		msg_sum.innerHTML = "消息";
	}
}

function view_picture() {
	var house_selected = document.getElementsByClassName("house_list_down");
	if (house_selected.length == 0) {
		var house_right = document.getElementById("house_right");
		var check_img = house_right.getElementsByTagName("img");
		if (check_img.length == 0) {
			//append <img> into #room
			var vtc_div = document.createElement("div");
			var swc_img = document.createElement("img");
			vtc_div.className = "vertical_middle";
			swc_img.className = "swc_img";
			swc_img.src = "pictures/main.png";
			house_right.appendChild(vtc_div);
			house_right.appendChild(swc_img);

			//interval switch pictures
			clearInterval(timer_pictures_handle);
			timer_pictures_handle = setInterval(timer_pictures, 7000);
		}
	} else {
		clearInterval(timer_pictures_handle);
	}
}

function timer_pictures() {
	var swc_img = document.getElementsByClassName("swc_img");
	if (swc_img.length) {
		swc_img_index += 1;
		swc_img_index %= swc_img_src.length;
		swc_img[0].src = "pictures/" + swc_img_src[swc_img_index] + ".png";
	}
}

function adjust_house_board(evn) {
	var house = document.getElementById("house");
	var house_list = document.getElementById("house_list");
	
	if (undefined == evn) {
		house.style.height = "500px";
		house_list.style.height = "420px";
		return;
	}
	if (evn.ctrlKey) {
 		if("38" == evn.keyCode) {
			if (200 < parseInt(house.style.height.replace("px", ""))) {
				house.style.height = String(parseInt(house.style.height.replace("px", "")) - 100) + "px";
				house_list.style.height = String(parseInt(house_list.style.height.replace("px", "")) - 100) + "px";
			} else {
				//alert("！最小值200px");
				return;
			}
 		} else if("40" == evn.keyCode) {
			if (800 > parseInt(house.style.height.replace("px", ""))) {
				house.style.height = String(parseInt(house.style.height.replace("px", "")) + 100) + "px";
				house_list.style.height = String(parseInt(house_list.style.height.replace("px", "")) + 100) + "px";
			} else {
				//alert("！最大值800px");
				return;
			}
 		}
	}
}

function enter_pw(evn) {
	if (undefined == evn) {
		return;
	}
 	if("13" == evn.keyCode) {
 		set_pw_function();
 	}
}

function enter_filter(evn) {
	if (undefined == evn) {
		return;
	}
 	if("13" == evn.keyCode) {
		if (evn.ctrlKey) {
			document.getElementById("nav_span1").className = "nav_span";
			document.getElementById("nav_span2").className = "nav_span";
			document.getElementById("nav_span3").className = "nav_span_static";
		}
 		filter_function();
 	}
}

function body_onload() {
	view_house_function();
	view_room_type_panel();
	filter_function();
	adjust_house_board();
}

