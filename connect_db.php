<?php
//check if user is ligal
session_start();
if ("" == $_SESSION["login_name"]) {
	echo "<!DOCTYPE html>";
	echo "<html lang='en'>";
	echo "	<head>";
	echo "		<title>香海禪寺住房信息管理系統</title>";
	echo "		<meta http-equiv='Content-Type' content='text/html;charset=utf-8'/>";
	echo "		<meta http-equiv='refresh' content='3; url=login.php'/>";
	echo "	</head>";
	echo "	<body>";
	echo "！請登錄";
	echo "<br>";
	echo "<br>";
	echo "<a href='login.php'>點擊此處跳轉</a>";
	echo "	</body>";
	echo "</html>";
	die();
}

$servername = "localhost"; $username = "root"; $password = ""; $dbname = "wuhehe";
?>
