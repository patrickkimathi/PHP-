<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			background-color: blue;
		}
		table{
			background-color: pink;
		}
	</style>
</head>
<body>


<?php 
// thie new version paginates the query results
$page_title = 'View the Current Patients';
include ('header.php');
echo '<h1> Registered Users</h1>';

require_once('mysql-connect.php');

//Number of records to show per page
$display=10;

//Determine how many pages are there
if(isset($_GET['p']) && is_numeric($_GET['p']))
 {
  $pages = $_GET['p'];   

}
else {
    // Need to determine
    //count the number of records
    $q="SELECT COUNT(patientID) FROM patient";
    $r = mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_NUM );
    $records= $row[0];

     //Calculate the number of pages
     if ($records > $display)
      { //MORE than one page
        $pages= ceil($records/$display);
     }
     else
      {
         $pages =1;
     }
}// End of p IF
//Determine where in the database to start  returning results
if(isset($_POST['s']) && is_numeric($_GET['s']))
{
    $start = $_GET['s'];

}
else
 {
     $start=0;
    
}
 
//Determine the sort---
// Defualt is by registration date
$sort =(isset($_GET['sort']) ) ? $_GET['sort'] : 'rd';

//Determine the sorting order
switch ($sort) {
  case 'ln':
    $order_by ='last_name ASC';
    break;
  case 'fn':
    $order_by= 'first_name ASC';
    break;
  case 'rd':
    $order_by ='registration_date ASC';
   break;
  default:
  $order_by ='registration_date ASC';
  $sort = 'rd';
        break;
}

//Define the query
$q= "SELECT last_name, first_name, DATE_FORMAT(registration_date,' %M %d %Y') AS dr,
 patientID FROM patient ORDER BY registration_date ASC LIMIT $start, $display";
$r= mysqli_query($dbc, $q); //run the query

// Table header
echo '<table width= "60%>
<thead>
<tr>
<th align = "left"><strong>Edit</strong></th>
<th align = "left"><strong>Delete</strong></th>
<th align = "left"><strong><a href ="view_users.php?sort=ln">Last Name</strong></th>
<th align = "left"><strong><a href ="view_users.php?sort=fn">First Name</strong></th>
<th align = "left"><strong><a href ="view_users.php?sort=rd">Date Registered</strong></th>
</tr>
</thead>
<tbody>';
// Fetch and print all the records
$bg= '#eeeeee'; //set bg color
while($row=mysqli_fetch_array($r, MYSQLI_ASSOC))
{
    $bg = ($bg ='#eeeeee' ? '#ffffff' : '#eeeeee'); // swith background color
    
    echo '<tr bgcolor ="'. $bg. '">
    <td align = "left"><a href="edit_user.php?id= '. $row['patientID'].'">Edit</a></td>   
    <td align = "left"><a href="delete_user.php?id= '. $row['patientID'].'"> Delete</a></td>   
    <td align = "left">'.$row['last_name'] . '</td>
    <td align = "left">'.$row['first_name'] . '</td>
    <td align = "left">'.$row['dr'] . '</td>
    </tr>
    ';
}// End of While Loop
echo '</tbody></table>';
mysqli_free_result($r);
mysqli_close($dbc);

//Make the links to other pages, if necessary
if ($pages>1)
 {
   // Add some spacing and start a paragraph
   echo '<br><p>';
   // Determine what page the script is on
   $current_page =($start/$display)+1;

   // if its not the first page, make a Previous link
   if ($current_page != 1)
    {
       echo '<a href = "view_users.php?s='. ($start - $display) . '&p=' .$pages . '&sort='.
       $sort.
    '">Previous</a>';
  }

  //make all the numbered pages
  for ($i=1; $i<= $pages ; $i++)
   { 
    if ($i != $current_page)
     {
        echo '<a href = "view_users.php?s='. (($display * ($i -1))) . '&p='
         .$pages .
        '&sort=' . $sort . '">' . $i . '</a>';
    }
    else {
        echo $i . '';
    }
   
  } //End of FOR LOOP
  // if its not the last page . make the NEXT BUTTON;
  if ($current_page != $pages)
   {
    echo '<a href = "view_users.php?s='. ($start + $display) . '&p=' .$pages . 
    '&sort='. $sort. '">Next</a>';
  }
  echo '</p>'; //close the paragreaph
}// End of links section

include('footer.php');

?>
</body>
</html>
















