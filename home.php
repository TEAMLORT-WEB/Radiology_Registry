<?php

session_start();




if (isset($_SESSION['username']) and isset($_SESSION['class']))
{
    
    echo "you're logged in as:".$_SESSION['username'];
    echo "you are: ".$_SESSION['class'];
    echo "<p>";
    echo "<a href='logout.php'>Click here to logout</a>";
    
}
else
    header ("location:  index.html");


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


       </div>
    </body>
</html>