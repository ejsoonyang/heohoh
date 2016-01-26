<?php
//settle the right room and house name
include_once "../header.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$settle_person_ID = intval(test_input($_GET["settle_person_ID"]));
	$settle_house = test_input($_GET["settle_house"]);
	$settle_room = test_input($_GET["settle_room"]);

try {
	include "../connect_db.php";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $settle_person_sql = "UPDATE person_main SET person_house='$settle_house',person_room='$settle_room' WHERE person_ID='$settle_person_ID';";
    $conn->exec($settle_person_sql);


    //echo the information onto hint
    $sql_execution = "SELECT person_name FROM person_main WHERE person_ID='$settle_person_ID'";

    $stmt = $conn->prepare($sql_execution);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$settle_person = $stmt->fetchAll();

	$login_name = $_SESSION["login_name"];
	$login_permission = $_SESSION["login_permission"];
	$settle_date = date("Y-m-d");
	$settle_time = date("H:i:s");

    echo $settle_person[0]['person_name'];
	echo "已入住  [操作:$login_permission-$login_name $settle_date $settle_time]";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}

?>
