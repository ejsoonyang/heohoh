<?php
include_once "../header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$person_ID = intval(test_input($_POST["person_ID"]));
	$person_credit = intval(test_input($_POST["person_credit"]));
	$person_name = test_input($_POST["person_name"]);
	$person_dharma = test_input($_POST["person_dharma"]);
	$person_sexuality = test_input($_POST["person_sexuality"]);
	$person_birth = test_input($_POST["person_birth"]);
	$person_degree = test_input($_POST["person_degree"]);
	$person_phone = test_input($_POST["person_phone"]);
	$person_identity = test_input($_POST["person_identity"]);
	$person_identity_address = test_input($_POST["person_identity_address"]);
	$person_current_address = test_input($_POST["person_current_address"]);
	$person_x = test_input($_POST["person_x"]);
	$person_remarks = test_input($_POST["person_remarks"]);

	$person_house = test_input($_POST["person_house"]);
	$person_room = test_input($_POST["person_room"]);

	$person_type = test_input($_POST["person_type"]);
	$person_group = test_input($_POST["person_group"]);

	$person_prearrive_date = test_input($_POST["person_prearrive_date"]);
	$person_prearrive_time = test_input($_POST["person_prearrive_time"]);
	$person_prearrive_confirm = test_input($_POST["person_prearrive_confirm"]);
	$person_arrive_date = test_input($_POST["person_arrive_date"]);
	$person_arrive_time = test_input($_POST["person_arrive_time"]);

	$person_preleave_date = test_input($_POST["person_preleave_date"]);
	$person_preleave_time = test_input($_POST["person_preleave_time"]);
	$person_preleave_confirm = test_input($_POST["person_preleave_confirm"]);
/*
	$person_leave_date = test_input($_POST["person_leave_date"]);
	$person_leave_time = test_input($_POST["person_leave_time"]);

	$person_break_start_date = test_input($_POST["person_break_start_date"]);
	$person_break_start_time = test_input($_POST["person_break_start_time"]);
	$person_break_end_date = test_input($_POST["person_break_end_date"]);
	$person_break_end_time = test_input($_POST["person_break_end_time"]);
*/

	$person_healthy = test_input($_POST["person_healthy"]);
	$person_marriage = test_input($_POST["person_marriage"]);
	$person_email = test_input($_POST["person_email"]);
	$person_QQ = test_input($_POST["person_QQ"]);
	$person_emergency_person = test_input($_POST["person_emergency_person"]);
	$person_emergency_relationship = test_input($_POST["person_emergency_relationship"]);
	$person_emergency_contact = test_input($_POST["person_emergency_contact"]);
	$person_employer = test_input($_POST["person_employer"]);
	$person_job = test_input($_POST["person_job"]);
	$person_work_experience = test_input($_POST["person_work_experience"]);
	$person_specialty_features = test_input($_POST["person_specialty_features"]);

	$person_volunteer_obey = test_input($_POST["person_volunteer_obey"]);
	$person_volunteer_advise = test_input($_POST["person_volunteer_advise"]);
	$person_volunteer_reason = test_input($_POST["person_volunteer_reason"]);

try {
	include "../connect_db.php";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $write_person_sql = "";
    if (0 == $person_ID) {
    //add a new person
    	$write_person_sql = "INSERT INTO person_main (person_credit,person_name,person_dharma,person_sexuality,person_birth,person_degree,person_phone,person_identity,person_identity_address,person_current_address,person_x,person_remarks,person_house,person_room,person_type,person_group,person_prearrive_date,person_prearrive_time,person_prearrive_confirm,person_arrive_date,person_arrive_time,person_preleave_date,person_preleave_time,person_preleave_confirm,person_leave_date,person_leave_time,person_break_start_date,person_break_start_time,person_break_end_date,person_break_end_time,person_healthy,person_marriage,person_email,person_QQ,person_emergency_person,person_emergency_relationship,person_emergency_contact,person_employer,person_job,person_work_experience,person_specialty_features,person_volunteer_obey,person_volunteer_advise,person_volunteer_reason)
    VALUES ('$person_credit','$person_name','$person_dharma','$person_sexuality','$person_birth','$person_degree','$person_phone','$person_identity','$person_identity_address','$person_current_address','$person_x','$person_remarks','$person_house','$person_room','$person_type','$person_group','$person_prearrive_date','$person_prearrive_time','$person_prearrive_confirm','$person_arrive_date','$person_arrive_time','$person_preleave_date','$person_preleave_time','$person_preleave_confirm','$person_leave_date','$person_leave_time','$person_break_start_date','$person_break_start_time','$person_break_end_date','$person_break_end_time','$person_healthy','$person_marriage','$person_email','$person_QQ','$person_emergency_person','$person_emergency_relationship','$person_emergency_contact','$person_employer','$person_job','$person_work_experience','$person_specialty_features','$person_volunteer_obey','$person_volunteer_advise','$person_volunteer_reason');";
    $conn->exec($write_person_sql);

	$login_name = $_SESSION["login_name"];
	$login_permission = $_SESSION["login_permission"];
	$manage_date = date("Y-m-d");
	$manage_time = date("H:i:s");
    echo "新人: ";
    echo $person_name;
	echo " 添加成功!";
	echo "  [操作:$login_permission-$login_name $manage_date $manage_time]";
    } else {
    // update a person
    	$write_person_sql = "UPDATE person_main SET person_credit='$person_credit',person_name='$person_name',person_dharma='$person_dharma',person_sexuality='$person_sexuality',person_birth='$person_birth',person_degree='$person_degree',person_phone='$person_phone',person_identity='$person_identity',person_identity_address='$person_identity_address',person_current_address='$person_current_address',person_x='$person_x',person_remarks='$person_remarks',person_house='$person_house',person_room='$person_room',person_type='$person_type',person_group='$person_group',person_prearrive_date='$person_prearrive_date',person_prearrive_time='$person_prearrive_time',person_prearrive_confirm='$person_prearrive_confirm',person_arrive_date='$person_arrive_date',person_arrive_time='$person_arrive_time',person_preleave_date='$person_preleave_date',person_preleave_time='$person_preleave_time',person_preleave_confirm='$person_preleave_confirm',person_leave_date='$person_leave_date',person_leave_time='$person_leave_time',person_break_start_date='$person_break_start_date',person_break_start_time='$person_break_start_time',person_break_end_date='$person_break_end_date',person_break_end_time='$person_break_end_time',person_healthy='$person_healthy',person_marriage='$person_marriage',person_email='$person_email',person_QQ='$person_QQ',person_emergency_person='$person_emergency_person',person_emergency_relationship='$person_emergency_relationship',person_emergency_contact='$person_emergency_contact',person_employer='$person_employer',person_job='$person_job',person_work_experience='$person_work_experience',person_specialty_features='$person_specialty_features',person_volunteer_obey='$person_volunteer_obey',person_volunteer_advise='$person_volunteer_advise',person_volunteer_reason='$person_volunteer_reason' WHERE person_ID='$person_ID';";
    $conn->exec($write_person_sql);

	$login_name = $_SESSION["login_name"];
	$login_permission = $_SESSION["login_permission"];
	$manage_date = date("Y-m-d");
	$manage_time = date("H:i:s");
    echo $person_name;
    echo " 信息更新成功!";
	echo "  [操作:$login_permission-$login_name $manage_date $manage_time]";
    }

    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}

?>
