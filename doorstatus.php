<?php
/* 

DOORSTATUS.PHP
v 1.1
   
   Requires wiringPi on the Raspberry Pi 
   
   If not already installed as a pacakge, you can install from source with these commands:
   
      git clone git://git.drogon.net/wiringPi
      cd wiringPi
      git pull origin
      ./build
      
   And then you can see if it's working with these commands: 
      gpio -v
      gpio readall

*/

error_reporting(E_ALL);
	//WiringPi pinouts https://pinout.xyz/
	if(isset($_GET['gpio']) && isset($_GET['door']) == 1) {
		$gpioNumber = $_GET['gpio'];
		$doorNumber = $_GET['door'];
	}

	//Set the pins to in and set the internal pullup resistor
	exec ('gpio mode ' . $gpioNumber . ' in');
	exec ('gpio mode ' . $gpioNumber . ' up');

	//Read the state
	exec ('gpio read ' . $gpioNumber, $doorStatusReading, $doorStatusError);

	// Assign open or closed status depending upon the reading
	if(is_array($doorStatusReading) && $doorStatusError == 0) {
		if( $doorStatusReading[0] == 0 ) {
			$doorStatus = "Open";
		} else if ($doorStatusReading[0] == 1) {
			$doorStatus = "Closed";
		} else {
			$doorStatus = 'Error Reading';
		}
	} else {
		$doorStatus = 'Unknown';
	}//end if(is_array($doorStatusReading))
?>

<div id="door<?php echo $doorNumber; ?>-status">
	 Status: <?php echo $doorStatus; ?>
</div>
