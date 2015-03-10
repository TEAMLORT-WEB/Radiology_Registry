<?php

session_start();

$username = $_POST['login'];
$password = $_POST['password'];
echo "$username";

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
           $dbid = $row['person_id'];
           $dbtype=$row['class'];
       }
       if($username==$dbusername&&$password==$dbpassword)
       {
           
           echo "Login successful,heading back to homepage";
           header( "refresh:5; url=/home.php" ); 

           $_SESSION['username']=$dbusername;
           $_SESSION['loginclass']=$dbclass;
           $_SESSION['id']=$dbid;
           $_SESSION['TYPE']=$dbtype;
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