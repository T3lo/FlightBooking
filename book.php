<?php
	session_start();
    require('login_tools.php');
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
    <link rel="stylesheet" href="index_style.css">
    <link rel="stylesheet" href="srch_style.css">
    <style>
    body{
        background-color: #f0f0f0;
    }
    #first a {
        text-decoration: none;
        color: #c8cbd8;
    }
    #second a {
        text-decoration: none;
        color: #3c3853;
    }
    </style>
</head>
<body>

<div id='head'>
    <h1>BookMyFlight</h1>
    <div id='right'>
        <div id='up'>
<?php
if(isset($_SESSION['user_id'])){
    echo "
                <div id='login'><span id='first'>#$_SESSION[Email]</span></div>    
                <div id='signup'><span id='second'><a href='GoodBye.php'>Exit</a></span></div>
        ";
}
else{
echo "  
            <div id='login'><span id='first'><a href='login.php'>Log in</a></span></div>
";
}
?>
        </div>
    <!--    <div id='down'>
            <ul>
                <li>Code</li>
                <li>Music</li>
                <li>Places</li>
                <li>Books</li>
            </ul>
        </div>
    -->
    </div>

</div>

 <?php
	if(isset($_SESSION['user_id'])){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$hops=$_POST['hop'];
			require('connect_db.php');
			if($hops){
				// Get the user_Id and flight id of the planes that r 2 b booked
				$PsID=$_SESSION['user_id'];
				$FlID1=$_POST['FlID1'];
				$FlID2=$_POST['FlID2'];
				$Type=1;
				$Number=$_POST['num_pass'];

///////////////////////////////////////////////////////////////////                    1
				
				//*********************************************** Find Date and Time of the flight				
				$q00="select * from Flight_Schedule where FIID=$FlID1 ";
				$r00=mysqli_query($dbc,$q00);
				$row00=mysqli_fetch_array($r00,MYSQLI_ASSOC);
				$DepDate=$row00['FlightDate'];
				$DepTime=$row00['Departure'];
				$Dep=$DepDate." ".$DepTime;

				// ******************************************* Find the Fare Id to get the fare of the ticket 
				$FareID=$row00['NetFare'];
				$q01="select Fare from AirFare where AfID=$FareID ";			
				$r01=mysqli_query($dbc,$q01);
				$row01=mysqli_fetch_array($r01,MYSQLI_ASSOC);
				$v_amount=$row01['Fare'];
				$amount=intval($v_amount);

				// *********************************** Calculate the ID for the new entry into Charges
				$q02="select MAX(ChID) from Charges";
				$r02=mysqli_query($dbc,$q02);
				$row02=mysqli_fetch_array($r02,MYSQLI_ASSOC);
				$ChID=intval($row02['MAX(ChID)'])+1;

				// *********************************************Insert value in Charges table
				$q03="insert into Charges values ($ChID,'Title $ChID',$amount,'Descipt $ChID') ";
				$r03=mysqli_query($dbc,$q03);						////////////////

				$q04="select MAX(TsID) from Transactions";
				$r04=mysqli_query($dbc,$q04);
				$TsID=intval(mysqli_fetch_array($r04,MYSQLI_ASSOC)['MAX(TsID)'])+1;


				// ******************************************** Insert a Transaction 
				$q05="insert into Transactions values 
				($TsID,NOW(),'$Dep',$PsID,$FlID1,1,$ChID,$Number)
				";
				$r05=mysqli_query($dbc,$q05);							/////////////////


				// ***********************************  Update the number of seats left
				$q06="update Flight_Schedule set Remaining=Remaining-$Number where FIID=$FlID1";
				$r06=mysqli_query($dbc,$q06);									//////////////

				// Seats are booked 

				echo "
				<br>
				<span>Seat for $Number for FlID: $FlID1 booked for PsID : $PsID</span>
				<br>
				";


//////////////////////////////////////////////////////////////////                         2


				//********************************* Find the Date n time of the flight
				$q00="select * from Flight_Schedule where FIID=$FlID2 ";
				$r00=mysqli_query($dbc,$q00);
				$row00=mysqli_fetch_array($r00,MYSQLI_ASSOC);
				$DepDate=$row00['FlightDate'];
				$DepTime=$row00['Departure'];
				$Dep=$DepDate." ".$DepTime;

				//********************************* Find the Fare of the ticket
				$FareID=$row00['NetFare'];
				$q01="select Fare from AirFare where AfID=$FareID ";
				$r01=mysqli_query($dbc,$q01);
				$row01=mysqli_fetch_array($r01,MYSQLI_ASSOC);
				$v_amount=$row01['Fare'];
				$amount=intval($v_amount);

				//********************************* Find the ID to be used for entry
				$q02="select MAX(ChID) from Charges";
				$r02=mysqli_query($dbc,$q02);
				$row02=mysqli_fetch_array($r02,MYSQLI_ASSOC);
				$ChID=intval($row02['MAX(ChID)'])+1;

				// ******************************** Insert the fare into charges
				$q03="insert into Charges values ($ChID,'Title $ChID',$amount,'Descipt $ChID') ";
				$r03=mysqli_query($dbc,$q03);						////////////////

				//********************************* Get id to be entered
				$q04="select MAX(TsID) from Transactions";
				$r04=mysqli_query($dbc,$q04);
				$TsID=intval(mysqli_fetch_array($r04,MYSQLI_ASSOC)['MAX(TsID)'])+1;

				// ******************************** Insert a Transaction				
				$q05="insert into Transactions values 
				($TsID,NOW(),'$Dep',$PsID,$FlID2,1,$ChID,$Number)
				";
				$r05=mysqli_query($dbc,$q05);							/////////////////


				// Transaction has been added
				// * So time to make changes in seat count
				// * And send mail of confirmation to the user


				// ******************************** Update the number of seats
				$q06="update Flight_Schedule set Remaining=Remaining-$Number where FIID=$FlID2";
				$r06=mysqli_query($dbc,$q06);									//////////////

				// Seats are booked 

				echo "
				<br>
				<span>Seat for $Number for FlID: $FlID2 booked for PsID : $PsID</span>
				<br>
				";

/////////////////////////////////////////////////////////////////////////   END HOP = 1				
			}
			else {
				$PsID=$_SESSION['user_id'];
				$FlID=$_POST['FlID'];
				$Type=1;
				$Number=$_POST['num_pass'];

				//insert into charges
				$q00="select * from Flight_Schedule where FIID=$FlID ";
				$r00=mysqli_query($dbc,$q00);
				$row00=mysqli_fetch_array($r00,MYSQLI_ASSOC);
				$DepDate=$row00['FlightDate'];
				$DepTime=$row00['Departure'];
				$Dep=$DepDate." ".$DepTime;
//echo "<br>$q00<br>";
				$FareID=$row00['NetFare'];
				$q01="select Fare from AirFare where AfID=$FareID ";
//echo "<br>$q01<br>";				
				$r01=mysqli_query($dbc,$q01);
				$row01=mysqli_fetch_array($r01,MYSQLI_ASSOC);
				$v_amount=$row01['Fare'];
				$amount=intval($v_amount);
//echo "1";
				$q02="select MAX(ChID) from Charges";
				$r02=mysqli_query($dbc,$q02);
				$row02=mysqli_fetch_array($r02,MYSQLI_ASSOC);
				$ChID=intval($row02['MAX(ChID)'])+1;
//echo "<br>$q02<br>";
				$q03="insert into Charges values ($ChID,'Title $ChID',$amount,'Descipt $ChID') ";
				$r03=mysqli_query($dbc,$q03);						////////////////

//echo "<br>$q03<br>";
				;

				$q04="select MAX(TsID) from Transactions";
				$r04=mysqli_query($dbc,$q04);
				$TsID=intval(mysqli_fetch_array($r04,MYSQLI_ASSOC)['MAX(TsID)'])+1;

				$q05="insert into Transactions values 
				($TsID,NOW(),'$Dep',$PsID,$FlID,1,$ChID,$Number)
				";
				$r05=mysqli_query($dbc,$q05);							/////////////////

//echo "<br>Q: $q05<br>";

				// Transaction has been added
				// * So time to make changes in seat count
				// * And send mail of confirmation to the user

				$q06="update Flight_Schedule set Remaining=Remaining-$Number where FIID=$FlID";
				$r06=mysqli_query($dbc,$q06);									//////////////

				// Seats are booked 

				echo "

				<span>Seat for $Number for FlID: $FlID booked for PsID : $PsID</span>

				";
			}
		}
	}
	else{
		load();
	}
?>

