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
                           <a href="home.html"><img src="Assets/AHS_Logo.jpg" alt="Alberta Health Services" height="100px" width ="auto"></a>
                           <nav class='breadcrumbs'>
                                <ul>
                                    <li><a href='home.php'>Home</a></li>
                                    <li><a href='modifyinfo.php'>Modify User Info</a></li>
                                    <li class='active'><a href='#'>Search for Account to Modify</a></li>
                                </ul>
                           </nav>
                           <form name="search" method="post" action="search_account_backend.php">
                               <label>To perform administrative action on an account, please provide ID</label>
                               <div class="input-control text">
                                   <input type="text" name="id_provided" />
                                   <button class="btn-clear"></button>
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

