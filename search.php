<?php 
    


    ?>
<html>
   <head>
       <link rel="stylesheet" href="metro/css/metro-bootstrap.css">
       <script src="metro/min/jquery/jquery.min.js"></script>
       <script src="metro/min/jquery/jquery.widget.min.js"></script>
       <script src="metro/min/metro/metro.min.js"></script>
   </head>
   <body class="metro">
       <div class="grid">

           <div id="row0" class="row" >
               <div class="span12">
                   <div class="row">
                       <div class ="span4"></div>
                       <div class ="span4 offset2">
                           <a href="index.html"><img src="Assets/AHS_Logo.jpg" alt="Alberta Health Services" height="100px" width ="auto"></a>
                           <form name="search" method="post" action="search_backend.php">
                           
                                <label>Please enter keyword</label>
                                <div name="search_term" class="input-control text" method="post" >
                                    <input type="text" />
                                    
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

