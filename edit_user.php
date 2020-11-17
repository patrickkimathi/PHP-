<style type="text/css">
	body {
		background-color:  yellow;
	}
</style>



<?php // <edit_user class=""></edit_user>

//page for editing user record
// THis page is accessed through view_users.php
$page_title = 'Edit a User';
include 'header.php';
echo '<h2>Edit a User</h2>';

//Check for a valid user ID, through GET or POST
if ((isset($_GET['id'])) &&(is_numeric($_GET['id'])))
 {
//from view_users.php
$id= $_GET['id'];
}
elseif ((isset($_POST['id']) &&(is_numeric($_POST['id']))))
 {
     $id= $_POST['id'];
}
else 
{
    // NO valid ID, kill the script
    echo '<p class= "error">This page has been acccessed in error.</p>';
    include ('footer.php');
    exit();
}

require_once('mysql-connect.php');
// Check if the form has been submitted
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $errors = array();
    //Check for first name
    if (empty($_POST['first_name'] ))
     {
       $errors[]= 'You forgot to enter your first name ';
       }
       else
        {
           $fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
       }
       //checks for last name
       if (empty($_POST['last_name'] ))
        {
        $errors= 'You forgot to enter your last name ';
        }
        else
         {
            $ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
         }
         //Check for an email address
         if(empty($_POST['email']))
         {
             $errors= 'You forget to enter you email';
         }
         else 
         {
             $e= mysqli_real_escape_string($dbc, trim($_POST['email']));
         }
         if(empty($errors))
         { // if everything is OK
            //TEST FOE UNIQUE email address
            $q= "SELECT patientID FROM patient WHERE email= '$e'
             AND patientID !=$id";
             $r= mysqli_query($dbc, $q);
            if (mysqli_num_rows($r)==0)
            {
                // Make the Query
                $q = "UPDATE patient SET first_name='$fn' , last_name= '$ln', email='$e'
                WHERE patientID = $id LIMIT 1";
                $r= mysqli_query($dbc, $q);
                if (mysqli_affected_rows ($dbc)==1) 
                {
                     //print a message
                echo '<p> The user has been edited.</p>';
                
                }
               else
            { // if it did not ran ok
                echo '<p class="error">The user could not be edited due to system error.
                We apologize for any inconvenience.</p> '; 
                echo ' <p>' . mysqli_error($dbc) .' <br>Query:  ' .$q . '</p>'  ;                   
            }
         }
         else
          {
             //Already Registered
             echo  '<p class ="error"> The email has already been registered.</p>';
             }
        }
         else
          {     //Report  the Errors
                 echo '<p class= "error"> The following error(s) occurred: <br>';
                 foreach ($errors as $msg) 
                 {
                   //print each error
                   echo " -$msg<br>\n";
                 }
                 echo '</p><p> Please try again.</p>';
            } // End of if (empty($errors)) IF

        }// End of main subconditional.

    // Always show the form
    // Retrieve the user's information;
    $q = "SELECT first_name, last_name, email FROM patient WHERE patientID = $id";
    $r = mysqli_query($dbc, $q);

    if(mysqli_num_rows($r)==1)
     {
         // Valid patient Id , show the form
         
         //Get the  patients information
         $row = mysqli_fetch_array($r, MYSQLI_NUM);

         //Create the form
         echo '<form action= "edit_user.php" method="post">
         <p> First Name: <input type= "text" name= "first_name" size="15" maxlength="20"
         value= " '.$row[0].'"></p>
         <p> Last Name: <input type= "text" name= "last_name" size="15" maxlength="20"
         value= " '.$row[1].'"></p>
         <p> Email Address: <input type= "email" name= "email" size="15" maxlength="60"
         value= " '.$row[2].'"></p>
         <p> <input type= "submit" name="submit" value= "Submit"></p>
         <input type= "hidden" name= "id" value="'.$id .'">
         </form>';
     }
     else
     {
         // Not a valid user ID
         echo '<p class ="error"> THis page has been accessed in error.</p>'; 
     }
mysqli_close($dbc);
include('footer.php');
?>
























