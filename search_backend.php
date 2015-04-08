<?php   

session_start();

    if(isset($_SESSION['classes']))
    {
    }
    else
    {
        echo"<script>alert('you re trying to access sensitive information, please login to verify your identity');</script>";
        header ("location: index.html");
        exit;
    }
    
	if(isset($_POST['search_term'])){        	
		
        //To search for two word terms, use double quotes, ie. "last stage". Otherwise search will be for keywords last, and stage.
        
        $searchTerm = $_POST['search_term'];
        
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        
        if(isset($_POST['option'])){
            $option = $_POST['option'];
        } else {
            $option = '';
        }
        
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
        
        //Create a connection
        $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
        
        //For class: patient = 0, doctor = 1, radiologist = 2, admin = 3
        
        if ($_SESSION['classes'] == 'a') 
        {
        //admin can search all records
            $query = "SELECT record_id, patient_id, first_name, last_name, doctor_id, radiologist_id, test_type, prescribing_date, test_date, 
                                 diagnosis, description
                                 FROM
                                 (SELECT *,
                                 ((3*(MATCH(`first_name`) AGAINST ('".$searchTerm."'))) +
                                     (3*(MATCH(`last_name`) AGAINST ('".$searchTerm."'))) +
                                     (3*(MATCH(`diagnosis`) AGAINST ('".$searchTerm."'))) + 
                                     (1*(MATCH(`description`) AGAINST ('".$searchTerm."'))))  AS score
                                     FROM radiology_record, persons
                                     WHERE ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                             (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                             radiology_record.patient_id = persons.person_id) AS TMP
                                             WHERE score > 0
                                             ORDER BY";
            if($noTerms == 1){
                $query = "SELECT *
                          FROM radiology_record
                          WHERE ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                  (`test_date` between '".$start_date."' AND '".$end_date."'))
                          ORDER BY test_date";
                if ($option == "by_t"){
                    $result = mysqli_query($mysqli,$query." DESC");
                } else {
                    $result = mysqli_query($mysqli,$query." ASC");
                }
            
            } else if ($option == 'by_r') {
                $result = mysqli_query($mysqli,$query." score DESC");
            } else if ($option == "by_t") {
                $result = mysqli_query($mysqli,$query." test_date DESC");
            } else {
                $result = mysqli_query($mysqli,$query." test_date ASC");
            }
            
        } else if ($_SESSION['classes'] == 'd'){
        //doctor can only view records of their patients  
            $query = "SELECT record_id, patient_id, first_name, last_name, doctor_id, radiologist_id, test_type, prescribing_date, test_date, 
                             diagnosis, description
                             FROM
                             (SELECT *,
                             ((3*(MATCH(`first_name`) AGAINST ('".$searchTerm."'))) +
                                 (3*(MATCH(`last_name`) AGAINST ('".$searchTerm."'))) +
                                 (3*(MATCH(`diagnosis`) AGAINST ('".$searchTerm."'))) + 
                                 (1*(MATCH(`description`) AGAINST ('".$searchTerm."'))))  AS score
                                 FROM radiology_record, persons
                                 WHERE ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                         (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                         radiology_record.patient_id = persons.person_id AND
                                         `doctor_id` LIKE '".$_SESSION['id']."') AS TMP
                                         WHERE score > 0
                                         ORDER BY";
            if($noTerms == 1){
                $query = "SELECT *
                          FROM radiology_record
                          WHERE ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                  (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                  `doctor_id` LIKE '".$_SESSION['id']."' 
                                  ORDER BY test_date";
                if ($option == "by_t"){
                    $result = mysqli_query($mysqli,$query." DESC");
                } else {
                    $result = mysqli_query($mysqli,$query." ASC");
                }
            
            } else if ($option == 'by_r') {
                $result = mysqli_query($mysqli,$query." score DESC");
            } else if ($option == "by_t") {
                $result = mysqli_query($mysqli,$query." test_date DESC");
            } else {
                $result = mysqli_query($mysqli,$query." test_date ASC");
            }
            
        } else if ($_SESSION['classes'] == 'p') {
        //patient can only view his/her own records
            $query = "SELECT record_id, patient_id, first_name, last_name, doctor_id, radiologist_id, test_type, prescribing_date, test_date, 
                             diagnosis, description
                             FROM
                             (SELECT *,
                             ((3*(MATCH(`first_name`) AGAINST ('".$searchTerm."'))) +
                                 (3*(MATCH(`last_name`) AGAINST ('".$searchTerm."'))) +
                                 (3*(MATCH(`diagnosis`) AGAINST ('".$searchTerm."'))) + 
                                 (1*(MATCH(`description`) AGAINST ('".$searchTerm."'))))  AS score
                                 FROM radiology_record, persons
                                 WHERE ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                         (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                         radiology_record.patient_id = persons.person_id AND
                                         `patient_id` LIKE '".$_SESSION['id']."') AS TMP
                                         WHERE score > 0
                                         ORDER BY";
            if($noTerms == 1){
                $query = "SELECT *
                          FROM radiology_record
                          WHERE ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                  (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                  `patient_id` LIKE '".$_SESSION['id']."' 
                                  ORDER BY test_date";
                if ($option == "by_t"){
                    $result = mysqli_query($mysqli,$query." DESC");
                } else {
                    $result = mysqli_query($mysqli,$query." ASC");
                }
                
            } else if ($option == 'by_r') {
                $result = mysqli_query($mysqli,$query." score DESC");
            } else if ($option == "by_t") {
                $result = mysqli_query($mysqli,$query." test_date DESC");
            } else {
                $result = mysqli_query($mysqli,$query." test_date ASC");
            }
             
        } else if ($_SESSION['classes'] == 'r') {
        //radiologist can only review records conducted by themselves
            $query = "SELECT record_id, patient_id, first_name, last_name, doctor_id, radiologist_id, test_type, prescribing_date, test_date, 
                             diagnosis, description
                             FROM
                             (SELECT *,
                             ((3*(MATCH(`first_name`) AGAINST ('".$searchTerm."'))) +
                                 (3*(MATCH(`last_name`) AGAINST ('".$searchTerm."'))) +
                                 (3*(MATCH(`diagnosis`) AGAINST ('".$searchTerm."'))) + 
                                 (1*(MATCH(`description`) AGAINST ('".$searchTerm."'))))  AS score
                                 FROM radiology_record, persons
                                 WHERE ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                         (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                         radiology_record.patient_id = persons.person_id AND
                                         `radiologist_id` LIKE '".$_SESSION['id']."') AS TMP
                                         WHERE score > 0
                                         ORDER BY";
            if($noTerms == 1){
                $query = "SELECT *
                          FROM radiology_record
                          WHERE ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                  (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                  `radiologist_id` LIKE '".$_SESSION['id']."' 
                                  ORDER BY test_date";
                if ($option == "by_t"){
                    $result = mysqli_query($mysqli,$query." DESC");
                } else {
                    $result = mysqli_query($mysqli,$query." ASC");
                }
                
            } else if ($option == 'by_r') {
                $result = mysqli_query($mysqli,$query." score DESC");
            } else if ($option == "by_t") {
                $result = mysqli_query($mysqli,$query." test_date DESC");
            } else {
                $result = mysqli_query($mysqli,$query." test_date ASC");
            }
            
        } else {
            echo '<br/> Error: Invalid session class, class must be 0, 1, 2 or 3.';
            echo 'sending you back to login page';
            header( "refresh:3; url=/index.html" ); 
            
        }
        if($result==null)    
        {
            echo"<br/> Sorry, no result showes up. Returning you to Search page";
            header("refresh:3;url=/search.php");
            exit;
        }
        $union_result = mysqli_fetch_all($result,MYSQLI_ASSOC)  ; //variable name is union result because of unnecessary processing that used to happen here.
        
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


    <script type="text/javascript">
         function display(imageid,imagedisplay){

                 $.Dialog({
                     flat: false,
                     shadow: true,
                     draggable: true,
                     title: 'Pacs Image, ID: '+imageid,
                     content: '',
                     onShow: function(_dialog){
                        var content = '<img src="data:image/jpeg;base64,'+imagedisplay+'"/>';

                        $.Dialog.content(content);
 
                    }
                     
             });
         }    
    </script>

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
                                        if($union_result!=null)
                                        {
                                            for ($i = 0; $i < count($union_result); $i++){
                                                //Print the columns
                                                
                                                foreach ($union_result[$i] as $key => $value) {
                                                    echo "<th>".$key."</th>";
                                                    
                                                }
                                                echo "<th>images</th>";
                                                break;
                                            }
                                        }                                     
                                        ?>
                                    </tr>
                                    </thead>
                            
                                    <tbody>
                                        <?php 
                                        if($union_result!=null)
                                        {
                                            for ($i = 0; $i < count($union_result); $i++){
                                                //Print the data
                                                echo"<tr>";
                                                foreach ($union_result[$i] as $key => $value) {
                                                    echo "<td>".$value."</td>";
                                                    //Print associated pacs_images
                                                    $result = mysqli_query($mysqli,"SELECT record_id, image_id, thumbnail,regular_size
                                                                 FROM pacs_images
                                                                 WHERE record_id = ".$union_result[$i]['record_id']."");
                                                    $image_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                                                    
                                                }
                                                if(count($image_result)>0)
                                                {
                                                    for ($j = 0; $j < count($image_result); $j++){
                                                        //echo "<td>"."Image ID: ".."</td>";
                                                        $variable = base64_encode($image_result[$j]['regular_size']);
                                                        $new = "&apos;".$variable."&apos;";
                                                        echo "<td>";
                                                        echo "<div class=\"tile\">\n"; 
                                                        echo "    <div onclick='display(".$image_result[$j]['image_id'].",".$new.");' class=\"tile-content image\">\n";
                                                        echo '    <img src="data:image/jpeg;base64,'.base64_encode($image_result[$j]['thumbnail'] ).'"/>'; 
                                                        echo "    </div>\n"; 
                                                        echo "    <div class=\"brand\">\n"; 
                                                        echo "        <span class=\"label bg-steel fg-white\">Image Id:</span>\n"; 
                                                        echo "        <span class=\"badge bg-blue\">".$image_result[$j]['image_id']."</span>\n"; 
                                                        echo "    </div>\n"; 
                                                        echo "</div>\n";
                                                        
                                                        echo "</td>";
                                                        
                                                        
                                                        
                                                        //http://www.andrewdavidson.com/convert-html-to-php/
                                                        //'<img src="data:image/jpeg;base64,'.base64_encode($image_result[$j]['thumbnail'] ).'"/>'
                                                    }
                                                    
                                                }
                                                echo"</tr>";
                                            }       
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

