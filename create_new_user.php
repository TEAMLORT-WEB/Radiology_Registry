<html>

<head>

<?php


$username = @$_POST['user_name'];
$password = @$_POST['password'];
$repeatpassword = @$_POST['repeatpassword'];
$usertype =@$_POST['user_type'];
$first_name =@$_POST['first_name'];
$last_name =@$_POST['last_name'];
$address = @$_POST['address'];
$email = @$_POST['email'];
$phone = @$_POST['phone'];
$submit = @$_POST['submit'];


//attempt to include a new ID 
$count = mysqli_query($mysqli,"SELECT COUNT(record_id) as total FROM radiology_record");
$data=mysqli_fetch_assoc($count);
$ID = $data['total']+1;

$mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");


/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


if($submit){
    
    if($username == true)
    {
        
        if($usertype == true)
        {
            if($password == true)
            {
                
                if($password==$repeatpassword)
                {
                    
                    if(strlen($username)<50)
                    {
                        
                        
                        if(strlen($password <50||strlen($password)>5))
                        {
                            
                            $insert=mysqli_query($mysqli,"INSERT INTO users VALUES ('$ID','$username','$encpassword','')");
                            echo "registration successful";
                            if ( false===$insert ) {
                                printf("error: %s\n", mysqli_error($mysqli));
                            }
                            
                            
                            
                        }
                        else
                            echo
                            "password length is between 5 to 50 characters";
                        
                    }
                    else
                        echo "the maximum length for username is 50";
                    
                }
                else
                    echo"you did not successfully repeat your password";
                
            }
            else
                echo "please enter a password";
            
        }
        else    
            echo "no user type selected";
           
    }
    else 
        echo "please enter a username";
}

?>

</head>


<body>
    <form id="form1" method ="post">   
       	<p>Username: <input name ="user_name" type="text" /></p> 
        <p>Password: <input name ="password" type="password" /></p>
        <p>Repeat Password: <input name ="repeatpassword" type="password" /></p>
        <p><input name ="submit" type="submit"/> <INPUT Type="button" VALUE="Cancel and go back" onClick="history.go(-1); return true;"></p>		
    </form>
</body>
</html>
