<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	require('connect_db.php');
	require('login_tools.php');
	$f_name=$_POST['Name'];
	$age=$_POST['age'];
	$Nationality=$_POST['Nationality'];
	$Phone=$_POST['Phone'];
	$Address=$_POST['Address'];
	$email=$_POST['email'];
	$pass1=$_POST['pass1'];

	require('connect_db.php');
	$q_pid="select MAX(PsID) from Passengers";
	$r_pid=mysqli_query($dbc,$q_pid);
	$max_pid=mysqli_fetch_array($r_pid,MYSQLI_ASSOC);
	
//	echo $max_pid['MAX(PsID)'];

	$user_id=intval($max_pid['MAX(PsID)'])+1;

	$q01 = "insert into Contact_Details values ($user_id,'$email','$Phone','$Address')";
	$r01 = mysqli_query($dbc,$q01);
echo "$q01<br><br>";
	$q02 = "insert into Passengers values ($user_id,'$f_name',$age,'$Nationality',$user_id,SHA1('$pass1'))";
	$r02 = mysqli_query($dbc,$q02);
echo "$q02<br><br>";
	mysqli_close($dbc);
	include('login.php');
}
?>
