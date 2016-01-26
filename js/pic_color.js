//var pic_color_hidden = document.getElementsByClassName("pic_color_hidden");
//var room_type_form = document.getElementsByClassName("room_type_form");

var pic_color_R_col = [];//col div
var pic_color_G_col = [];//col div
var pic_color_B_col = [];//col div

var color_index = 0;
var color_string = "";
var color_calculate = "";

function open_pic_color(target) {
	var pic_color_R_col_selected = document.getElementsByClassName("pic_color_R_col_selected");
	var pic_color_G_col_selected = document.getElementsByClassName("pic_color_G_col_selected");
	var pic_color_B_col_selected = document.getElementsByClassName("pic_color_B_col_selected");
	if (pic_color_R_col_selected.length == 1) {
		pic_color_R_col_selected[0].className = "pic_color_R_col";
	}
	if (pic_color_G_col_selected.length == 1) {
		pic_color_G_col_selected[0].className = "pic_color_G_col";
	}
	if (pic_color_B_col_selected.length == 1) {
		pic_color_B_col_selected[0].className = "pic_color_B_col";
	}

	var pic_color_outer = document.getElementsByClassName("pic_color_outer");
	if (pic_color_outer[parseInt(target.id.substr(16))].style.display != "block") {
		for (var o_index = 0; o_index < pic_color_outer.length; o_index++) {
			if(parseInt(target.id.substr(16)) != o_index) {
				pic_color_outer[o_index].style.display = "none";
			} else {
				var pic_color_hidden = document.getElementsByClassName("pic_color_hidden");
				var R_num = parseInt(pic_color_hidden[parseInt(target.id.substr(16))].value.split(",")[0].replace("rgb(", ""));
				var G_num = parseInt(pic_color_hidden[parseInt(target.id.substr(16))].value.split(",")[1]);
				var B_num = parseInt(pic_color_hidden[parseInt(target.id.substr(16))].value.split(",")[2].replace(")", ""));
				if (R_num > 0) {
					var R_num = R_num / 17 - 1;
					//var R_num = (R_num + 1) / 16 - 1;
					target.parentNode.getElementsByClassName("pic_color_outer")[0].getElementsByClassName("pic_color")[0].getElementsByClassName("pic_color_R")[0].getElementsByClassName("pic_color_R_col")[R_num].className = "pic_color_R_col_selected";
				}
				if (G_num > 0) {
					var G_num = G_num / 17 - 1;
					//var G_num = (G_num + 1) / 16 - 1;
					target.parentNode.getElementsByClassName("pic_color_outer")[0].getElementsByClassName("pic_color")[0].getElementsByClassName("pic_color_G")[0].getElementsByClassName("pic_color_G_col")[G_num].className = "pic_color_G_col_selected";
				}
				if (B_num > 0) {
					var B_num = B_num / 17 - 1;
					//var B_num = (B_num + 1) / 16 - 1;
					target.parentNode.getElementsByClassName("pic_color_outer")[0].getElementsByClassName("pic_color")[0].getElementsByClassName("pic_color_B")[0].getElementsByClassName("pic_color_B_col")[B_num].className = "pic_color_B_col_selected";
				}
			}
		}
		pic_color_outer[parseInt(target.id.substr(16))].style.display = "block";
	} else {
		pic_color_outer[parseInt(target.id.substr(16))].style.display = "none";
	}
}

function set_form_color(form_class_name, target) {
	var form_class = document.getElementsByClassName(form_class_name);
	var pic_color_hidden = document.getElementsByClassName("pic_color_hidden");
	var color = pic_color_hidden[target].value;
	form_class[target].style.backgroundColor = color;
}

function set_all_form_color(form_class_name) {
	var form_array = document.getElementsByClassName(form_class_name);
	for (var loop_index = 0; loop_index < form_array.length; loop_index++) {
		set_form_color(form_class_name, loop_index);
	}
}

function color_panel(target) {
	var col_normal = target.id.substr(0, 15);
	var col_selected = document.getElementsByClassName(col_normal + "_selected");
	if (col_normal + "_selected" == target.className) {
		target.className = col_normal;
	} else {
		if (col_selected.length == 1) {
			col_selected[0].className = col_normal;
		}
		target.className = col_normal + "_selected";
	}
	//calculate the hidden color value
	var hidden_color_str = "rgb(";
	var pic_color_R_col_selected = document.getElementsByClassName("pic_color_R_col_selected");
	var pic_color_G_col_selected = document.getElementsByClassName("pic_color_G_col_selected");
	var pic_color_B_col_selected = document.getElementsByClassName("pic_color_B_col_selected");
	if (pic_color_R_col_selected.length > 0) {
		hidden_color_str += String(parseInt(pic_color_R_col_selected[0].id.substr(15)) * 17);
		//hidden_color_str += String((parseInt(pic_color_R_col_selected[0].id.substr(15)) + 1) * 16 - 1);
		hidden_color_str += ",";
	} else {
		hidden_color_str += "0,";
	}
	if (pic_color_G_col_selected.length > 0) {
		hidden_color_str += String(parseInt(pic_color_G_col_selected[0].id.substr(15)) * 17);
		//hidden_color_str += String((parseInt(pic_color_G_col_selected[0].id.substr(15)) + 1) * 16 - 1);
		hidden_color_str += ",";
	} else {
		hidden_color_str += "0,";
	}
	if (pic_color_B_col_selected.length > 0) {
		hidden_color_str += String(parseInt(pic_color_B_col_selected[0].id.substr(15)) * 17);
		//hidden_color_str += String((parseInt(pic_color_B_col_selected[0].id.substr(15)) + 1) * 16 - 1);
		hidden_color_str += ")";
	} else {
		hidden_color_str += "0)";
	}
	var pic_color_hidden = target.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByClassName("pic_color_hidden");
	pic_color_hidden[0].value = hidden_color_str;
	set_form_color(target.parentNode.parentNode.parentNode.parentNode.parentNode.className, target.parentNode.parentNode.parentNode.id.substr(15));
}
