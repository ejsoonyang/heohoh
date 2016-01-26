<!DOCTYPE html>
<html lang="en">
	<meta http-equiv="Content-Type" content="charset=utf-8">

<?php
try {
	$servername = "localhost"; $username = "root"; $password = ""; $dbname = "wuhehe";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$conn->exec("DROP TABLE person_main");

    // sql to create table
    $sql = "CREATE TABLE person_main (
person_ID INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
person_permission VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_password VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_credit INT(3),
person_name VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_dharma VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_sexuality VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin,
person_birth DATE,
person_phone VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin,
person_degree VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin,
person_identity VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_bin,
person_identity_address VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_current_address VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_x BOOLEAN,
person_remarks VARCHAR(2000) CHARACTER SET utf8 COLLATE utf8_bin,

person_house VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin,
person_room VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin,

person_type VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin,
person_group VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin,

person_prearrive_date DATE,
person_prearrive_time TIME,
person_prearrive_confirm VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin,
person_arrive_date DATE,
person_arrive_time TIME,

person_preleave_date DATE,
person_preleave_time TIME,
person_preleave_confirm VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin,
person_leave_date DATE,
person_leave_time TIME,

person_break_start_date DATE,
person_break_start_time TIME,
person_break_end_date DATE,
person_break_end_time TIME,

person_healthy VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_marriage VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_email VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_QQ VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_emergency_person VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_emergency_relationship VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_emergency_contact VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_employer VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_job VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin,
person_work_experience VARCHAR(2000) CHARACTER SET utf8 COLLATE utf8_bin,
person_specialty_features VARCHAR(2000) CHARACTER SET utf8 COLLATE utf8_bin,

person_volunteer_obey VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin,
person_volunteer_advise VARCHAR(2000) CHARACTER SET utf8 COLLATE utf8_bin,
person_volunteer_reason VARCHAR(2000) CHARACTER SET utf8 COLLATE utf8_bin

    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table person_main created successfully<br>";

	//insert the admin
	$person_name = test_input("陽飛");
	$person_permission = test_input("超級管理員");
	$person_password = test_input("123456");
    $sql = "INSERT INTO person_main (person_name,person_permission,person_password) VALUES ('$person_name','$person_permission','$person_password');";
    $conn->exec($sql);
    echo "person_name is 陽飛<br>
    	person_password is 123456";

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?> 
