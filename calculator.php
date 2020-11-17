
<?php
$page_title= 'Trip cost calculator';
include 'header.html';

//Check for form submission
if ($_SERVER['REQUEST_METHOD']=='POST') {
	

	//minomal form validation
	if (isset($_POST['distance'], $_POST['gallon_price'], $_POST['efficiency']) &&
    is_numeric($_POST['distance'])&& is_numeric($_POST['gallon_price']) && is_numeric($_POST['efficiency'])) {

    	//calculate the results
        $gallons= $_POST['distance']/ $_POST['efficiency'];
        $dollars= $gallons* $_POST['gallon_price'];
        $hours= $_POST['distance']/65;

        // print the results
        echo '<div class ="page-header"><h2>Total estimated cost</h2></div>
        <p> the Total costof driving ' .$_POST['distance']. 'miles driving'. $_POST['efficiency']. 'miles per gallon, and paying an average of '.$_POST['gallon_price'].' per gallon is $'.number_format($dollars,2). '.if you drive at average of 65 miles per hour, the rip will take approximately'.number_format($hours, 2).'hours.</p>';


		# code...
	}else { //invalid submitted values
		echo '<div class= "page-header"<h1> Error</h1>,</div>
		<p class "text-danger"> Please enter a valid distance, price per gallon, and fuel efficiency.</p>';

	}
	
}// END OF MAIN SUBMISSION IF
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			background-color: blue;
		}
	</style>
</head>
<body>
	<div class="page-header"><h1>TRIP COST CALCULATOR</h1></div>
	<form action="calculator.php" method="POST">
		<p>Distanace (in miles): <input type="number" name="distance">  </p>
		<p>Ave. Price per gallon: <input type="radio" name="gallon_price" value="3.00">3.00
			<input type="radio" name="gallon_price" value="3.50">3.50
			<input type="radio" name="gallon_price" value="4.00">4.00</p>


			<p>Fuel efficiency : <select name="efficiency">
				<option value="10">Terrible</option>
				<option value="20"> Decent</option>
				<option value="30"> Very Good</option>
				<option value="40"> Outstanding</option>
			</select></p>
			<p> <input type="submit" name="submit" value="calculate"></p>
</form>
<?php include 'footer.html'; ?>

</body>
</html>




















