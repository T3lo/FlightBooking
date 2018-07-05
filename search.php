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
            <div id='login1'><span id='first'><a href='login.php'>Log in</a></span></div>
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

<div id='main2'>
<?php
	if($_SERVER["REQUEST_METHOD"]=='GET'){
		$from=$_GET['from'];
		$to=$_GET['to'];
		$month=$_GET['Month'];
		$day=$_GET['Day'];
		$year=$_GET['Year'];
		$num_pass=$_GET['num_passenger'];

//		echo "From: $from<br>To: $to<br>Date: $month/$day/$year <br>Number : $num_pass";
		include("connect_db.php");

		///////////////////////////////Method #1 to find direct Flights

		$q = "select * from Route where Airport='$from' and Destination='$to'";
		$r = mysqli_query($dbc,$q);

		if($row=mysqli_fetch_array($r,MYSQLI_ASSOC)) {
			$q2="select * from AirFare where Route='$row[RtID]' ";
			$r2=mysqli_query($dbc,$q2);

			$row2=mysqli_fetch_array($r2,MYSQLI_ASSOC);

			// search Flight Schedule Database for this fare id
			$q3="select * from Flight_Schedule where NetFare='$row2[AfID]' and FlightDate='$year-$month-$day' ";
//			echo "QUERY : $q3<br><br>";
			$r3=mysqli_query($dbc,$q3);
			while($row3=mysqli_fetch_array($r3,MYSQLI_ASSOC)){
//				echo "<br>$row3[FIID]";

				// look for seats in that plane
				$q4="select * from AirCrafts where AcID=$row3[AirCraft] ";
//				echo "<br>$q4<br>";
				$r4=mysqli_query($dbc,$q4);
				$row4=mysqli_fetch_array($r4,MYSQLI_ASSOC);

				if($row3['Remaining'] > 0){
					// show this plane details to the user

					echo "
					<div class='box'>
						<div id='b_top' class='b_el'>
							<div id='m_t_l' class='b_el'>
								<div id='m_t_l_logo' class='b_el'>
									<img src='./img/$row4[Airline].jpeg'>
								</div>
								<div id='m_t_l_id'>
									<div id='m_t_l_name' class='b_el'>
										<span>$row4[Airline]</span>
									</div>									
									<div id='m_t_l_num' class='b_el'>
										<span>$row4[AcNumber]</span>
									</div>
								</div>
							</div>
							<div id='m_t_r' class='b_el'>
								<div id='price' class='b_el'>
									<span><b>PRICE :</b> Rs. $row2[Fare]</span>
								</div>
							</div>							
						</div>
						<div id='b_middle' class='b_el'>
							<div id='mid_l1'>
								<div id='mid_arr'>
									<span><b>Arrival :</b>$row3[Departure]</span>
								</div>
							</div>
							<div id='mid_m1'>
								<div id='mid_dep'>
									<span><b>Departure :</b>$row3[Arrival]</span>
								</div>
							</div>
							<div id='mid_r1'>
								<span><b>Hops :</b> 0</span>
							</div>

						</div>
				
					";

					// for sending to book.php we need to send user_id, flight_id, number_of_passengers
					echo "
						<form method='POST' action='book.php'>
							<input type='hidden' name='FlID' value=$row3[FIID]>
							<input type='hidden' name='num_pass' value=$num_pass>
							<input type='hidden' name='hop' value=0>
							<div id='b_bottom' class='b_el'>
								<div class='btn1'>
									<input type='submit' value='Book' name='submit'>
								</div>							
							</div>

						</form>
					</div>
                        
					";
				}
			}
		}


		////////////////////////////////Method #2 to find 1 stop Flights

		// ************************************ Get all the rows that has from as the input of the user
		echo "<hr><hr>";
		$q01="select * from Route where Airport='$from' ";
		$r01=mysqli_query($dbc,$q01);
		while($row01=mysqli_fetch_array($r01,MYSQLI_ASSOC)){
//			print_r($row01);

			// ************************************ Get all the rows that has from as the input of the user
			$q02="select * from Route where Destination='$to' ";
			$r02=mysqli_query($dbc,$q02);
			while($row02=mysqli_fetch_array($r02,MYSQLI_ASSOC)){

				//********************************************* Find the 1 stop point between the combinations				
				if($row01['Destination']==$row02['Airport']){
					// find the difference between the arrival of row01 plane and departure time of row02 plane [DO IT LATER ON]

					// Find fare id of both routes
					$q03="select * from AirFare where Route=$row01[RtID] ";
					$r03=mysqli_query($dbc,$q03);

					$q04="select * from AirFare where Route=$row02[RtID] ";
					$r04=mysqli_query($dbc,$q04);

					$row03=mysqli_fetch_array($r03,MYSQLI_ASSOC);
					$row04=mysqli_fetch_array($r04,MYSQLI_ASSOC);

					//Get the flights of those two flights on that date
					$q05="select * from Flight_Schedule where NetFare='$row03[AfID]' and FlightDate='$year-$month-$day' ";
					$r05=mysqli_query($dbc,$q05);
					$q06="select * from Flight_Schedule where NetFare='$row04[AfID]' and FlightDate='$year-$month-$day' ";
					$r06=mysqli_query($dbc,$q06);

					//Select the flight if aircraftID match
					while($row05=mysqli_fetch_array($r05,MYSQLI_ASSOC)){
						while($row06=mysqli_fetch_array($r06,MYSQLI_ASSOC)){

							// AcID must be same for both flights
							if($row06['AirCraft']==$row05['AirCraft']){

								// Get the Airline of that plane
                                $q07="select * from AirCrafts where AcID=$row05[AirCraft] ";
                                $r07=mysqli_query($dbc,$q07);
                                $row07=mysqli_fetch_array($r07,MYSQLI_ASSOC);

                                if($row05['Remaining'] > 0){
                                    // show this plane details to the user

                                    echo "
										<div class='box'>
											<div id='b_top' class='b_el'>
												<div id='m_t_l' class='b_el'>
													<div id='m_t_l_logo' class='b_el'>
														<img src='./img/$row07[Airline].jpeg'>
													</div>
													<div id='m_t_l_id'>
														<div id='m_t_l_name' class='b_el'>
															<span>$row07[Airline]</span>
														</div>									
														<div id='m_t_l_num' class='b_el'>
															<span>$row07[AcNumber]</span>
														</div>
													</div>
												</div>
												<div id='m_t_r' class='b_el'>
													<div id='price' class='b_el'>
														<span><b>PRICE :</b> Rs. $row03[Fare]</span>
													</div>
												</div>							
											</div>
											<div id='b_middle1' class='b_el'>
												<div id='mid_r1'>
													<span><b>Route :</b> $row01[RouteCode]</span>
												</div>											
												<div id='mid_l1'>
													<div id='mid_arr'>
														<span><b>Arrival :</b>$row05[Departure]</span>
													</div>
												</div>
												<div id='mid_m1'>
													<div id='mid_dep'>
														<span><b>Departure :</b>$row05[Arrival]</span>
													</div>
												</div>
											</div>
											<div id='b_middle2' class='b_el'>
												<div id='mid_r2'>
													<span><b>Route :</b> $row02[RouteCode]</span>
												</div>											
												<div id='mid_l2'>
													<div id='mid_arr'>
														<span><b>Arrival :</b>$row06[Departure]</span>
													</div>
												</div>
												<div id='mid_m2'>
													<div id='mid_dep'>
														<span><b>Departure :</b>$row06[Arrival]</span>
													</div>
												</div>
											</div>
                                    ";

                                    // for sending to book.php we need to flight_id, number_of_passengers
                                    echo "
                                        <form method='POST' action='book.php'>
                                            <input type='hidden' name='FlID1' value=$row05[FIID]>
                                            <input type='hidden' name='FlID2' value=$row06[FIID]>
                                            <input type='hidden' name='num_pass' value=$num_pass>
                                            <input type='hidden' name='hop' value=1>
											<div id='b_bottom' class='b_el'>
												<div class='btn1'>
													<input type='submit' value='Book' name='submit'>
												</div>							
											</div>

										</form>
									</div>
                                    ";
                                }
							}
						}
					}


/*
					print_r($row03);
					echo "<br>";
					print_r($row04);
					echo "<br>";
					print_r($row05);
					echo "<br>";
					print_r($row06);
*/
				}
			}
		}

		mysqli_close($dbc);
	}
?>
</div>


</body>
</html>
