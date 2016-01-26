<?php
//adjust and echo drop message, control by js:view_message()
include_once "../header.php";

try {
	include "../connect_db.php";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//if some one unconfirm till today or tomorrow
	$sql_execution = "SELECT * FROM person_main";
	$sql_execution .= " WHERE DATEDIFF(person_arrive_date,'" . date('Y-m-d') . "') <= 0";
	$sql_execution .= " AND DATEDIFF(person_preleave_date,'" . date('Y-m-d') . "') <= 1";
	$sql_execution .= " AND DATEDIFF(person_preleave_date,'" . date('Y-m-d') . "') >= 0";
	$sql_execution .= " AND person_preleave_confirm <> '十分確定'";

	$stmt = $conn->prepare($sql_execution);
	$stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$not_confirm = $stmt->fetchAll();

	//if some one don't leave after date
	$sql_execution = "SELECT * FROM person_main";
	$sql_execution .= " WHERE DATEDIFF(person_arrive_date,'" . date('Y-m-d') . "') <= 0";
	$sql_execution .= " AND (DATEDIFF(person_preleave_date,'" . date('Y-m-d') . "') < 0";
	if (intval(date(H)) >= 18) {
		$sql_execution .= " OR DATEDIFF(person_preleave_date,'" . date('Y-m-d') . "') = 0";
	}
	$sql_execution .= ")";

	$stmt = $conn->prepare($sql_execution);
	$stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$not_leave = $stmt->fetchAll();

	$sum_count = count($not_leave) + count($not_confirm);
	echo "<div id='msg_sum'>$sum_count</div>";

	if(count($not_confirm)) {
		$count_not_confirm = count($not_confirm);
		$t_not_confirm = $count_not_confirm . "須確定";
		echo "<div class='drop_space'></div>";
		echo "<div id='drop_not_confirm' class='drop_item' onclick='view_not_confirm()'>$t_not_confirm</div>";
	}

	if (count($not_leave)) {
		$count_not_leave = count($not_leave);
		$t_not_leave = $count_not_leave . "未離開";
		echo "<div class='drop_space'></div>";
		echo "<div id='drop_not_leave' class='drop_item' onclick='view_not_leave()'>$t_not_leave</div>";
	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>
