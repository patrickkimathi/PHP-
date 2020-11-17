<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>My Website</title>
</head>
<body>
	<!--first.php -->
	<p>This is standard HTML.</p>
	<p><b>Developing Dynamic Website using php</b></p>
	<?php
	echo "This was generated using PHP";
	$file=$_SERVER['SCRIPT_FILENAME'];
	$user= $_SERVER['HTTP_USER_AGENT'];
	$server= $_SERVER['SERVER_SOFTWARE'];
	//print the name of this script
	echo "<p>You are running the file:<br></strong>$file</strong>.</p>\n";
	echo "<p>You are viewing this page:<br><strong>$user</strong>.</p>\n";
	echo "<P> The server is running:<br><strong>$server</strong>.</p>\n";
	// Create php variable d
	$firstname= "Makara";
	$lastname= "Junior";
	$book= "Cold Flying Pan ";
	$author= $firstname.' ' .$lastname;

	//print the variables
	echo "<p>The book<em>$book</em> was written by\n $author.</p>";

	//concatenating strings
	$city= "Nairobi";
	$state ="Kenya";
	$address= $city.' '.$state;
	$addlen= strlen($address);
	//printing the strings
	echo "<p>The author<strong>$author</strong> lives in $address.</p>\n";

	// Calculate the length of the string
	$snum= strlen("coding php is really enjoyable");
	echo "<p>the length of the string is<p>";
	// defining constants
	define('USERNAME', 'truocity');
	define('PI', '3.14');
	define('TODAY', 'JAN 24,2019');

	echo '<p>Today is '.TODAY.
	'<br> This server is running version<strong>'.PHP_VERSION.
	'</strong>of PHP on the <strong>'.PHP_OS.
	'</strong>operating syetem.</p>';

	// Arrays-- array() function
	$days= $arrayName = array(1 => 'SUN', 'MON', '
		TUE', 'WED','THUR' ,'FRI' ,'SAT' );
	echo $days[4];

	// Array of  sequential numbers
	$sequent=range(1, 20);
	

	

	

	?>

</body>
</html>