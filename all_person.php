<?php
include_once "./header.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>全部人員信息</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
		<link rel="stylesheet" type="text/css" href="css/login.css"/>
		<script>
			var body = document.getElementsByTagName("body");
			var body_xml = new XMLHttpRequest();
			body_xml.onreadystatechange = function() {
				if (body_xml.readyState == 4 && body_xml.status == 200) {
					body[0].innerHTML = body_xml.responseText;
				}
			}
			body_xml.open("GET", "php_board/person_board.php?read_type=all_person", true);
			body_xml.send();
		</script>
	</head>
	<body>
	</body>
</html>
