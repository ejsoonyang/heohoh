<?php
//set manager's permission by super manager
include_once "../header.php";

$login_name = $_SESSION["login_name"];
$login_permission = $_SESSION["login_permission"];
if ($login_permission != "超級管理員") {
	die("！超級管理員才有權限");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$pms_type = test_input($_POST["pms_type"]);
	$pms_name = test_input($_POST["pms_name"]);
	$pms_identity = test_input($_POST["pms_identity"]);
	$pms_permission = test_input($_POST["pms_permission"]);
	$pms_password = test_input($_POST["pms_password"]);

try {
	include "../connect_db.php";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ("add" == $pms_type) {
    	$set_pw_sql = "SELECT * FROM person_main WHERE person_name = '$pms_name' AND person_identity LIKE '%$pms_identity' AND person_permission IS NULL";
    	$stmt = $conn->prepare($set_pw_sql);
    	$stmt->execute();

    	// set the resulting array to associative
    	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		if (count($stmt->fetchAll())) {
    		$set_pw_sql = "UPDATE person_main SET person_password='$pms_password',person_permission='$pms_permission' WHERE person_name='$pms_name' AND person_identity LIKE '%$pms_identity'";
    		$conn->exec($set_pw_sql);
		
    		echo "！權限添加成功";
		} else {
			echo "！資料不正確";
		}
	} else if ("update" == $pms_type) {
    	$set_pw_sql = "SELECT * FROM person_main WHERE person_name = '$pms_name' AND person_permission IS NOT NULL";
    	$stmt = $conn->prepare($set_pw_sql);
    	$stmt->execute();

    	// set the resulting array to associative
    	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		if (count($stmt->fetchAll())) {
    		$set_pw_sql = "UPDATE person_main SET person_password='$pms_password',person_permission='$pms_permission' WHERE person_name='$pms_name' AND person_permission IS NOT NULL";
    		$conn->exec($set_pw_sql);
		
    		echo "！權限更改成功";
		} else {
			echo "！資料不正確";
		}
	} else if ("delete" == $pms_type) {
    	$set_pw_sql = "SELECT * FROM person_main WHERE person_name = '$pms_name' AND person_permission IS NOT NULL";
    	$stmt = $conn->prepare($set_pw_sql);
    	$stmt->execute();

    	// set the resulting array to associative
    	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		if (count($stmt->fetchAll())) {
    		$set_pw_sql = "UPDATE person_main SET person_password = NULL,person_permission = NULL WHERE person_name='$pms_name' AND person_permission IS NOT NULL";
    		$conn->exec($set_pw_sql);
		
    		echo "！權限刪除成功";
		} else {
			echo "！資料不正確";
		}
	}
}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}

?>
