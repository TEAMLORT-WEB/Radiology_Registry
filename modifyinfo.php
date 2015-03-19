<?php
    //require "account_login/login.php";
    Session_start();
    $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
   // $insertquery = mysqli_query($mysqli,"INSERT INTO user VALUES ('$ID','$username','$encpassword','')");

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
                                         <div class ="tile-content icon bg-pink fg-white">
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
                                strVar += "<form id=\"form1\" method =\"post\" action =\"create_new_user.php\">   ";
                                strVar += "   	<p>Username: <input name =\"user_name\" type=\"text\" \/><\/p> ";
                                strVar += "    <p>Password: <input name =\"password\" type=\"password\" \/><\/p>";
                                strVar += "    <p>Repeat Password: <input name =\"repeatpassword\" type=\"password\" \/><\/p>          ";
                                strVar += "    <p>First Name: <input name =\"first_name\" type=\"text\" \/><\/p> ";
                                strVar += "    <p>Last Name: <input name =\"last_name\" type=\"text\" \/><\/p> ";
                                strVar += "    <p>Address: <input name =\"address\" type=\"text\" \/><\/p> ";
                                strVar += "    <p>email: <input name =\"email\" type=\"text\" \/><\/p> ";
                                strVar += "    <p>Username: <input name =\"phone number\" type=\"text\" \/><\/p> ";
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
        
        
        
        
        
        
        
        
        
        
        