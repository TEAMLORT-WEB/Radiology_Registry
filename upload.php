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
                           <form name="search" method="post" action="upload_backend">
                                <fieldset>
                                    <label>Please enter Doctor_id</label>
                                    <div name="doctor_id" class="input-control text" >
                                        <input type="text" />
                                    </div>
                                    <label>Please enter Patient_id</label>
                                    <div name="patient_id" class="input-control text" >
                                        <input type="text" />
                                    </div>
                                    <label>Please enter Test Type</label>
                                    <div name="test_type" class="input-control text" >
                                        <input type="text" />
                                    </div>
                                    <label>When was the test prescribed? YYYY-MM-DD </label>
                                    <div name="test_date_prescribe" class="input-control text" >
                                        <input name ="date" type="datetime-local">
                                    </div>
                                    <label>When was the test completed? YYYY-MM-DD </label>
                                    <div name="test_date_completed" class="input-control text" >
                                        <input name ="date" type="datetime-local">
                                    </div>
                                    <label>What is the diagnosis?</label>
                                    <div name="test_diagnosis" class="input-control text" >
                                        <input type="text" />
                                    </div>
                                    <label>Describe the result?</label>
                                    <div name="test_description" class="input-control text" >
                                        <input type="text" />
                                    </div>
                                   
                                
                                
                                
                                
                                <div class="form-actions">
                                   <button class="button primary">Submit</button>
                               </div>
                               <a href="upload.php">
                                   <input type="button secondary" value="Cancel and clear all values" />
                               </a>
                            </form>
                       </div>
                       <div class ="span4"></div>
                   </div>
               </div>
           </div>
           
       </div>
    </body>
</html>

