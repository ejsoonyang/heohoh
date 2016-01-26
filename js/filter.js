function filter_function() {
	var add = document.getElementById("add");
	if (add.innerHTML == "返回") {
		return;
	}
	var person = document.getElementById("person");
	var filter_name = document.getElementById("filter_name");
	var filter_dharma = document.getElementById("filter_dharma");
	var filter_identity = document.getElementById("filter_identity");
	var filter_type = document.getElementById("filter_type");
	var filter_group = document.getElementById("filter_group");
	var filter_sexuality = document.getElementById("filter_sexuality");
	
	var filter_state = document.getElementsByClassName("nav_span_static")[0];
	var filter_house_class = document.getElementsByClassName("house_list_down");
	var filter_room_class = document.getElementsByClassName("room_selected");

	var filterURL = "php_board/person_board.php?read_type=filter_read";
	if ("" != filter_name.value) {
		filterURL += "&filter_name=" + encodeURI(filter_name.value);
	}
	if ("" != filter_dharma.value) {
		filterURL += "&filter_dharma=" + encodeURI(filter_dharma.value);
	}
	if ("" != filter_identity.value) {
		filterURL += "&filter_identity=" + encodeURI(filter_identity.value);
	} 
	if ("" != filter_type.value) {
		filterURL += "&filter_type=" + encodeURI(filter_type.value);
	} 
	if ("" != filter_group.value) {
		filterURL += "&filter_group=" + encodeURI(filter_group.value);
	} 
	if ("" != filter_sexuality.value) {
		filterURL += "&filter_sexuality=" + encodeURI(filter_sexuality.value);
	} 
	if ("" != filter_state.innerHTML) {
		filterURL += "&filter_state=" + encodeURI(filter_state.innerHTML);
	}
	if (filter_house_class.length == 1) {
		var filter_house = filter_house_class[0].getElementsByClassName("house_list_in")[0];
		if (add.innerHTML == "入住") {
			filterURL += "&filter_house=" + encodeURI(filter_house.innerHTML);
		}
	}
	if (filter_room_class.length == 1) {
		var filter_room = filter_room_class[0].getElementsByClassName("room_name")[0];
		if (add.innerHTML == "入住") {
			filterURL += "&filter_room=" + encodeURI(filter_room.innerHTML);
		}
	}

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	        person.innerHTML = xmlhttp.responseText;
			view_message();
			view_picture();
	        var person_tr = document.getElementsByClassName("person_tr");
	        var which_arrange = document.getElementById("which_arrange");
	        var which_house = document.getElementById("which_house");
	        var which_room = document.getElementById("which_room");
	        var which_count = document.getElementById("which_count");
			if (filter_room_class.length == 1) {
				which_arrange.innerHTML = "";
				which_house.innerHTML = filter_house.innerHTML;
				which_room.innerHTML = filter_room.innerHTML;
				document.getElementById("its_info").innerHTML = "";

	    	} else if (filter_house_class.length == 1) {
				which_arrange.innerHTML = "";
				which_house.innerHTML = filter_house.innerHTML;
				which_room.innerHTML = "";
				var room_area = document.getElementById("room_area");
				var room_class = room_area.getElementsByClassName("room");
				var room_row = room_area.getElementsByClassName("clear_float");
				document.getElementById("its_info").innerHTML = room_row.length;
				document.getElementById("its_info").innerHTML += "層<br>";
				document.getElementById("its_info").innerHTML += room_class.length;
				document.getElementById("its_info").innerHTML += "間房";
	    	} else if ("" != filter_state.innerHTML) {
				which_arrange.innerHTML = filter_state.innerHTML;
				which_house.innerHTML = "";
				which_room.innerHTML = "";
				its_info.innerHTML = "";
	    	}
	        which_count.innerHTML = person_tr.length;
	    }
	}
	xmlhttp.open("GET", filterURL, true);
	xmlhttp.send();
}
