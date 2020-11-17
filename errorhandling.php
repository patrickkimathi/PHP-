<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Error Handling</title>
	<style type="text/css">
		body{
			background-color: red;
		}
	</style>
</head>
<body>
	<?php
	
		 define('LIVE', FALSE);
		 // define eror handling function
		 function my_error_hundler($e_message, $e_number, $e_file, $e_line, $e_vars)
		 {
		 	//Build the error message
		 	$message=" An error occurred on file, $e_file, at line $e_line: $e_message\n";

		 	//Append $e_vars to message
		 	$message .= print_r($e_vars, 1);
		 

		 if (!LIVE) {
		 	echo '<pre>'. $message."\n";
		 	debug_print_backtrace();
		 	echo "</pre><br>";
		 	# code...
		 }elseif ($e_number !=E_NOTICE) {
		 	echo '<div class= "errror" > A System errror has occurred sorry for this.</div><br>';
		 }
		}

	//error handler
     set_error_handler('my_error_hundler');
	
		# code...
	foreach ($var as $v) {}
	$result=1/0;
	?>

</body>
</html>