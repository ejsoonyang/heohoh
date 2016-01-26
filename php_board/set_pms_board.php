<?php
include_once "../header.php";

//echo permission setting board

echo "<div id='set_pms'>";
echo "<div id='set_pms_nav'>權　限　設　置<span id='pop_close' onclick='close_pop_win()'>close</span></div>";
echo "<div class='set_pms_nav_left'>增加:</div>";
echo "<div id='add_pms_div'>";
echo "<form id='set_pms_form' class='set_pms_form'>";
echo "<div class='float_div'>";
echo "姓名:<input type='input' id='add_pms_name'>";
echo "<br>";
echo "權限:";
echo "<select id='add_pms_permission'>";
permission_select_option($person_permission);
echo "</select>";
echo "</div>";//float_div
echo "<div class='float_div'>";
echo "<span class='left_35'></span>";
echo "</div>";//float_div
echo "<div class='float_div'>";
echo "身份證號:<input type='input' id='add_pms_identity'>";
echo "<br>";
echo "　　密碼:<input type='password' id='add_pms_password'>";
echo "</div>";//float_div
echo "<div class='float_div'>";
echo "<span class='left_35'></span>";
echo "</div>";//float_div
echo "<input type='button' id='pms_type_add' value='增加' onclick='pms_function(this.id)'>\n";
echo "<input type='button' value='重設' onclick='reset_person_pms()'>\n";
echo "</form>";
echo "</div>";

echo "<div class='clear_float'></div>";
echo "<div class='setting_house_nav_left'>更改:</div>";
echo "<div id='update_house_div'>";

try {
	include "../connect_db.php";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_execution = "SELECT person_name,person_permission FROM person_main WHERE person_permission IS NOT NULL";
    $stmt = $conn->prepare($sql_execution);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$permission_array = $stmt->fetchAll();
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

for ($x = 0; $x < count($permission_array); $x++) {
	$person_name = $permission_array[$x]['person_name'];
	$person_permission = $permission_array[$x]['person_permission'];
	echo '<form class="setting_house_form">';
	echo "姓名:<input type='input' class='update_pms_name' value='$person_name' readonly>\n";
	echo "權限:";
	echo "<select class='update_pms_permission'>\n";
	permission_select_option($person_permission);
	echo "</select>";
	echo " 密碼:<input type='password' class='update_pms_password' value=''>\n";
	echo "<span class='left_35'></span>";
	echo "<input type='button' id='pms_type_update$x' value='更改' onclick='pms_function(this.id)'>\n";
	echo "<input type='button' id='pms_type_delete$x' value='刪除' onclick='pms_function(this.id)'>\n";
	echo '</form>';
}

echo "</div>";
echo "<div class='clear_float'></div>";
echo "</div>";
?>
