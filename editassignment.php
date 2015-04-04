<?php 
    


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
                       </div>
                       <div class ="span7 offset6">
                       
                            <nav class='breadcrumbs'>
                                 <ul>
                                     <li><a href='home.php'>Home</a></li>
                                     <li><a href='modifyinfo.php'>Modify User Info</a></li>
                                     <li class='active'><a href='#'>Change Doctor Patient Assignment</a></li>
                                 </ul>
                            </nav>
                       
                       </div>
                   </div>
               </div>
               <div class="row">
               <div class ="span4"></div>
               <div class ="span4 offset6">
                    <form name="edit" method="post" action="editassignment_backend.php">                  
                        <label>Please enter a doctor's Id to Search</label>
                        <div class="input-control text">
                            <input type="text" name="doctor_id" />
                            <button class="btn-clear"></button>
                        </div>
                        <div class="form-actions">
                            <button class="button primary">Search</button>
                        </div>
                    </form>
               </div>

               </div>
           </div>
           
       </div>
    </body>
</html>

