<?php

session_start();

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
                                        <div class ="tile-content icon bg-lightBlue fg-white">
                                            <a href ="search.php"><i class = "icon-search"></i></a>
                                                
                                        </div>
                                        <div class="tile-status"><span class ="name">Search</span></div>
                                      </div>';
                                      
                                      
                                 echo '<div class="tile">
                                         <div class ="tile-content icon bg-darkGreen fg-white">
                                             <a href ="upload.php"><i class = "icon-file"></i></a>
                                                 
                                         </div>
                                         <div class="tile-status"><span class ="name">Upload</span></div>
                                       </div>';
                                      
                                      
                                echo '<div class="tile">
                                        <div class ="tile-content icon button bg-darkPink fg-white" id="editusrinfo">
                                            <i class = "icon-cog"></i>
                                                
                                        </div>
                                        <div class="tile-status"><span class ="name">User Settings</span></div>
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
       
       
       
       
       
       
       <script  type="text/javascript" charset="UTF-8" >
            $(function () {
                $("#editusrinfo").on('click', function () {
                    $.Dialog({
                        shadow: true,
                        overlay: false,
                        draggable: true,
                        icon: '<i class = "icon-cog"></i>',
                        title: 'Draggable window',
                        width: 'auto',
                        padding: 10,
                        content: 'This Window is draggable by caption.',
                        onShow: function () {
                            var content = '<form id="login-form-1" action="account/login.php/" method ="POST">' +
                                    '<p>Login</p>' +
                                    '<div class="input-control text"><input type="text" name="login"><button class="btn-clear"></button></div>' +
                                    '<p>Password</p>' +
                                    '<div class="input-control password"><input type="password" name="password"><button class="btn-reveal"></button></div>' +
                                    '<div class="input-control checkbox"><p>Remember Me <input type="checkbox" name="c1" checked/><span class="check"></span></p></div>' +
                                    '<div class="form-actions">' +
                                    '<button class="button primary">Login to...</button>&nbsp;' +
                                    '<button class="button warning" type="button"><a href="account/registration.php">Register</a></button>&nbsp;' +
                                    '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> ' +
                                    '</div>' +
                                    '</form>';

                            $.Dialog.title("Edit User Info");
                            $.Dialog.content(content);
                        }

                    });
                });

                
            });
            
      
        </script>

       </div>
    </body>
</html>