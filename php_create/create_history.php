<!DOCTYPE html>
<html lang="en">
	<meta http-equiv="Content-Type" content="charset=utf-8">

<?php
try {
	$servername = "localhost"; $username = "root"; $password = ""; $dbname = "wuhehe";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    $sql = "CREATE TABLE person_history (
history_ID INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
person_ID INT(8),

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
person_break_end_time TIME
    );";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table person_history created successfully<br>";

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?> 

