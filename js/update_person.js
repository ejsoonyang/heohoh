var hint = document.getElementById("hint");
var person = document.getElementById("person");
var pop_win = document.getElementById("pop_win");

function read_attribute_form() {
	var person_ID = document.getElementById("person_ID");
	var person_credit = document.getElementById("person_credit");
	var person_name = document.getElementById("person_name");
	var person_sexuality = document.getElementById("person_sexuality");
	var person_birth = document.getElementById("person_birth");
	var person_phone = document.getElementById("person_phone");
	
	var person_house = document.getElementById("person_house");
	var person_room = document.getElementById("person_room");
	
	var person_type = document.getElementById("person_type");
	var person_group = document.getElementById("person_group");
	
	var person_dharma = document.getElementById("person_dharma");
	var person_degree = document.getElementById("person_degree");
	var person_identity = document.getElementById("person_identity");
	var person_identity_address = document.getElementById("person_identity_address");
	var person_current_address = document.getElementById("person_current_address");
	var person_x = document.getElementById("person_x");
	var person_remarks = document.getElementById("person_remarks");

	var person_prearrive_date = document.getElementById("person_prearrive_date");
	var person_prearrive_time = document.getElementById("person_prearrive_time");
	var person_prearrive_confirm = document.getElementById("person_prearrive_confirm");
	var person_arrive_date = document.getElementById("person_arrive_date");
	var person_arrive_time = document.getElementById("person_arrive_time");

	var person_preleave_date = document.getElementById("person_preleave_date");
	var person_preleave_time = document.getElementById("person_preleave_time");
	var person_preleave_confirm = document.getElementById("person_preleave_confirm");
/*
	var person_leave_date = document.getElementById("person_leave_date");
	var person_leave_time = document.getElementById("person_leave_time");

*/
	var person_prearrive_span = document.getElementById("person_prearrive_span");
	var person_prearrive_arrow = document.getElementById("person_prearrive_arrow");
	var person_arrive_span = document.getElementById("person_arrive_span");
	var person_arrive_arrow = document.getElementById("person_arrive_arrow");
	var switch_person_arrive_button = document.getElementById("switch_person_arrive_button");

/*
	var person_break_start_date = document.getElementById("person_break_start_date");
	var person_break_start_time = document.getElementById("person_break_start_time");
	var person_break_end_date = document.getElementById("person_break_end_date");
	var person_break_end_time = document.getElementById("person_break_end_time");
*/
	var person_healthy = document.getElementById("person_healthy");
	var person_marriage = document.getElementById("person_marriage");
	var person_email = document.getElementById("person_email");
	var person_QQ = document.getElementById("person_QQ");
	var person_emergency_person = document.getElementById("person_emergency_person");
	var person_emergency_relationship = document.getElementById("person_emergency_relationship");
	var person_emergency_contact = document.getElementById("person_emergency_contact");
	var person_employer = document.getElementById("person_employer");
	var person_job = document.getElementById("person_job");
	var person_work_experience = document.getElementById("person_work_experience");
	var person_specialty_features = document.getElementById("person_specialty_features");
	
	var person_volunteer_obey = document.getElementById("person_volunteer_obey");
	var person_volunteer_advise = document.getElementById("person_volunteer_advise");
	var person_volunteer_reason = document.getElementById("person_volunteer_reason");
}

function person_leave(leave_person_ID) {
	var leave_url = "php_person/person_leave.php?leave_person_ID=" + String(leave_person_ID);

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			hint.innerHTML = xmlhttp.responseText;
	    	//below is to refresh the house and room board, 10 lines
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
			close_pop_win();
	    }
	}
	xmlhttp.open("GET", leave_url, true);
	xmlhttp.send();
}

function person_settle(settle_person_ID, itself) {
	var add = document.getElementById("add");
	if (0 == settle_person_ID) {
	//click house list settle button
		if (add.innerHTML == "入住") {
			var room_class = document.getElementsByClassName("room_selected");
			if (room_class.length == 0) {
				alert("！請選擇房間");
				return;
			}
			add.innerHTML = "取消";
			add.style.color = "#f72";
			document.getElementById("nav_span1").className = "nav_span_static";
			document.getElementById("nav_span2").className = "nav_span";
			document.getElementById("nav_span3").className = "nav_span";
			filter_function();
		} else {
		//add.innerHTML == "取消" or "返回";
			add.innerHTML = "入住";
			add.style.color = "initial";
			document.getElementById("nav_span1").className = "nav_span";
			document.getElementById("nav_span2").className = "nav_span_static";
			document.getElementById("nav_span3").className = "nav_span";
			filter_function();
		}
	} else {
	//click person table 'settle' panel
			if (itself.parentNode.parentNode.getElementsByClassName("person_table_person_preleave_date")[0].innerHTML == "" || itself.parentNode.parentNode.getElementsByClassName("person_table_person_preleave_time")[0].innerHTML == "" || itself.parentNode.parentNode.getElementsByClassName("person_table_person_preleave_confirm")[0].innerHTML == "") {
				alert("！請先填寫預離日期信息\n\n入住失效");
				return;
			}
		document.getElementById("nav_span1").className = "nav_span";
		document.getElementById("nav_span2").className = "nav_span_static";
		document.getElementById("nav_span3").className = "nav_span";
		if (add.innerHTML == "入住") {
		//settle a person and then selecte the room 
			add.innerHTML = "返回";
			add.style.color = "#2a0";
			itself.innerHTML = "&uarr;";
			itself.className = "person_settle_button_up";
		} else if (add.innerHTML == "返回") {
			alert("！已經選擇一人");
			return
		} else {
		//settle a person into the selected room
			var filter_room_class = document.getElementsByClassName("room_selected");
			var filter_house_class = document.getElementsByClassName("house_list_down");
			if (filter_room_class.length == 0 || filter_house_class.length == 0) {
				alert("！請選擇房間\n\n入住失效");
				return;
			}
			var filter_room = filter_room_class[0];
			var filter_house = filter_house_class[0];
			var filter_room_name = filter_room.getElementsByClassName("room_name")[0];
			var filter_house_name = filter_house.getElementsByClassName("house_list_in")[0];
			//justics if the leave date is filled
			if (itself.parentNode.parentNode.getElementsByClassName("person_table_person_preleave_date")[0].innerHTML == "" || itself.parentNode.parentNode.getElementsByClassName("person_table_person_preleave_time")[0].innerHTML == "" || itself.parentNode.parentNode.getElementsByClassName("person_table_person_preleave_confirm")[0].innerHTML == "") {
				alert("！請先填寫預離日期信息\n\n入住失效");
				add.innerHTML = "入住";
				add.style.color = "initial";
				house_selected(filter_house.id, filter_room.id);
				return;
			}
			var settle_url = "php_person/person_settle.php";
			settle_url += "?settle_person_ID=" + String(settle_person_ID);
			settle_url += "&settle_house=" + encodeURI(filter_house_name.innerHTML);
			settle_url += "&settle_room=" + encodeURI(filter_room_name.innerHTML);
		
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			    	hint.innerHTML = xmlhttp.responseText;
					add.innerHTML = "入住";
					add.style.color = "initial";
					house_selected(filter_house.id, filter_room.id);
			    }
			}
			xmlhttp.open("GET", settle_url, true);
			xmlhttp.send();
		}
	}
}

function switch_person_arrive() {
	read_attribute_form();
	person_arrive_date.value = "";
	person_arrive_time.value = "";
	person_prearrive_span.style.display = "initial";
	person_prearrive_arrow.style.display = "initial";
	person_prearrive_date.style.display = "initial";
	person_prearrive_time.style.display = "initial";
	person_prearrive_confirm.style.display = "initial";
	person_arrive_span.style.display = "none";
	person_arrive_arrow.style.display = "none";
	person_arrive_date.style.display = "none";
	person_arrive_time.style.display = "none";
	switch_person_arrive_button.style.display = "none";
}

function more_attribute(itself) {
	var extend_infor = document.getElementById("extend_infor");
	var person_ID = document.getElementById("person_ID");
	var person_history_div = document.getElementById("person_history_div");
	if(itself.value == '更多>>>') {
		itself.value = '收回<<<';

		//alert(person_ID.value);
		var history_str = "php_board/history_board.php";
		//var history_str = "php_person/read_history.php";
		history_str += "?filter_ID=" + person_ID.value;

		var history_xml = new XMLHttpRequest();
		history_xml.onreadystatechange = function() {
			if (history_xml.readyState == 4 && history_xml.status == 200) {
				person_history_div.innerHTML = history_xml.responseText;
				extend_infor.style.display = "inline-block";
			}
		}
		history_xml.open("GET", history_str, true);
		history_xml.send();
	} else {
		itself.value = '更多>>>';
		extend_infor.style.display = "none";
	}
}

function delete_attribute() {
	alert("！目前不提供此功能\n\n如有需要請聯繫ejsoon@126.com");
}

function update_person() {
	read_attribute_form();
	if (person_x.checked && !confirm("！標記爲乂,禁止入住\n\n仍然繼續???")) {
		return;
	}
	//if (person_credit = document.getElementById("person_credit");
	if (person_house.value != "" && person_room.value == "" || person_house.value == "" && person_room.value != "") {
		alert("！住房信息請填寫完整");
		return;
	}
	if (person_house.value != "" && person_room.value != "" && (person_preleave_date.value == "" || person_preleave_time.value == "" || person_preleave_confirm.value == "")) {
		alert("！預離日期信息請填寫完整");
		return;
	}
	var write_person_url = "";
	write_person_url += "person_ID=" + encodeURI(person_ID.value);
	write_person_url += "&person_credit=" + encodeURI(person_credit.value);
	write_person_url += "&person_name=" + encodeURI(person_name.value);
	write_person_url += "&person_name=" + encodeURI(person_name.value);
	write_person_url += "&person_sexuality=" + encodeURI(person_sexuality.value);
	write_person_url += "&person_birth=" + encodeURI(person_birth.value);
	write_person_url += "&person_phone=" + encodeURI(person_phone.value);
	write_person_url += "&person_house=" + encodeURI(person_house.value);
	write_person_url += "&person_room=" + encodeURI(person_room.value);
	write_person_url += "&person_type=" + encodeURI(person_type.value);
	write_person_url += "&person_group=" + encodeURI(person_group.value);
	write_person_url += "&person_dharma=" + encodeURI(person_dharma.value);
	write_person_url += "&person_degree=" + encodeURI(person_degree.value);
	write_person_url += "&person_identity=" + encodeURI(person_identity.value);
	write_person_url += "&person_identity_address=" + encodeURI(person_identity_address.value);
	write_person_url += "&person_current_address=" + encodeURI(person_current_address.value);
	write_person_url += "&person_x=" + (person_x.checked ? "1" : "0");
	write_person_url += "&person_remarks=" + encodeURI(person_remarks.value);

	write_person_url += "&person_prearrive_date=" + encodeURI(person_prearrive_date.value);
	write_person_url += "&person_prearrive_time=" + encodeURI(person_prearrive_time.value);
	write_person_url += "&person_prearrive_confirm=" + encodeURI(person_prearrive_confirm.value);
	write_person_url += "&person_arrive_date=" + encodeURI(person_arrive_date.value);
	write_person_url += "&person_arrive_time=" + encodeURI(person_arrive_time.value);
	write_person_url += "&person_preleave_date=" + encodeURI(person_preleave_date.value);
	write_person_url += "&person_preleave_time=" + encodeURI(person_preleave_time.value);
	write_person_url += "&person_preleave_confirm=" + encodeURI(person_preleave_confirm.value);
/*
	write_person_url += "&person_leave_date=" + encodeURI(person_leave_date.value);
	write_person_url += "&person_leave_time=" + encodeURI(person_leave_time.value);
*/

	write_person_url += "&person_healthy=" + encodeURI(person_healthy.value);
	write_person_url += "&person_marriage=" + encodeURI(person_marriage.value);
	write_person_url += "&person_email=" + encodeURI(person_email.value);
	write_person_url += "&person_QQ=" + encodeURI(person_QQ.value);
	write_person_url += "&person_emergency_person=" + encodeURI(person_emergency_person.value);
	write_person_url += "&person_emergency_relationship=" + encodeURI(person_emergency_relationship.value);
	write_person_url += "&person_emergency_contact=" + encodeURI(person_emergency_contact.value);
	write_person_url += "&person_employer=" + encodeURI(person_employer.value);
	write_person_url += "&person_job=" + encodeURI(person_job.value);
	write_person_url += "&person_work_experience=" + encodeURI(person_work_experience.value);
	write_person_url += "&person_specialty_features=" + encodeURI(person_specialty_features.value);

	write_person_url += "&person_volunteer_obey=" + encodeURI(person_volunteer_obey.value);
	write_person_url += "&person_volunteer_advise=" + encodeURI(person_volunteer_advise.value);
	write_person_url += "&person_volunteer_reason=" + encodeURI(person_volunteer_reason.value);
	//alert(write_person_url);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

			pop_win.style.display = "none";
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
	        hint.innerHTML = xmlhttp.responseText;
	    }
	}
	xmlhttp.open("POST","php_person/update_person.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(write_person_url);
}

