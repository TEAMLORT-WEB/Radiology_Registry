<?php 
session_start();

if(isset($_SESSION['class']))
{
    if($_SESSION['class'] !='a'&&$_SESSION['class'] !='r')
    {
        echo"<script>alert('you do not authorized to access this page');</script>";
        header ("url=/home.php");
        exit;
    
    }    
}
else
{
    echo"<script>alert('you re trying to access sensitive information, please login to verify your identity');</script>";
    header ("location: index.html");
}

    ?>
<html>
   <head>
       <link rel="stylesheet" href="metro/css/metro-bootstrap.css">
       <script src="metro/jquery/jquery.min.js"></script>
       <script src="metro/jquery/jquery.widget.min.js"></script>
       <script src="metro/min/metro.min.js"></script>
       <script src="metro/min/load-metro.js"></script>
       <script src="metro/js/metro-calendar.js"></script>
       <script src="metro/js/metro-datepicker.js"></script>
       <script src="metro/js/metro-global.js"></script>
       <script>

            $("#datepicker").datepicker();



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
                                    <li class='active'><a href='#'>Upload Test Record</a></li>
                                </ul>
                           </nav>
                           <form name="search" method="POST" action="upload/upload_backend.php"  >
                                    <label>Please enter Doctor_id</label>
                                    <div  class="input-control text" >
                                        <input type="text" name="doctor_id"/>
                                    </div>
                                    <label>Please enter Patient_id</label>
                                    <div  class="input-control text" >
                                        <input type="text" name="patient_id"/>
                                    </div>
                                    <label>Please enter Test Type</label>
                                    <div class="input-control text" >
                                        <input type="text" name="test_type"/>
                                    </div>
                                    <label>When was the test prescribed? YYYY-MM-DD </label>
                                    
                                    
                                    
                                    
                                    
                                        <div class="input-control text" data-role="datepicker" data-format="yyyy/m/d">
                                            <input name="test_date_prescribe" type="text">
                                            <button class="btn-date"></button>
                                        </div>
                               

                                    <br/> 
                                    
                                    
                                    <label>When was the test completed? YYYY-MM-DD </label>
                                    
                                    
                                    
                                   
                                        <div class="input-control text" data-role="datepicker" data-format="yyyy/m/d">
                                            <input name="test_date_completed" type="text">
                                            <button class="btn-date"></button>
                                        </div>
                                    
                                    
                                    
                                    <label>What is the diagnosis?</label>
                                    <div  class="input-control text" >
                                        <input name="test_diagnosis"  type="text" />
                                    </div>
                                    <label>Describe the result?</label>
                                    <div  class="input-control text" >
                                        <input name="test_description" type="text" />
                                    </div>
                                    

                                    
                                    
                                <input name ="submit" type="submit" value="Submit" class="button primary"/>
                                <br><br/>
                                <input name="clear-btn" type="reset" class ="bg-darkRed fg-white" value="Clear"/>
                            </form>
                       </div>
                       <div class ="span4"></div>
                   </div>
               </div>
           </div>
           
       </div>
    </body>
</html>

