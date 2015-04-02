<?php
    //require "account_login/login.php";
    Session_start();
    $username = @$_POST['user_name'];
    $password = @$_POST['password'];
    $repeatpassword = @$_POST['repeatpassword'];
    $usertype =@$_POST['user_type'];
    $first_name =@$_POST['first_name'];
    $last_name =@$_POST['last_name'];
    $address = @$_POST['address'];
    $email = @$_POST['email'];
    $phone = @$_POST['phone_number'];
    $submit = @$_POST['submit'];
    $submit_personal = @$_POST['submit_personal'];
    
    if($submit_personal)
    {
        if(isset($_SESSION['id']))
        {
            $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
            $searchID = $_SESSION['id'];
            $new_first_name = mysqli_real_escape_string($mysqli,@$_POST['first_name']);
            $new_last_name = mysqli_real_escape_string($mysqli,@$_POST['last_name']);
            $new_address = mysqli_real_escape_string($mysqli,@$_POST['address']);
            $new_email = mysqli_real_escape_string($mysqli,@$_POST['email']);
            $new_phone = mysqli_real_escape_string($mysqli,@$_POST['phone_number']);
            $sql = "UPDATE `radiology`.`persons` SET `first_name` = "."'".$new_first_name."'".", `last_name` = "."'".$new_last_name."'".", `address` = "."'". $new_address."'".", `email` = "."'".$new_email."'".", `phone` = "."'".$new_phone."'"." WHERE `persons`.`person_id` = "."'".$searchID."'".";";
            $insert=mysqli_query($mysqli,$sql);
            //$mysqli,"UPDATE persons SET first_name = ".$new_first_name.", last_name = ".$new_last_name.", address = ".$new_address.",email = ".$new_email.",phone = ".$new_phone." WHERE 'person_id' = ".$searchID
            
            echo"<script>
                $(function(){
                
                    $.Notify({
                        shadow: true,
                        position: 'bottom-right',
                        style: {background: 'green', color: 'white'},
                        content: 'Update Success'
                    });
             
                });
                </script>";
            
            
            
            
            if ( false===$insert ) {
                printf("error: %s\n", mysqli_error($mysqli));
            }
        }
    }
    //$today = getdate(); 
    if($submit){
        $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
        // $insertquery = mysqli_query($mysqli,"INSERT INTO user VALUES ('$ID','$username','$encpassword','')");
        
        

        
        
        //attempt to include a new ID 
        $count = mysqli_query($mysqli,"SELECT COUNT(person_id) as total FROM users");
        $data=mysqli_fetch_assoc($count);
        $ID = $data['total']+1;
        
        
        
        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        if($username == true)
        {
            
            if($usertype == true)
            {
                if($password == true)
                {
                    if($first_name == true &&$last_name == true)
                    {
                        if($address == true &&$email == true)
                        {
                            if($phone == true)
                            {

                                if(strlen($username)<50)
                                {

                                    if(strlen($password <50||strlen($password)>5))
                                    {
                                        $personal_action =mysqli_query($mysqli,"INSERT INTO persons VALUES ('$ID','$first_name','$last_name','$address','$email','$phone')"); 
                                        if ( false==$personal_action ) {
                                            printf("error: %s\n", mysqli_error($mysqli));
                                        }
                                        else
                                            echo "User account registration successful";
                                       
                                        $insert=mysqli_query($mysqli,"INSERT INTO users VALUES ('$username','$password','$usertype','$ID','CURDATE()')");
                                        if ( false===$insert ) {
                                            printf("error: %s\n", mysqli_error($mysqli));
                                        }
                                        else
                                            echo "Persononal information created successful";
                                        
                                        
                                        
                                    }
                                    else
                                        echo
                                        "password length is between 5 to 50 characters";
                                    
                                }
                                else
                                    echo "the maximum length for username is 50";

                            }
                            else
                                echo "please enter your phone number";
                        }
                        else
                            echo"you need to enter address/email";
                    }
                    else
                        echo "please fill in first/last name";
                    
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


<html>
   <head>
       <link rel="stylesheet" href="metro/css/metro-bootstrap.css">
       <link rel="stylesheet" href="metro/css/iconFont.min.css">
       <link rel="stylesheet" href="metro/css/metro-bootstrap-responsive.css">
       <script src="metro/jquery/jquery.min.js"></script>
       <script src="metro/jquery/jquery.widget.min.js"></script>
       <script src="metro/min/metro.min.js"></script>
       <script src="metro/min/load-metro.js"></script>
       
   </head>
   <body class="metro">
       <div class="grid">
       
       <div id="row0" class="row" >
           <div class="span12">
               <div class="row">
                   <div class ="span4"></div>
                   <div class ="span4 offset2">
                       <a href="home.php"><img src="Assets/AHS_Logo.jpg" alt="Alberta Health Services" height="100px" width ="auto"></a>
                       <?php 
                       
                            if (isset($_SESSION['username']) and isset($_SESSION['id']))
                            {
                                
                            
                               
                                echo  "<h3><p>You're logged in as: </h3>".$_SESSION['username'];echo '</p></h3>';
                                echo  "<h3><p>ID:".$_SESSION['id'];echo'</p></h3>';
                               
                                /***if($_SESSION['class']=='1')
                                {
                                    echo '<div class="tile" data-click="transform">
                                            
                                          </div>';
                                }
                                else if($_SESSION['class'] == '2')
                                {
                                    echo '<div class="tile" data-click="transform"></div>';
                                }
                                else if($_SESSION['class'] == '3')
                                {
                                    echo '<div class="tile" data-click="transform"></div>';
                                }
                                echo "<p></p>";***/
                                echo '<div class="tile">
                                        <div id= "register" class ="tile-content icon bg-darkbrown fg-white">
                                            <i class = "icon-plus-2"></i>
                                                
                                        </div>
                                        <div class="tile-status"><span class ="name">Create New User</span></div>
                                      </div>';
                                      
                                 echo '<div class="tile">
                                         <div class ="tile-content icon bg-blue fg-white">
                                           <a href="account_search.php"> <i class = "icon-pencil"></i></a>
                                                 
                                         </div>
                                         <div class="tile-status"><span class ="name">Edit User Accounts</span></div>
                                       </div>';
                                      
                                      
                                 echo '<div class="tile">
                                         <div id= "editpersonal" class ="tile-content icon bg-pink fg-white">
                                            <i class = "icon-wrench"></i>
                                                 
                                         </div>
                                         <div class="tile-status"><span class ="name">Change Personal Info</span></div>
                                       </div>';
                                      
                                 echo '<div class="tile" data-click="transform" >
                                         <div class ="tile-content icon bg-red fg-white" href ="logout.php">
                                            <a href ="logout.php"><i class = "icon-switch"></i></a>
                                                 
                                         </div>
                                         <div class="tile-status"><span class ="name">Logout</span></div>
                                       </div>';
                                       
                                
                                
                            
                            }
                            else
                                header ("location:  index.html");
                                
                       ?>
                       
        
                   <div class ="span4"></div>
               </div>
           </div>
       </div>
       
       
       
<script type="text/javascript" charset="UTF-8" >
            $(function () {
                $("#editpersonal").on('click', function () {
                    $.Dialog({
                        shadow: true,
                        overlay: false,
                        draggable: true,
                        icon: '<span class="icon-wrench"></span>',
                        title: 'Draggable window',
                        width: 'auto',
                        padding: 10,
                        content: 'This Window is draggable by caption.',
                        onShow: function () {

                            var strVar = "";
                            strVar += "<form id=\"form1\" method =\"post\">   ";
                            strVar += "    <p>First Name: <input name =\"first_name\" type=\"text\" \/><\/p> ";
                            strVar += "    <p>Last Name: <input name =\"last_name\" type=\"text\" \/><\/p> ";
                            strVar += "    <p>Address: <input name =\"address\" type=\"text\" \/><\/p> ";
                            strVar += "    <p>Email: <input name =\"email\" type=\"text\" \/><\/p> ";
                            strVar += "    <p>Phone Number: <input name =\"phone_number\" type=\"text\" \/><\/p> ";
                            strVar += "    <p><input name =\"submit_personal\" type=\"submit\"\/><\/p>";
                            strVar += "</form>";

                            $.Dialog.title("Edit Personal Info");
                            $.Dialog.content(strVar);
                        }

                    });
                });

                
            });
            
      
        </script>              
<script type="text/javascript" charset="UTF-8" >
            $(function () {
                $("#register").on('click', function () {
                    $.Dialog({
                        shadow: true,
                        overlay: false,
                        draggable: true,
                        icon: '<span class="icon-plus-2"></span>',
                        title: 'Draggable window',
                        width: 'auto',
                        padding: 10,
                        content: 'This Window is draggable by caption.',
                        onShow: function () {
                            var strVar="";
                                strVar += "<form id=\"form1\" method =\"post\">   ";
                                strVar += "   	<p>Username: <input name =\"user_name\" type=\"text\" \/><\/p> ";
                                strVar += "   	<p>User Type<\/p> ";
                                strVar += "     <div class=\"input-control select\">";
                                strVar += "         <select name=\"user_type\">";
                                strVar += "             <option value=\"d\">Doctor <\/option>";
                                strVar += "             <option value=\"r\">Radiologist <\/option>";
                                strVar += "             <option value=\"p\">Patient <\/option>";
                                strVar += "             <option value=\"a\">Admin <\/option>";
                                strVar += "         <\/select>";
                                strVar += "     <\/div>";
                                strVar += "    <p>Password: <input name =\"password\" type=\"password\" \/><\/p>";
                                strVar += "    <p>First Name: <input name =\"first_name\" type=\"text\" \/><\/p> ";
                                strVar += "    <p>Last Name: <input name =\"last_name\" type=\"text\" \/><\/p> ";
                                strVar += "    <p>Address: <input name =\"address\" type=\"text\" \/><\/p> ";
                                strVar += "    <p>email: <input name =\"email\" type=\"text\" \/><\/p> ";
                                strVar += "    <p>Phone Number: <input name =\"phone_number\" type=\"text\" \/><\/p> ";
                                strVar += "    <p><input name =\"submit\" type=\"submit\"\/> <button class=\"button\" type=\"button\" onclick=\"$.Dialog.close()\">Cancel<\/button> <\/p>";
                                strVar += "<\/form>";
                                strVar += "";

                            $.Dialog.title("Create New User");
                            $.Dialog.content(strVar);
                        }

                    });
                });

                
            });
            
      
        </script>
        
        



        
        



        
    











        
        