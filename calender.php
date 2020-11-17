<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title> Calender</title>	
	<style type="text/css">
		body{
			background-color: blue;

		}
	</style>
</head>
<body>
	<form action="Calender.php" method="POST">
		<?php #Calender.php
		//make months array
		$months=[1=>'January', 'February', 'March' , 'April','May', 'JUne','July', 'August','September', 'Octomber', 'November','December'];

		//make days and years arrays
		//$days=range(1, 31);
		//$years=range(2019, 2029);

		//make months pull-down menu
		echo '<select name="month">';
		foreach ($months as $key => $value) {
			echo "<option value=\"$value\">
			$value</option>\n";
		}
		echo '</select>';

		//make days pull-down menu
		echo '<select name= "day"';
		//foreach ($days as $key => $value) {
		for ($day=0; $day <=31; $day++) { 
		
			echo "<option value=\"$day\">
			$day</option>\n";
		}
		echo '</select> ';

		// make years pull-down menu
		echo '<select name= "year">';
		//foreach ($years as $key => $value) {
		for ($year=2019; $year <=2029; $year++) { 
			echo "<option value=\"$year\">
			$year</option>\n";
		}
		echo'</select>';
	?>

</body>
</html>