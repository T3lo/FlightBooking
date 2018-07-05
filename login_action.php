<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	require('connect_db.php');
	require('login_tools.php');
	list($check,$data00,$data01) = validate($dbc,$_POST['email'],$_POST['pass']);
	
	if($check) {
		session_start();
		$_SESSION['user_id'] = $data01['PsID'];
		$_SESSION['Name'] = $data01['Name'];
		$_SESSION['Email'] = $data00['Email'];
		
		load('index.php');
	}
	else{
		$errors = $data00;
	}
	mysqli_close($dbc);
	include('login.php');
}
?>
