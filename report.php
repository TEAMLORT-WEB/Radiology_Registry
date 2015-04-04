<?php 
    
    if(!(isset($_SESSION['username']) and isset($_SESSION['id'])))
    {
        echo"<script>alert('you're trying to access sensitive information, please login to verify your identity');</script>";
        header ("url=/index.html");
        }
    if($_SESSION['class'] !='a')
    {
        echo"<script>alert('you do not authorized to access this page');</script>";
        header ("url=/home.php");
    }          
    


    ?>
<html>
   <head>
       <link rel="stylesheet" href="metro/css/metro-bootstrap.css">
       <link rel="stylesheet" href="metro/css/iconFont.css">
       <script src="metro/jquery/jquery.min.js"></script>
       <script src="metro/jquery/jquery.widget.min.js"></script>
       <script src="metro/min/metro.min.js"></script>
       <script src="metro/min/load-metro.js"></script>
       <script src="metro/js/metro-calendar.js"></script>
       <script src="metro/js/metro-locale.js"></script>
       <script src="metro/js/metro-datepicker.js"></script>
       <script src="metro/js/metro-global.js"></script>
       <script>
       
            $("#datepicker").datepicker(
            {
            inline: true,  
            showOtherMonths: true,  }

            
            );
       
       
       
       </script>
       
   </head>
   <body class="metro">
       <div class="grid">

           <div id="row0" class="row" >
               <div class="span12">
                   <div class="row">
                       <div class ="span4"></div>
                       <div class ="span4 offset2">
                           <a href="home.php"><img src="Assets/AHS_Logo.jpg" alt="Alberta Health Services" height="100px" width ="auto"></a>
                           <nav class='breadcrumbs'>
                                <ul>
                                    <li><a href='home.php'>Home</a></li>
                                    <li class='active'><a href='#'>Generate Report</a></li>
                                </ul>
                           </nav>
                           <form name="search" method="post" action="report_backend.php">
                               <label>Please enter the diagnosis result you wish to generate report for</label>
                               <div class="input-control text">
                                   <input type="text" name="search_diagnosis" />
                                   <button class="btn-clear"></button>
                               </div>
                               <label>Generate report from records between:</label>
                               <div class="input-control text" data-role="datepicker" data-format="yyyy/m/d" data-locale='en'>
                                   <input name="start_date" type="text">
                                   <button class="btn-date"></button>
                               </div>
                               <label>And</label>
                               <div class="input-control text" data-role="datepicker" data-format="yyyy/m/d" data-locale='en'>
                                   <input name="end_date" type="text">
                                   <button class="btn-date"></button>
                               </div>
                               <div class="form-actions">
                                   <button class="button primary">Search</button>
                               </div>
                           </form>
                       </div>
                       <div class ="span4"></div>
                   </div>
               </div>
           </div>
           
       </div>
    </body>
</html>

