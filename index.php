<?php
    session_start();
    require('login_tools.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
    <link rel="stylesheet" href="index_style.css">
        <style>
    body{
        background-image: url('image.jpeg');
	background-size: cover;
	background-repeat: no-repeat;
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
<meta charset="utf-8">
  <title>jQuery UI Datepicker - Populate alternate field</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({
      altField: "#DatepickerBox2"  ,
      altFormat: "DD, d MM, yy"
    });
  });
  </script>





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



    <div id='main'>
    	<form action="search.php" method="GET">
            <div id='m_top' class='lg_fld'>
        		<div id='m_t_left'>
        			<input type="text" name="from" placeholder="From" required>
        		</div>
        		<div id='m_t_right'>
        			<input type="text" name="to" placeholder="To" required>
        		</div>
            </div>

<!--            <div id="datepicker">
                <input id='DatepickerBox2' type='date'>
            </div>
-->


            <div id='middle' class='lg_fld'>
                <div id='mid_1'>
            		<select name="Month">
            			<option> - Month - </option>
            			<option value="1">01-January</option>
            			<option value="2">02-Febuary</option>
            			<option value="3">03-March</option>
            			<option value="4">04-April</option>
            			<option value="5">05-May</option>
            			<option value="6">06-June</option>
            			<option value="7">07-July</option>
            			<option value="8">08-August</option>
            			<option value="9">09-September</option>
            			<option value="10">10-October</option>
            			<option value="11">11-November</option>
            			<option value="12">12-December</option>
            		</select>
                </div>
                <div id='mid_2'>
            		<select name="Day">
            			<option> - Day - </option>
            			<?php
            				for($day=1;$day<=31;$day++){
            					echo "
            						<option value='$day'>$day</option>
            					";
            				}

            			?>
            		</select>
                </div>
                <div id='mid_3'>
            		<select name="Year">
            			<option> - Year - </option>
            			<?php
            				for($yr=2018;$yr<2020;$yr++){
            					echo "
            						<option value='$yr'>$yr</option>
            					";
            				}
            			?>
            		</select>
                </div>
            </div>
            <div id='m_bottom' class='lg_fld'>
                <span>Number of Passengers</span>
                <input type="number" name="num_passenger" min="1" max="9" required>
            </div>
            <div id='last' class='btn'>
                <input type="submit" name="submit" value="Search">
            </div>
    	</form>
    </div>
</body>
</html>
