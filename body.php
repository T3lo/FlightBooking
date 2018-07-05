<?php
$page_title='Sign_up';
include('header.php');
?>
<style>
	body {
background-color: #5e79d7;
}
</style>
<div id="main" style='font-size:35px;text-align:center;margin-top:20px;'>
<h1>Register</h1>
<fieldset style="background-color:white;">
	<form action="sign_up.php" method="POST">
		<p>Name:<input type="text" name="Name" value="<?php if(isset($_POST['Name'])) echo $_POST['Name'];?>" style='background-color:inherit'></p>
		<p>Age:<input type="text" name="age" value="<?php if(isset($_POST['age'])) echo $_POST['age'];?>" style='background-color:inherit'></p>
		<p>Nationality:<input type="text" name="Nationality" value="<?php if(isset($_POST['Nationality'])) echo $_POST['Nationality'];?>" style='background-color:inherit'></p>
		<p>Phone Number:<input type="text" name="Phone" value="<?php if(isset($_POST['Phone'])) echo $_POST['Phone'];?>" style='background-color:inherit'></p>
		<p>Address:<input type="text" name="Address" value="<?php if(isset($_POST['Address'])) echo $_POST['Address'];?>" style='background-color:inherit'></p>
		<p>email:<input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" style='background-color:inherit'></p>
		<p>Password :<input type="password" name="pass1" value="<?php if(isset($_POST['pass1'])) echo $_POST['pass1'];?>" style='background-color:inherit'></p>
		<p style='margin-top:20px;margin-bottom:20px;' ><input type="submit" class='btn'></p>
	</form>
</fieldset>
</div>
