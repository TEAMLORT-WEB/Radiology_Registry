<?php   

session_start();
    
	if(isset($_POST['search_term'])){        	
		
        $searchTerm = $_POST['search_term'];
        
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        
        //Account for empty search terms or date values.
        
        if($searchTerm == ''){
            $noTerms = 1;
        } else {
            $noTerms = 0;
        }
        
        if($start_date == ''){
            $start_date = '0001-01-01';
        } 
        if($end_date == ''){
            $end_date = '9999-01-01';
        } 
        
        $terms = preg_split('/[\s,]+/', $searchTerm);
        
        //Create a connection
        $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
        
        //For class: patient = 0, doctor = 1, radiologist = 2, admin = 3
        
        if ($_SESSION['class'] == 'a') {
        //admin can search all records
            if($noTerms == 1){
                $result = mysqli_query($mysqli,"SELECT *
                                                FROM radiology_record
                                                WHERE ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                                      (`test_date` between '".$start_date."' AND '".$end_date."'))");
            
            } else {
                for ($i = 0; $i < count($terms); $i++){
                    $result = mysqli_query($mysqli,"SELECT *,
                                                    MATCH(`description`) AGAINST ('".$terms[$i]."') AS score
                                                    FROM radiology_record
                                                    WHERE  MATCH(`description`) AGAINST ('".$terms[$i]."') AND
                                                        ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                                        (`test_date` between '".$start_date."' AND '".$end_date."'))");
                }
            }      
            
        } else if ($_SESSION['class'] == 'd'){
        //doctor can only view records of their patients  
            if($noTerms == 1){
                $result = mysqli_query($mysqli,"SELECT *
                                                FROM radiology_record
                                                WHERE ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                                      (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                                      `doctor_id` LIKE '".$_SESSION['id']."' ");
            
            } else {
                for ($i = 0; $i < count($terms); $i++){
                    $result = mysqli_query($mysqli,"SELECT *,
                                                    MATCH(`description`) AGAINST ('".$terms[$i]."') AS score
                                                    FROM radiology_record
                                                    WHERE  MATCH(`description`) AGAINST ('".$terms[$i]."') AND
                                                        ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                                        (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                                        `doctor_id` LIKE '".$_SESSION['id']."' ");
                }
            }
        } else if ($_SESSION['class'] == 'p') {
        //patient can only view his/her own records
            if($noTerms == 1){
                $result = mysqli_query($mysqli,"SELECT *
                                                FROM radiology_record
                                                WHERE ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                                      (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                                      `patient_id` LIKE '".$_SESSION['id']."' ");
            
            } else {
                for ($i = 0; $i < count($terms); $i++){
                    $result = mysqli_query($mysqli,"SELECT *,
                                                    MATCH(`description`) AGAINST ('".$terms[$i]."') AS score
                                                    FROM radiology_record
                                                    WHERE  MATCH(`description`) AGAINST ('".$terms[$i]."') AND
                                                        ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                                        (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                                        `patient_id` LIKE '".$_SESSION['id']."' ");
                }
            }
         
            
        } else if ($_SESSION['class'] == 'r') {
        //radiologist can only review records conducted by themselves
            if($noTerms == 1){
                $result = mysqli_query($mysqli,"SELECT *
                                                FROM radiology_record
                                                WHERE ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                                      (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                                      `radiologist_id` LIKE '".$_SESSION['id']."' ");
            
            } else {
                for ($i = 0; $i < count($terms); $i++){
                    $result = mysqli_query($mysqli,"SELECT *,
                                                    MATCH(`description`) AGAINST ('".$terms[$i]."') AS score
                                                    FROM radiology_record
                                                    WHERE  MATCH(`description`) AGAINST ('".$terms[$i]."') AND
                                                        ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                                        (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                                        `radiologist_id` LIKE '".$_SESSION['id']."' ");
                }
            }
            
        } else {
            echo '<br/> Error: Invalid session class, class must be 0, 1, 2 or 3.';
            echo 'sending you back to login page';
            header( "refresh:3; url=/index.html" ); 
            
        }
            
        
        if(isset($union_result)){
            $new_result = array();
            while ($row = $result->fetch_assoc()) {
                for ($i = 0; $i < count($union_result); $i++){
                    if ($union_result[0]['record_id'] == $row['record_id']){ //Only keep results that satisfy all search terms
                        $new_result[] =  $row;  
                    }
                }
            }
            $union_result = $new_result;
        } else {
            $union_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        
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
        
    </head>
	<body class="metro">
        <div class="grid">
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
                                     <li><a href='search.php'>Search Records</a></li>
                                     <li class='active'><a href='#'>Results</a></li>
                                 </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span10 offset6">
                            <div> 
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <?php
                                            
                                        for ($i = 0; $i < count($union_result); $i++){
                                            //Print the columns
                            
                                            foreach ($union_result[$i] as $key => $value) {
                                                echo "<th>".$key."</th>";
                                                
                                            }
                                            echo "<th>images</th>";
                                            break;
                                        }
                                        ?>
                                    </tr>
                                    </thead>
                            
                                    <tbody>
                                        <?php 
                                        for ($i = 0; $i < count($union_result); $i++){
                                            //Print the data
                                            echo"<tr>";
                                            foreach ($union_result[$i] as $key => $value) {
                                                echo "<td>".$value."</td>";
                                                //Print associated pacs_images
                                                $result = mysqli_query($mysqli,"SELECT record_id, image_id, thumbnail
                                                             FROM pacs_images
                                                             WHERE record_id = ".$union_result[$i]['record_id']."");
                                                $image_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                                                
                                            }
                                            for ($j = 0; $j < count($image_result); $j++){
                                                echo "<td>"."Image ID: ".$image_result[$j]['image_id']."</td>";
                                                echo "<td>".'<img src="data:image/jpeg;base64,'.base64_encode($image_result[$j]['thumbnail'] ).'"/>'."</td>";
                                            }
                                            echo"</tr>";
                                            
                                           
                            
                                        }
                                        
                                        ?>
                                    </tbody>
                            
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>                                 
            </div>
        </div>
	</body>
</html>
