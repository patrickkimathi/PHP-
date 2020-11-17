

<?php 
$page_title = 'Delete a user';
include ('header.php');
echo '<h1> Delete a user</h1>';

//check for a valid ID using GET or POST

if ((isset($_GET['id'])) && (is_numeric($_GET['id'])))
 { 
 //from <view_users class="php"></view_users>
    $id= $_GET['id'];
      
}
elseif ((isset($_POST['id'])) && (is_numeric($_POST['id'])))
 {
    $id= $_POST['id'];
}
else 
{ #no valid id , kill the script
    echo '<p class= "error"> This  page has been accesed in errro.</p>';
    include  ('footer.php');
    exit();
 }
  require_once ('mysql-connect.php');

  // Beginning of the main submit conditional.
 //Check if the form has been submitted
if (isset($_POST['submitted']))
 {
    if($_POST['sure']=='Yes')
    { 
    // Delete the record
    // Make the query
    $q= "DELETE FROM patient WHERE patientID=$id LIMIT 1";
    $r= mysqli_query($dbc, $q);
    if (mysqli_affected_rows($dbc)==1) 
    {
        //print message
        echo '<p>The patient has been deleted. </p>';
    } else 
    { // if the query did not ran
        echo '<p class= "error"> The patient could not be deleted due to a system error.</p>';
        //Public message
        echo '<p>' .mysqli_error($dbc). '<br>Query:' .$q. '</p>'; //Debugging
    }
    }
    else
    {
     // No confirmation of deletion
        echo '<p> The user has NOT been deleted.</p>';
    }
    
    }else 
    {
     //Retrieve the user's information
     $q= "SELECT CONCAT ( last_name, ', ', first_name) FROM patient WHERE patientID=$id";
     $r= mysqli_query($dbc, $q);

     if (mysqli_num_rows($r)==1) 
     { //Valid patient id
        //Get patient's inforamtion
        $row= mysqli_fetch_array($r, MYSQLI_NUM);

        //Display the record being displayed
        echo "<h3> Name: $row[0]</h3>
        Are you sure you want to delete thee patient?";

        //create the form
        echo '<form action="delete_user.php" method= "post">
        <input type ="radio" name= "sure" value="Yes">  Yes
        <input type ="radio" name= "sure" value="No" checked="checked">No
        <input type ="submit" name= "submit" value="Submit">
        <input type ="hidden" name= "id" value=" '.$id .'">
        </form>';
     }else { //Not a valid user id
        echo '<p class = "error">This page has been accessed in error.</p>';
                
     }
}// End OF MAIN SUBMISSION CONDITIONAL
 mysqli_close($dbc);
 include ('footer.php');
?>




