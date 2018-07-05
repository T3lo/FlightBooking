<?php

echo "
<!DOCTYPE html>
<html>
<head>
	<title>$page_title</title>
	<link rel='stylesheet' type='text/css' href='site_css.css'>
</head>
<body>
	<div id='head'>
";

if(isset($_SESSION['user_id'])) {
	echo "
		<div id='h_left'>
			<h2 id='the_head'>BookMyFlight</h2>
		</div>
		<div id='h_right'>	
				<div id='h_right_left'>
					##{$_SESSION['Email']}
				</div>
				<div id='h_right_right'>
					<div class='btn'><p><a style='color: white ;text-decoration: none' href='goodbye.php'>logout</a></p></div>
				</div>
		</div>
	";
}
else {
echo "
		<div id='h_left' style='position:none;margin-left:auto;margin-right:auto;'>
			<h2 id='the_head'>BookMyFlight</h2>
		</div>
";
}

echo "	</div>
</body>
</html>";
?>
