<?php

session_start();


            //get the input
                
$username = $_POST['login'];
$password = $_POST['password'];




if($username&&$password)
{
    
   $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
   
   $query = mysqli_query($mysqli,"SELECT * FROM users WHERE user_name='$username'");
   $numrows = mysqli_num_rows($query);
   
   if($numrows != 0)
   {
       while($row = mysqli_fetch_assoc($query))
       {
           $dbusername = $row['user_name'];
           $dbpassword = $row['password'];
           $dbtype=$row['class'];
       }
       if($username==$dbusername&&$password==$dbpassword)
       {
           
           echo "Login successful,heading back to homepage";
           header( "refresh:5; url=/home.php" ); 

           $_SESSION['username']=$dbusername;
           $_SESSION['class']=$dbtype;

       }
       else
           echo" Incorrect password";
   }
   else
      die("That username doesn't exist");
}
else
    die("Please enter a username");

?>