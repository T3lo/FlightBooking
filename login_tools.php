<?php 
function load($page='login.php') {
	$url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
	$url .= '/'.$page;
	header("location: $url");
}
function validate($dbc,$email ="", $pwd= "") {
	$errors = array();
	if(empty($email)) {
		$errors[] = "Enter your email";
	}
	else {
		$e = mysqli_real_escape_string($dbc,trim($email));
	}
	if(empty($pwd)) {
		$errors[] = "Enter Password";
	}
	else {
		$p = mysqli_real_escape_string($dbc,trim($pwd));
	}
	if(empty($errors)) {
		$q00="select * from Contact_Details where Email='$email'";
		$r00=mysqli_query($dbc,$q00);
		$row00=mysqli_fetch_array($r00,MYSQLI_ASSOC);

		$CnID=intval($row00['CnID']);
		$q01="select * from Passengers where Contacts=$CnID and pass=SHA1('$pwd')";
		$r01 = mysqli_query($dbc,$q01);
		if(mysqli_num_rows($r01) == 1) {
			$row01 = mysqli_fetch_array($r01,MYSQLI_ASSOC);

			return array(true,$row00,$row01);
		}
		else {
			$errors[] = "Email & Pwd not found";
		}
	}
	
	return array(false,$errors,NULL);
}
?>
