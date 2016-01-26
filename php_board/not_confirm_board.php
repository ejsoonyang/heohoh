<?php
include_once "../header.php";

try {
	include "../connect_db.php";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//if some one unconfirm till today or tomorrow
	$sql_execution = "SELECT person_name, person_phone, person_house, person_room, person_type, person_group, person_arrive_date, person_arrive_time, person_preleave_date, person_preleave_time, person_preleave_confirm FROM person_main";
	$sql_execution .= " WHERE DATEDIFF(person_arrive_date,'" . date('Y-m-d') . "') <= 0";
	$sql_execution .= " AND DATEDIFF(person_preleave_date,'" . date('Y-m-d') . "') <= 1";
	$sql_execution .= " AND DATEDIFF(person_preleave_date,'" . date('Y-m-d') . "') >= 0";
	$sql_execution .= " AND person_preleave_confirm <> '十分確定'";

	$stmt = $conn->prepare($sql_execution);
	$stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$not_confirm = $stmt->fetchAll();

	echo "<div><span id='pop_title'>　將過期未確定 名單　</span><span id='pop_close' onclick='close_pop_win()'>close</span></div>\n";
	echo "<table id='not_table'>";
	echo "<tr>";
	echo "<th>姓名</th><th>手機號碼</th><th>樓名</th><th>房號</th><th>類別</th><th>分組</th><th>到達日期</th><th>-</th><th>預離日期</th><th>-</th><th>確認程度</th>";
	echo "</tr>";
	for ($x = 0; $x < count($not_confirm); $x++) {
		echo "<tr>";
		foreach ($not_confirm[$x] as $y => $z) {
			echo "<td>";
			echo $z;
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>
