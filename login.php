<?php
	session_start();
	
	$page_title = 'Login';
	include('header.php');
	if(!isset($_SESSION['user_id'])) {
		if(isset($errors) && !empty($errors)) {
			echo '<p id="err_msg">Opps!<br>';
			foreach($errors as $msg) {
				echo " - $msg<br>";
			}
			echo 'please try again or <a href="register.php">Register</a></p>';
		}

		echo "
<style>
	body {
background-color: #5e79d7;
}
</style>
<div id='main' style='font-size:25px;text-align:center;margin-top:20px;'>
<h1>Login</h1>
<fieldset style='background-color: white'>
	<form action='login_action.php' method='POST' style='margin-top:20px;'>
			<p>Your email: <input type='text' name='email' style='background-color:inherit'></p>
			<p>Password: <input type='password' name='pass' style='background-color:inherit'></p>
		<p style='margin-top:20px;margin-bottom:20px;'><input type='submit' value='login' class='btn'></p>
	</form>
	or  <a href='body.php' style='color: blue ;text-decoration: none'>Signup</a>
</fieldset>
</div>";
	} else {
		echo 'U R already logged in as '.$_SESSION['f_name'].$_SESSION['l_name'];
		echo "<a href='goodbye.php'>logout</a>";
	}

?>


