<?php
//echo set password
include_once "../header.php";
$login_name = $_SESSION["login_name"];
$login_permission = $_SESSION["login_permission"];

//$the_person = test_input($_GET["the_person"]);
//$the_permission = test_input($_GET["the_permission"]);

echo "<div id='set_pw'>";
echo "<div id='set_pw_left'>";
echo "<div class='set_pw_left_nav'>密　碼　設　置:</div>";
echo "<br>";
echo "<div class='set_pw_left_nav_permission'>$login_permission</div>";
echo "<div class='clear_float'></div>";
echo "<div class='set_pw_left_nav_name'>$login_name</div>";
echo "</div>";
echo "<div id='set_pw_div'>";
echo "<form id='set_pw_form'>";
echo "原密碼:<input type='password' id='set_pw_original' value='' autofocus>\n";
echo "<br>";
echo "新密碼:<input type='password' id='set_pw_new' value=''>\n";
echo "<br>";
echo "新密碼:<input type='password' id='set_pw_twice' value='' onkeydown='enter_pw(event)'>\n";
echo "<br>";
echo "<br>";
echo "<input type='button' value='確認' onclick='set_pw_function()'>\n";
echo "<input type='button' value='取消' onclick='close_pop_win()'>\n";
echo "</form>";
echo "</div>";
?>

