<?php
	error_reporting(E_ALL);
	//Create an array for our door values
	$doorArray = [];

	//Repeat this block for each door
	//Set the GPIO pin number to the number of the door you want to control
	$doorArray[] = array(
    "doorNumber" => 1,
    "gpioNumber" => 9
  );//end $doorArray

	$doorArray[] = array(
    "doorNumber" => 2,
    "gpioNumber" => 7
  );//end $doorArray

	if(isset($_GET['trigger']) && $_GET['trigger'] >= 1 && $_GET['trigger'] <= 10 ) {

		$doorTrigger = $_GET['trigger'];

		foreach( $doorArray as $doorItem ) {

			if ( $doorItem['doorNumber'] == $doorTrigger ) {
				exec ('gpio mode ' . $doorItem['gpioNumber'] . ' out');
				exec('gpio write ' . $doorItem['gpioNumber'] . ' 0');
				usleep(1000000);
				exec('gpio write ' . $doorItem['gpioNumber'] . ' 1');
			} //end if ( $doorItem['doorNumber'] == $doorTrigger )

		} //end	foreach( $doorArray as $doorItem )
	} //end if(isset($_GET['trigger']) && $_GET['trigger'] >= 1 && $_GET['trigger'] <= 10 )

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Garage Opener</title>
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta name="apple-mobile-web-app-capable" content="yes">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="apple-mobile-web-app-title" content="Opener">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

		<link rel="apple-touch-icon" href="touch-icon-ipad.png?ver=2018.04.05" />
		<link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad.png?ver=2018.04.05" />
		<link rel="apple-touch-icon" sizes="180x180" href="touch-icon-iphone-retina.png?ver=2018.04.05" />
		<link rel="apple-touch-icon" sizes="167x167" href="touch-icon-ipad-retina.png?ver=2018.04.05" />

		<link href='https://fonts.googleapis.com/css?family=Archivo+Narrow:400,700' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="css/style.css?ver=2023.03.20c" type="text/css">
		<link rel="manifest" href="manifest.json">

		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>

	</head>
	<body>
		<div class="title">
			<h2>Garage Door Control</h2>
		</div>
		<div class="controller-wrapper">
			<div class="controller">
				<div class="door-title">
		      		<h2>Left Door</h2>
				</div>
				<div id="door1-status" class="status-line"></div>
				<div class="activation-button">
			    <button id="1"><span class="buttonText" id="door1-buttonText">Activate</span><span id="door1-opening" class="door-opening">Wait...</span></button>
				</div>
			</div>
			<div class="controller">
				<div class="door-title">
		      		<h2>Right Door</h2>
				</div>
				<div id="door2-status" class="status-line"></div>
				<div class="activation-button">
			    	<button id="2"><span class="buttonText" id="door2-buttonText">Activate</span><span id="door2-opening" class="door-opening">Wait...</span></button>
				</div>
			</div>
		</div>
		<div class="ui3"><iframe src="http://sol.home/ui3.htm?maximize=1&cam=Garage"></iframe></div>
		<div class="ui3"><iframe src="http://sol.home/ui3.htm?maximize=1&cam=Garage2"></iframe></div>
		<div class="ui3"><iframe src="http://sol.home/ui3.htm?maximize=1&cam=DwySouth"></iframe></div>
		<div id="refresh"><button>Refresh</button></div>
	</body>
</html>
