<?php

session_start();


            //get the input
                
$username = $_POST['login'];
$password = $_POST['password'];




if($username&&$password)
{
    
   $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
   
   $query = mysqli_query($mysqli,"SELECT * FROM users WHERE user_name='$username'");
   
   
   $doctor = mysqli_query($mysqli,"select u.person_id from users u WHERE u.user_name='$username'");//"from users u, family_doctor fd where u.user_name = '$username' and u.persion_id = fd.doctor_id");
   
   
   $patient = mysqli_query($mysqli,"select * from users u, family_doctor fd where u.user_name = '$username' and u.persion_id = fd.patient_id");
   $id = mysqli_fetch_assoc($doctor);
   $personid = $id['person_id'];
   $doctor_query = mysqli_query($mysqli,"select doctor_id from family_doctor where doctor_id ='$personid'");
   $doctor_check = mysqli_fetch_assoc($doctor_query);
   $doctor_id = $doctor_check['doctor_id'];
   $numrows = mysqli_num_rows($query);
   //$doctor_result = mysqli_num_rows($doctor);
   //$patient = mysqli_num_rows($patient);
   
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
           print ""+$doctor_id;
           print ""+$patient;
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