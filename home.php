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
                                              <a href ="modifyinfo.php"><i class = "icon-cog"></i></a>
                                                
                                        </div>
                                        <div class="tile-status"><span class ="name">Modify User Info</span></div>
                                      </div>';
                                      
                                 echo '<div class="tile" data-click="transform" >
                                         <div class ="tile-content icon bg-red fg-white" href ="logout.php">
                                            <a href ="logout.php"><i class = "icon-switch"></i></a>
                                                 
                                         </div>
                                         <div class="tile-status"><span class ="name">Logout</span></div>
                                       </div>';
                                 echo '<div class="tile" data-click="transform" >
                                         <div class ="tile-content icon bg-lime fg-white" href ="report.php">
                                            <a href ="report.php"><i class = "icon-clipboard-2"></i></a>
                                                 
                                         </div>
                                         <div class="tile-status"><span class ="name">Generate Report</span></div>
                                       </div>';
                                 echo '<div class="tile" data-click="transform" >
                                         <div class ="tile-content icon bg-Magenta fg-white" href ="image.php">
                                            <a href ="image.php"><i class = "icon-image"></i></a>
                                                 
                                         </div>
                                         <div class="tile-status"><span class ="name">Upload Pacs Image</span></div>
                                       </div>';
                                
                                
                            
                            }
                            else
                                header ("location:  index.html");
                                
                       ?>
                       
        
                   <div class ="span4"></div>
               </div>
           </div>
       </div>

       </div>
    </body>
</html>