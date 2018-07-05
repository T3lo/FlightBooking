<?php
	$dbc=mysqli_connect("localhost","ritwik","ritwik","Flight")							
	or die(mysql_connect_error());					//     object to connect to the database

	mysqli_set_charset($dbc,"UTF-8");				//	   setting character set to UTF-8
?>