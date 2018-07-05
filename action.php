<?php
	session_start();
	require('login_tools.php');
	
	if(!isset($_SESSION['reg_no'])) {
		load();
	}

function update_mydb($dbc,$reg_no,$to,$sub) {
	$q = "INSERT INTO trans (sc_id,ex_id,title,status,date) values ($reg_no,$to,'$sub','NO',NOW())";
	$r = mysqli_query($dbc,$q);
echo $q;
}

if($_SERVER['REQUEST_METHOD']=='POST') {
	$ex = $_POST['e'];
	$reg_no = $_POST['reg_no'];
print_r($_POST);
echo "<br>";
echo "<br>";
echo $_POST['check'];
echo "<br>";
echo "<br>";

	if($_POST['check']==0) {
		if(isset($_FILES['file']['size'])) {
			$file = $_FILES['file'];
			print_r($file);
			$file_name = $file['name'];
			$file_tmp = $file['tmp_name'];
			$file_size = $file['size'];
			$file_error = $file['error'];
			$allowed = array('pdf');

			if(1) {
				if($file_error === 0) {
					if($file_size <= 2097152) {
						$file_name_new = "Synopsis_".$reg_no.".pdf";
						$file_dest = 'up/'.$file_name_new;
						if(move_uploaded_file($file_tmp, $file_dest)) {
							echo $file_dest;
						}
					}
				}
			}
		}
	}
	else {
		$file_dest='up/Synopsis_'.$reg_no.'.pdf';
		echo "<br>File in database : $file_dest";
	}
echo "<br>";
	require('connect_db.php');
	$i=0;
	foreach($ex as $x) {
		$q = "SELECT * FROM examiner WHERE name= '$x'";
		$r = mysqli_query($dbc,$q);

		while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {	
			$em[$i] = $row['email'];
		}
		$i = $i + 1;
		print_r($em);
echo "<br>";
	}

	require("PHPMailer-5.2.4/class.phpmailer.php"); 
	$mail = new PHPMailer(); 
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Host = "smtp.gmail.com"; // SMTP server
	$mail->Port = 465;
	$mail->IsHTML(true);
	$mail->Username = "rit97bha@gmail.com";
	$mail->Password = "qwerty123q";
	$mail->SetFrom("ritwik97bhattacharya@gmail.com");

	foreach($em as $x) {
		$mail->AddAddress($x);
		echo $x;
	}

	$mail->addAttachment($file_dest);
	
	$q="select title from scholar where reg_no=$reg_no";
	$r=mysqli_query($dbc,$q);
	if($row=mysqli_fetch_array($r,MYSQLI_ASSOC))
		$sub=$row['title'];
		
	$mail->Subject = $sub; 
	$mail->Body = "Hi! \n\n This is my first e-mail sent through PHPMailer.".$ex[0]."\t".$ex[1]; 
	$mail->WordWrap = 50;

$to = "ritwik97bhattacharya@gmail.com;";

	if(!$mail->Send()) { 
		echo 'Message was not sent.'; 
		echo 'Mailer error: ' . $mail->ErrorInfo; 
	} else { 
		echo 'Message has been sent.'; 
	foreach($ex as $x) {
		$q = "select * from examiner where name='$x'";
		$r = mysqli_query($dbc,$q);
		if(mysqli_num_rows($r)){
			while($row=mysqli_fetch_array($r,MYSQLI_ASSOC)) {
				$ex_no=$row['id'];
				echo "<br>$ex_no";
			}
		}
		update_mydb($dbc,$reg_no,$ex_no,$sub);
	}
	} 

	mysqli_close($dbc);
}
?>

