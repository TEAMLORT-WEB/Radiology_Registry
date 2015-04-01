<html>
	<body>
	<?php   
    
    session_start();
        
		if(isset($_POST['search_term'])){        	
			
            $searchTerm = $_POST['search_term'];
            
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            
            $terms = preg_split('/[\s,]+/', $searchTerm);
            
            //Create a connection
            $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
            
            //For class: patient = 0, doctor = 1, radiologist = 2, admin = 3
            
            if ($_SESSION['class'] == 'a') {
            //admin can search all records
                for ($i = 0; $i < count($terms); $i++){
                    $result = mysqli_query($mysqli,"SELECT *,
                                                    MATCH(`description`) AGAINST ('".$terms[$i]."') AS score
                                                    FROM radiology_record
                                                    WHERE  MATCH(`description`) AGAINST ('".$terms[$i]."') AND
                                                        ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                                        (`test_date` between '".$start_date."' AND '".$end_date."'))");
                    if(isset($union_result)){
                        $new_result = array();
                        while ($row = $result->fetch_assoc()) {
                            for ($i = 0; $i < count($union_result); $i++){
                                if ($union_result[$i]['record_id'] == $row['record_id']){ //Only keep results that satisfy all search terms.
                                    $new_result[] =  $row;  
                                }
                            }
                        }
                        $union_result = $new_result;
                    } else {
                        $union_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    }
                }
                
                for ($i = 0; $i < count($union_result); $i++){
                    //Print a radiology record row
                    foreach ($union_result[$i] as $key => $value) {
                        echo " $key: $value";
                    }
                    echo "<br>";
                    //Print associated pacs_images
                    $result = mysqli_query($mysqli,"SELECT record_id, image_id, thumbnail
                                                         FROM pacs_images
                                                         WHERE record_id = ".$union_result[$i]['record_id']."");
                    $image_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    for ($j = 0; $j < count($image_result); $j++){
                        echo "Image ID: ".$image_result[$j]['image_id'];
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($image_result[$j]['thumbnail'] ).'"/>';
                        echo "<br>";
                    }
                    echo "<br>";
                }
                
            } else if ($_SESSION['class'] == 'd'){
            //doctor can only view records of their patients                
                for ($i = 0; $i < count($terms); $i++){
                    $result = mysqli_query($mysqli,"SELECT *,
                                                    MATCH(`description`) AGAINST ('".$terms[$i]."') AS score
                                                    FROM radiology_record
                                                    WHERE  MATCH(`description`) AGAINST ('".$terms[$i]."') AND
                                                        ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                                        (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                                        `doctor_id` LIKE '".$_SESSION['id']."' ");
                    if(isset($union_result)){
                        $new_result = array();
                        while ($row = $result->fetch_assoc()) {
                            for ($i = 0; $i < count($union_result); $i++){
                                if ($union_result[0]['record_id'] == $row['record_id']){ //Only keep results that satisfy all search terms.
                                    $new_result[] =  $row;  
                                }
                            }
                        }
                        $union_result = $new_result;
                    } else {
                        $union_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    }
                }
                
                for ($i = 0; $i < count($union_result); $i++){
                    //Print a radiology record row
                    foreach ($union_result[$i] as $key => $value) {
                        echo " $key: $value";
                    }
                    echo "<br>";
                    //Print associated pacs_images
                    $result = mysqli_query($mysqli,"SELECT record_id, image_id, thumbnail
                                                         FROM pacs_images
                                                         WHERE record_id = ".$union_result[$i]['record_id']."");
                    $image_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    for ($j = 0; $j < count($image_result); $j++){
                        echo "Image ID: ".$image_result[$j]['image_id'];
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($image_result[$j]['thumbnail'] ).'"/>';
                        echo "<br>";
                    }
                    echo "<br>";
                }

            } else if ($_SESSION['class'] == 'p') {
            //patient can only view his/her own records
                for ($i = 0; $i < count($terms); $i++){
                    $result = mysqli_query($mysqli,"SELECT *,
                                                    MATCH(`description`) AGAINST ('".$terms[$i]."') AS score
                                                    FROM radiology_record
                                                    WHERE  MATCH(`description`) AGAINST ('".$terms[$i]."') AND
                                                        ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                                        (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                                        `patient_id` LIKE '".$_SESSION['id']."' ");
                    if(isset($union_result)){
                        $new_result = array();
                        while ($row = $result->fetch_assoc()) {
                            for ($i = 0; $i < count($union_result); $i++){
                                if ($union_result[0]['record_id'] == $row['record_id']){ //Only keep results that satisfy all search terms.
                                    $new_result[] =  $row;  
                                }
                            }
                        }
                        $union_result = $new_result;
                    } else {
                        $union_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    }
                }
                
                for ($i = 0; $i < count($union_result); $i++){
                    //Print a radiology record row
                    foreach ($union_result[$i] as $key => $value) {
                        echo " $key: $value";
                    }
                    echo "<br>";
                    //Print associated pacs_images
                    $result = mysqli_query($mysqli,"SELECT record_id, image_id, thumbnail
                                                         FROM pacs_images
                                                         WHERE record_id = ".$union_result[$i]['record_id']."");
                    $image_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    for ($j = 0; $j < count($image_result); $j++){
                        echo "Image ID: ".$image_result[$j]['image_id'];
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($image_result[$j]['thumbnail'] ).'"/>';
                        echo "<br>";
                    }
                    echo "<br>";
                }
                
            } else if ($_SESSION['class'] == 'r') {
            //radiologist can only review records conducted by themselves
                for ($i = 0; $i < count($terms); $i++){
                    $result = mysqli_query($mysqli,"SELECT *,
                                                    MATCH(`description`) AGAINST ('".$terms[$i]."') AS score
                                                    FROM radiology_record
                                                    WHERE  MATCH(`description`) AGAINST ('".$terms[$i]."') AND
                                                        ((`prescribing_date` between '".$start_date."' AND '".$end_date."') OR
                                                        (`test_date` between '".$start_date."' AND '".$end_date."')) AND
                                                        `radiologist_id` LIKE '".$_SESSION['id']."' ");
                    if(isset($union_result)){
                        $new_result = array();
                        while ($row = $result->fetch_assoc()) {
                            for ($i = 0; $i < count($union_result); $i++){
                                if ($union_result[0]['record_id'] == $row['record_id']){ //Only keep results that satisfy all search terms.
                                    $new_result[] =  $row;  
                                }
                            }
                        }
                        $union_result = $new_result;
                    } else {
                        $union_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    }
                }
                
                for ($i = 0; $i < count($union_result); $i++){
                    //Print a radiology record row
                    foreach ($union_result[$i] as $key => $value) {
                        echo " $key: $value";
                    }
                    echo "<br>";
                    //Print associated pacs_images
                    $result = mysqli_query($mysqli,"SELECT record_id, image_id, thumbnail
                                                         FROM pacs_images
                                                         WHERE record_id = ".$union_result[$i]['record_id']."");
                    $image_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    for ($j = 0; $j < count($image_result); $j++){
                        echo "Image ID: ".$image_result[$j]['image_id'];
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($image_result[$j]['thumbnail'] ).'"/>';
                        echo "<br>";
                    }
                    echo "<br>";
                }
                
            } else {
                echo '<br/> Error: Invalid session class, class must be 0, 1, 2 or 3.';
            }
            
		}	
	
		?>
	</body>
</html>
