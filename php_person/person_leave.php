<?php
include_once "../header.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$leave_person_ID = intval(test_input($_GET["leave_person_ID"]));
try {
	include "../connect_db.php";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$leave_date = date("Y-m-d");
	$leave_time = date("H:i:s");

    $leave_person_sql = "UPDATE person_main SET person_leave_date='$leave_date',person_leave_time='$leave_time' WHERE person_ID='$leave_person_ID';";
    $conn->exec($leave_person_sql);

    $leave_person_sql = "INSERT INTO person_history (person_ID,person_house,person_room,person_type,person_group,person_prearrive_date,person_prearrive_time,person_prearrive_confirm,person_arrive_date,person_arrive_time,person_preleave_date,person_preleave_time,person_preleave_confirm,person_leave_date,person_leave_time,person_break_start_date,person_break_start_time,person_break_end_date,person_break_end_time)
	SELECT person_ID,person_house,person_room,person_type,person_group,person_prearrive_date,person_prearrive_time,person_prearrive_confirm,person_arrive_date,person_arrive_time,person_preleave_date,person_preleave_time,person_preleave_confirm,person_leave_date,person_leave_time,person_break_start_date,person_break_start_time,person_break_end_date,person_break_end_time FROM person_main WHERE person_ID='$leave_person_ID';";

    $conn->exec($leave_person_sql);

/*
	//calculate the credit
	$filter_ID = $leave_person_ID;
	require "read_person.php";

	//calculate the credit
	require "../header.php";
*/

    $leave_person_sql = "UPDATE person_main SET person_house='',person_room='',person_prearrive_date='',person_prearrive_time='',person_prearrive_confirm='',person_arrive_date='',person_arrive_time='',person_preleave_date='',person_preleave_time='',person_preleave_confirm='',person_leave_date='',person_leave_time='',person_break_start_date='',person_break_start_time='',person_break_end_date='',person_break_end_time='' WHERE person_ID='$leave_person_ID'";
    $conn->exec($leave_person_sql);

    $sql_execution = "SELECT person_name FROM person_main WHERE person_ID='$leave_person_ID'";

    $stmt = $conn->prepare($sql_execution);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$leave_person = $stmt->fetchAll();

	$login_name = $_SESSION["login_name"];
	$login_permission = $_SESSION["login_permission"];

    echo $leave_person[0]['person_name'];
	echo "已離開  [操作:$login_permission-$login_name $leave_date $leave_time]";

    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}

?>
