<?php

            $search_diagnosis = $_POST['search_diagnosis'];
            
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            
            if($start_date == ''){
                $start_date = '0001-01-01';
            } 
            if($end_date == ''){
                $end_date = '9999-01-01';
            }
            
            $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
            
            $result = mysqli_query($mysqli,"SELECT persons.first_name, persons.last_name, persons.address, persons.phone
                                            FROM persons, radiology_record
                                            WHERE radiology_record.diagnosis LIKE '$search_diagnosis' AND
                                                  radiology_record.patient_id = persons.person_id");
            
            $fetch_result = mysqli_fetch_all($result,MYSQLI_ASSOC);?>


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

        
    </head>

	<body class="metro">
        <div class="grid">
        
            <div id="row0" class="row" >
                <div class="span12">
                    <div class="row">
                        <div class="span4 offset6">
                            <a href="home.php"><img src="Assets/AHS_Logo.jpg" alt="Alberta Health Services" height="100px" width ="auto"></a>
                        </div>           
                    </div>
                    <div class ="row">
                        <div class="span6 offset6">
                            <nav class='breadcrumbs'>
                                 <ul>
                                     <li><a href='home.php'>Home</a></li>
                                     <li><a href='report.php'>Generate Report</a></li>
                                     <li class='active'><a href='#'>Results</a></li>
                                 </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class ="span3"></div>
                            <div class ="span6 offset2">
                            <div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <?php
                                        for ($i = 0; $i < count($fetch_result); $i++){
                                            foreach ($fetch_result[$i] as $key => $value) {
                                                echo "<th class='text-left'>".$key."</th>";
                                                
                                            }
                                            break;
                                            
                                        }?>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                             for ($i = 0; $i < count($fetch_result); $i++){
                                                 echo"<tr>";
                                                 foreach ($fetch_result[$i] as $key => $value) {
                                                     echo "<td>".$value."</td>";
                                                 }
                                                 echo"</tr>";
                                             }
                                             
                                         ?> 
                                    </tbody>

                                    <tfoot></tfoot>
                                </table>
                            </div>
                        <div class ="span3"></div>
                   </div>
               </div>
           </div>
         </div>    
    </body>
</html>
<!--http://stackoverflow.com/questions/4746079/how-to-create-a-html-table-from-a-php-array-->
