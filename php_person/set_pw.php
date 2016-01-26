<?php
//set manager's password
include_once "../header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$login_name = $_SESSION["login_name"];
	$login_permission = $_SESSION["login_permission"];
	$original_password = test_input($_POST["original_password"]);
	$new_password = test_input($_POST["new_password"]);

try {
	include "../connect_db.php";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $set_pw_sql = "SELECT person_name FROM person_main WHERE person_password='$original_password' AND person_permission='$login_permission' AND person_name='$login_name';";
    $stmt = $conn->prepare($set_pw_sql);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if (count($stmt->fetchAll())) {
    	$set_pw_sql = "UPDATE person_main SET person_password='$new_password' WHERE person_password='$original_password' AND person_name='$login_name' AND person_permission='$login_permission';";
    	$conn->exec($set_pw_sql);
	
		echo $login_permission . " : ";
		echo $login_name . "\n" . "\n";
    	echo "！密碼更改成功";
	} else {
    	echo "！原密碼不正確";
	}
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}

?>
