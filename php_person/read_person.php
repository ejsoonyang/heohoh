<?php
//use the given filter_value to return $person_array
include_once "../header.php";

//use read_type to judge if js or php execute this program
$read_type = test_input($_REQUEST["read_type"]);

if ("filter_read" == $read_type) {
//filter.js read the information

	$filter_ID = test_input($_REQUEST["filter_ID"]);
	$filter_name = test_input($_REQUEST["filter_name"]);
	$filter_dharma = test_input($_REQUEST["filter_dharma"]);
	$filter_identity = test_input($_REQUEST["filter_identity"]);
	$filter_type = test_input($_REQUEST["filter_type"]);
	$filter_group = test_input($_REQUEST["filter_group"]);
	$filter_sexuality = test_input($_REQUEST["filter_sexuality"]);
	$filter_date = test_input($_REQUEST["filter_date"]);
	$filter_time = test_input($_REQUEST["filter_time"]);

	$filter_state = test_input($_REQUEST["filter_state"]);
	$filter_house = test_input($_REQUEST["filter_house"]);
	$filter_room = test_input($_REQUEST["filter_room"]);
}

//person filter
try {
	include "../connect_db.php";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_execution = "SELECT person_ID,person_credit,person_name,person_sexuality,person_birth,person_phone,person_house,person_room,person_type,person_group,person_dharma,person_degree,person_identity,person_identity_address,person_current_address,person_x,person_remarks,person_prearrive_date,person_prearrive_time,person_prearrive_confirm,person_arrive_date,person_arrive_time,person_preleave_date,person_preleave_time,person_preleave_confirm,person_leave_date,person_leave_time,person_break_start_date,person_break_start_time,person_break_end_date,person_break_end_time,person_healthy,person_marriage,person_email,person_QQ,person_emergency_person,person_emergency_relationship,person_emergency_contact,person_employer,person_job,person_work_experience,person_specialty_features,person_volunteer_obey,person_volunteer_advise,person_volunteer_reason FROM person_main";

	//filter function
	$sql_length = strlen($sql_execution);
	if ("" != $filter_name) {
		$sql_execution .= " WHERE person_name = '".$filter_name."'";
	}
	if ("" != $filter_dharma) {
		if ($sql_length == strlen($sql_execution)) {
			$sql_execution .= " WHERE person_dharma = '".$filter_dharma."'";
		} else {
			$sql_execution .= " AND person_dharma = '".$filter_dharma."'";
		}
	}
	if ("" != $filter_identity) {
		if ($sql_length == strlen($sql_execution)) {
			$sql_execution .= " WHERE person_identity LIKE '%".$filter_identity."'";
		} else {
			$sql_execution .= " AND person_identity LIKE '%".$filter_identity."'";
		}
	}
	if ("" != $filter_type) {
		if ($sql_length == strlen($sql_execution)) {
			$sql_execution .= " WHERE person_type = '".$filter_type."'";
		} else {
			$sql_execution .= " AND person_type = '".$filter_type."'";
		}
		if ("" != $filter_group) {
			$sql_execution .= " AND person_group = '".$filter_group."'";
		}
	}
	if ("" != $filter_sexuality) {
		if ($sql_length == strlen($sql_execution)) {
			$sql_execution .= " WHERE person_sexuality = '".$filter_sexuality."'";
		} else {
			$sql_execution .= " AND person_sexuality = '".$filter_sexuality."'";
		}
	}
	if ("[全部]" != $filter_state) {
		if ($sql_length == strlen($sql_execution)) {
			if ("[已住]" == $filter_state) {
				$sql_execution .= " WHERE (person_house <> '' AND person_room <> '')";
			} else if ("[未住]" == $filter_state) {
				$sql_execution .= " WHERE (person_house = '' AND person_room = '')";
			}
		} else {
			if ("[已住]" == $filter_state) {
				$sql_execution .= " AND (person_house <> '' AND person_room <> '')";
			} else if ("[未住]" == $filter_state) {
				$sql_execution .= " AND (person_house = '' AND person_room = '')";
			}
		}
	}
	if ("" != $filter_house) {
		if ($sql_length == strlen($sql_execution)) {
			$sql_execution .= " WHERE person_house = '".$filter_house."'";
		} else {
			$sql_execution .= " AND person_house = '".$filter_house."'";
		}
	}
	if ("" != $filter_room) {
		if ($sql_length == strlen($sql_execution)) {
			$sql_execution .= " WHERE person_room = '".$filter_room."'";
		} else {
			$sql_execution .= " AND person_room = '".$filter_room."'";
		}
	}
/*
	if ("" != $filter_date) {
		if ($sql_length == strlen($sql_execution)) {
			$sql_execution .= " WHERE (DATEDIFF(person_arrive_date,'".$filter_date."') < 0";
		} else {
			$sql_execution .= " AND (DATEDIFF(person_arrive_date,'".$filter_date."') < 0";
		}
		if ("" != $filter_time) {
			$sql_execution .= " OR (DATEDIFF(person_arrive_date,'".$filter_date."') = 0 AND person_arrive_time <= '".$filter_time."')";
		} else {
			$sql_execution .= " OR DATEDIFF(person_arrive_date,'".$filter_date."') = 0";
		}
		$sql_execution .= ")";
	}
*/
    $stmt = $conn->prepare($sql_execution);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$person_array = $stmt->fetchAll();

	//sort person_array
	if ("filter_read" == $read_type) {
		usort($person_array, "sort_filter_read");
	} else if ("all_person" == $read_type) {
		usort($person_array, "sort_all_person");
	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>
