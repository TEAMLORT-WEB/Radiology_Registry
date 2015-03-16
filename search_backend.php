<html>
	<body>
	<?php   
    
    session_start();
        
		if(isset($_POST['search_term'])){        	
			
            $searchTerm = $_POST['search_term'];
            
            $terms = preg_split('/[\s,]+/', $searchTerm);
            
            //Create a connection
            $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
            
            //Insert note on which number is patient, doctor, or radiologist.
            
            if ($_SESSION['username'] == 'admin') {
            //admin can search all records
                for ($i = 0; $i < count($terms); $i++){
                    $result = mysqli_query($mysqli,"select * 
                                                   from radiology_record
                                                   WHERE `record_id` LIKE '%".$terms[$i]."%' OR
                                                         `patient_id` LIKE '%".$terms[$i]."%' OR
                                                         `doctor_id` LIKE '%".$terms[$i]."%' OR
                                                         `radiologist_id` LIKE '%".$terms[$i]."%' OR
                                                         `test_type` LIKE '%".$terms[$i]."%' OR
                                                         `prescribing_date` LIKE '%".$terms[$i]."%' OR
                                                         `test_date` LIKE '%".$terms[$i]."%' OR
                                                         `diagnosis` LIKE '%".$terms[$i]."%' OR
                                                         `description` LIKE '%".$terms[$i]."%'");
                    if(isset($union_result)){
                        $new_result = array();
                        while ($row = $result->fetch_assoc()) {
                            for ($i = 0; $i < count($union_result); $i++){
                                if ($union_result[0]['record_id'] == $row['record_id']){
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
                    foreach ($union_result[$i] as $key => $value) {
                        echo " $key: $value";
                    }
                }
                
            } else if ($_SESSION['class'] == 1){
            //doctor can only view records of their patients
                for ($i = 0; $i < count($terms); $i++){
                    $result = mysqli_query($mysqli,"select * 
                                                   from radiology_record
                                                   WHERE (`record_id` LIKE '%".$terms[$i]."%' OR
                                                         `patient_id` LIKE '%".$terms[$i]."%' OR
                                                         `doctor_id` LIKE '%".$terms[$i]."%' OR
                                                         `radiologist_id` LIKE '%".$terms[$i]."%' OR
                                                         `test_type` LIKE '%".$terms[$i]."%' OR
                                                         `prescribing_date` LIKE '%".$terms[$i]."%' OR
                                                         `test_date` LIKE '%".$terms[$i]."%' OR
                                                         `diagnosis` LIKE '%".$terms[$i]."%' OR
                                                         `description` LIKE '%".$terms[$i]."%') AND 
                                                         ");
                    if(isset($union_result)){
                        $new_result = array();
                        while ($row = $result->fetch_assoc()) {
                            for ($i = 0; $i < count($union_result); $i++){
                                if ($union_result[0]['record_id'] == $row['record_id']){
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
                    foreach ($union_result[$i] as $key => $value) {
                        echo " $key: $value";
                    }
                }

            } else if ($_SESSION['class'] == 2) {
            //patient can only view his/her own records
                
            } else if ($_SESSION['class'] == 3) {
            //radiologist can only review records conducted by themselves
                
            } else {
                echo '<br/> Error: Invalid session class, class must be 1, 2 or 3.';
            }
            
		}	
	
		?>
	</body>
</html>
