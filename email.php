<html>
    <html lang="en">
        <head>
            <title> Contact Me</title>
        </head>
        <style>
         body{
             background-color: aqua;
             font-family: Arial, Helvetica, sans-serif;
         }
        </style>
        <body>
            <h1>Contact Me</h1>
            <?php //email.php

            //check for form submission
            if ($_SERVER['REQUEST_METHOD']=='POST')
             {
               //minimal form validation 
               if (!empty($_POST['name'] ) && !empty( $_POST['email']) && !empty($_POST['commnets']))
                {
                  // create body
                  $body=" Name: {$_POST['name']}\n\nComments: {$_POST['comments']}";
                  // make it no longer than 70 characters
                  $body = wordwrap($body, 70);

                  // send the email
                  mail('patkimathi12@gmail.com', 'Contact Form Submission', $body, "FROM {$_POST['email']}");
                  // print the message
                  echo '<p><em> Thank you very much for contacting me, I will reply to within the day</em></p>'; 
                   // clear the $_POST so that the form is not sticky
                  $_POST= [];

               }
               else
               {
                   echo '<p style= "font_weight: bold: color: #eeeeee"> Please the form completely</p>';
                                 

               }

            }// End of main isset()

            //create a html form
            ?>

 <p> Please fill this form to contact me</p>
<form  action = "email.php">

<p> Name: <input type= "text" name= "name" size= "10" maxlenght= "60" value="<?php
if (isset($_POST['name']))  echo $_POST['name'];?>"></p>
<p>  Email Address: <input type= "email" name="email" size= "10" maxlenght="50" value ="<?php
if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>
<p> Comments: <textarea name= "comments" row="5" cols = "40"><?php 
if (isset($_POST['comments'])) echo $_POST['comments'];?></textarea></p>
<p><input type="submit" name ="submit" value="SEND"></p>
</form>
        </body>
</html>