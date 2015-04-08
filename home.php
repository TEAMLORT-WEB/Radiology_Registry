<?php

session_start();

?>

<html>
   <head>
       <link rel="stylesheet" href="metro/css/metro-bootstrap.css">
       <link rel="stylesheet" href="metro/css/iconFont.min.css">
       <link rel="stylesheet" href="metro/css/metro-bootstrap-responsive.css">
       <script src="metro/jquery/jquery.min.js"></script>
       <script src="metro/js/metro-scroll.js"></script>
       <script src="metro/jquery/jquery.widget.min.js"></script>
       <script src="metro/jquery/jquery.mousewheel.js"></script>                        
       <script src="metro/min/metro.min.js"></script>
       <script src="metro/min/load-metro.js"></script>
       <script type="text/javascript">
            function display(){
       
                    $.Dialog({
                        flat: false,
                        shadow: true,
                        draggable: true,
                        resizable:true,
                        title: 'User Manual',
                        width:1300,
                        height:250,
                        content: '',
                        onShow: function(_dialog){
                           var strVar="";
                                strVar += "<div id='scrollbox1' data-role='scrollbox1' data-scroll='vertical'>";
                                strVar += "<p style='font-size:85%'>";
                                strVar += "391 User Documentation for Sam Bao, Elvis Lo and Liwen Chen";
                                strVar += '<br>';
                                strVar += "Installation Instructions:";
                                strVar += '<br>';
                                strVar += "(Wampserver is being used by the group which only works on windows, for Linux, use Lampserver instead)";
                                strVar += '<br>';
                                strVar += "1. Install wampserver";
                                strVar += '<br>';
                                strVar += "2. Place PHP files inside www folder of wampserver.";
                                strVar += '<br>';
                                strVar += "3. Use phpMyAdmin in wampmanager to submit the query: SET PASSWORD FOR root@localhost = PASSWORD('goodtogo');";
                                strVar += '<br>';
                                strVar += "4. Navigate to C:\wamp\apps\phpmyadmin4.1.14 and open config.inc.php in a text editor.";
                                strVar += '<br>';
                                strVar += "5. Change the password from $cfg['Servers'][$i]['password'] = '' to $cfg['Servers'][$i]['password'] = 'goodtogo'";
                                strVar += '<br>';
                                strVar += "6. Now, under phpMyAdmin create a database named 'radiology'";
                                strVar += '<br>';
                                strVar += "7. Navigate to C:\wamp\www\sql\tables, import these sql files using phpMyAdmin in the order: persons.sql, users.sql, family_doctor.sql, radiology_record.sql,";
                                strVar += '<br>';
                                strVar += "   pacs_images.sql";
                                strVar += '<br>';
                                strVar += "8. Start services with wampserver to run the server, the server can now be reached through localhost.";
                                strVar += '<br>';
                                strVar += '<br>';
                                strVar += "User Manual: (Note, some components are only accessible to radiologists and\/or admins, see project report for specifics)";
                                strVar += '<br>';
                                strVar += "---Search---";
                                strVar += '<br>';  
                                strVar += "Choose to order results by most recent, by least recent or by relevancy via the radio buttons. Enter search terms into search separated by space, ";
                                strVar += '<br>';
                                strVar += "eg. search term, to search for a term that includes spaces, use double quotes, ie. \"search term\". Click the box labeled \"Search from records between:\" ";
                                strVar += '<br>';
                                strVar += "and the one below it to specify a range of dates to search in between, the first box must be a earlier date than the second box or no records will display.";
                                strVar += '<br>';
                                strVar += "Either the search term box or the date range boxes can be left blank to search for all records between a timeframe or to search in a range of all time.";
                                strVar += '<br>';
                                strVar += "---Uploading images---";
                                strVar += '<br>';
                                strVar += "Enter the record if the image belongs to, and then chooes a file by clicking the box labeled \"Upload your image\" and selecting your image file.";
                                strVar += '<br>';
                                strVar += "---Uploading records---";
                                strVar += '<br>';
                                strVar += "Enter details for the record to be uploaded into each box, upon pressing the date boxes, a calender dialog can be used to select dates.";
                                strVar += '<br>';
                                strVar += "---Generating report---";
                                strVar += '<br>';
                                strVar += "Enter a diagnosis result to search for, and use the calender boxes to pick a range to search in between. The first date must be earlier than the second date or";
                                strVar += '<br>';
                                strVar += "no records will be displayed. Date boxes can be left blank to search for records of all time.";
                                strVar += '<br>';
                                strVar += "---Data analysis ---";
                                strVar += '<br>';
                                strVar += "Enter a diagnosis result to search for, and use the calender boxes to pick a range to search in between. The first date must be earlier than the second date or";
                                strVar += '<br>';
                                strVar += "no records will be displayed. These boxes must be filled. Press search, wait for the page to load and then use the various check boxes and radio buttons ";
                                strVar += '<br>';
                                strVar += "to choose to display by patient, by test type, by both, or neither, in a time frame of weekly, monthly or yearly.";
                                strVar += '<br>';
                                strVar += "---modify user info---";
                                strVar += '<br>';
                                strVar += "Modify user info is consist of 5 sections";
                                strVar += '<br>';
                                strVar += "Create New User(Admin Only)";
                                strVar += '<br>';
                                strVar += "Change Family Doctor info(Admin Only)";
                                strVar += '<br>';
                                strVar += "Change Doctor Patient Assignment";
                                strVar += '<br>';
                                strVar += "		Edit";
                                strVar += '<br>';
                                strVar += "		Add";
                                strVar += '<br>';
                                strVar += "		Delete";
                                strVar += '<br>';
                                strVar += "Edit User Accounts(Admin Only)";
                                strVar += '<br>';
                                strVar += "	Enter a user id to modify information about that user";
                                strVar += '<br>';
                                strVar += "Change Personal Info(avaliable to everyone)";
                                strVar += '<br>';
                                strVar += "	Able to change all personal information";
                                strVar += "</p>";
                                strVar += "</div>";


       
                           $.Dialog.content(strVar);
                           $.Metro.initInputs();
                       }
                        
                });
            }    
            $(function(){
                $("#scrollbox1").scrollbar({
                    height: 355,
                    axis: 'y'
                });
            });
       </script>

   </head>
   <body class="metro">
       <div class="grid">
       
       <div id="row0" class="row" >
           <div class="span12">
               <div class ="row">
                   <div class ="span4 offset6">
                       <a href="home.php"><img src="Assets/AHS_Logo.jpg" alt="Alberta Health Services" height="100px" width ="auto"></a>
                   </div>
               </div>
               <div class="row">
                   <div class ="span4"></div>
                   <div class ="span6 offset2">              
                       <?php 
                       
                            if (isset($_SESSION['username']) and isset($_SESSION['id']))
                            {
                                
                            
                               
                                echo  "<h3><p>You're logged in as: </h3>".$_SESSION['username'];echo '</p></h3>';
                                echo  "<h3><p>ID:".$_SESSION['id'];echo'</p></h3>';
                                //echo  $_SESSION['classes'];
                                echo '<div class="tile">
                                        <div class ="tile-content icon bg-lightBlue fg-white">
                                            <a href ="search.php"><i class = "icon-search"></i></a>
                                                
                                        </div>
                                        <div class="tile-status"><span class ="name">Search Records By Description</span></div>
                                      </div>';
                                echo '<div class="tile" data-click="transform" >
                                        <div onclick ="display();" class ="tile-content icon bg-lime fg-white">
                                            <i class = "icon-clipboard-2"></i>
                                                
                                        </div>
                                        <div class="tile-status"><span class ="name">User Manual</span></div>
                                      </div>';
                                if($_SESSION['classes'] == 'r' or $_SESSION['classes']=='a')
                                {
                                    echo '<div class="tile" data-click="transform" >
                                            <div class ="tile-content icon bg-Magenta fg-white" href ="image.php">
                                               <a href ="image.php"><i class = "icon-image"></i></a>
                                                    
                                            </div>
                                            <div class="tile-status"><span class ="name">Upload Pacs Image</span></div>
                                          </div>';
                                }
                                if($_SESSION['classes'] == 'r' or $_SESSION['classes']=='a')
                                {
                                    echo '<div class="tile">
                                            <div class ="tile-content icon bg-darkGreen fg-white">
                                                <a href ="upload.php"><i class = "icon-file"></i></a>
                                                    
                                            </div>
                                            <div class="tile-status"><span class ="name">Upload Records</span></div>
                                          </div>';
                                }
                                if($_SESSION['classes']=='a')
                                {
                                          
                                    echo '<div class="tile" data-click="transform" >
                                            <div class ="tile-content icon bg-lime fg-white" href ="report.php">
                                               <a href ="report.php"><i class = "icon-clipboard-2"></i></a>
                                                    
                                            </div>
                                            <div class="tile-status"><span class ="name">Generate Report</span></div>
                                          </div>';
                                    echo '<div class="tile" data-click="transform" >
                                            <div class ="tile-content icon bg-mauve fg-white" href ="analysis.php">
                                               <a href ="analysis.php"><i class = "icon-pie"></i></a>
                                                    
                                            </div>
                                            <div class="tile-status"><span class ="name">Data analysis</span></div>
                                          </div>';      
                                }      
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
                            
                            }
                            else
                                header ("location:  index.html");
                                
                       ?>
                       
        
               </div>
           </div>
       </div>

       </div>
    </body>
</html>