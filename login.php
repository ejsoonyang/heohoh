<?php
session_start();
try {
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$user_name = $_POST["user_name"];
		$user_password = $_POST["user_password"];
	
		$servername = "localhost"; $username = "root"; $password = ""; $dbname = "wuhehe";

	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	    $sql_execution = "SELECT person_permission,person_name FROM person_main WHERE person_name = '$user_name' AND person_password = '$user_password'";
	
	    $stmt = $conn->prepare($sql_execution);
	    $stmt->execute();
	
	    // set the resulting array to associative
	    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$login_array = $stmt->fetchAll();
		if (count($login_array)) {
			$_SESSION["login_permission"] = $login_array[0]["person_permission"];
			$_SESSION["login_name"] = $login_array[0]["person_name"];
			$login_info = "！登錄成功";
			$refresh = "<meta http-equiv='refresh' content='1; url=index.php'/>";
		} else {
			$login_info = "！用戶名或密碼不正確";
			$refresh = "";
		}
	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>登錄</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<?php
	echo $refresh;
?>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
		<link rel="stylesheet" type="text/css" href="css/login.css"/>
	</head>
	<body>
		<div class="vertical_middle"></div>
		<form id="login_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<span id="login_title">香海禪寺住房管理系統-登錄</span>
			<br> <br> <br> <br>
			<div class="float_div">
			<span id="login_span">用戶 </span><input type="input" name="user_name" id="user_name" autofocus><br><br><span id="login_span">密碼 </span><input type="password" name="user_password" id="user_password">
			</div>
			<input type="submit" id="login_submit" value="確定">
			<div class="clear_float"></div>
			<br> <br>
			<span id="login_info"><?php echo $login_info?></span>
		</form>
	</body>
</html>
