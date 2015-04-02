<html>
    <body>
    <?php
        
    session_start();
    
    $patient_id = $_POST['p_id'];
    $test_type = $_POST['test_type'];
            
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    $patient_id = strtolower($patient_id);
    $test_type = strtolower($test_type);
       
    //Create a connection
    $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
    
    //all is used to indicate searching for all patient ids or all test types.
    
    if (($patient_id == 'all') and ($test_type == 'all')){
        
        $result = mysqli_query($mysqli,"SELECT temp.test_date, temp.count
                                        FROM (select patient_id, test_type,test_date,count(record_id) AS count
                                              from radiology_record 
                                              group by patient_id,test_type,test_date
                                              union
                                              select patient_id, null,test_date,count(record_id)
                                              from radiology_record 
                                              group by patient_id,test_date
                                              union
                                              select null,test_type,test_date,count(record_id)
                                              from radiology_record 
                                              group by test_type, test_date
                                              union
                                              select null,null,test_date,count(record_id)
                                              from radiology_record 
                                              group by test_date
                                              union 
                                              select null,null,null,count(record_id)
                                              from radiology_record) AS temp
                                        WHERE temp.patient_id IS NULL AND
                                              temp.test_type IS NULL AND
                                              temp.test_date BETWEEN '$start_date' AND '$end_date'");
        
        $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
        
        $timestamp = strtotime($start_date);
        $end_timestamp = strtotime($end_date);
        
        //Determine first monday after start_date
        for($i = 0; $i < 7; $i++){
            if(date('D', $timestamp) === 'Mon'){
                break;
            } else {
                $timestamp = strtotime('+1 day', $timestamp);
            }
        }
        //echo date('Y-m-d', $timestamp)."<br>"; 
        
        $next_timestamp = strtotime('+1 week', $timestamp);
        
        //Prints out count for each week.
        while($timestamp < $end_timestamp){
            echo "Week of ".date('Y-m-d', $timestamp)."<br>";
            $sum_count = 0;
            for($i = 0; $i < count($rows); $i++){
                if ((strtotime($rows[$i]["test_date"]) > $timestamp) and (strtotime($rows[$i]["test_date"]) < $next_timestamp)){
                   $sum_count = $sum_count + $rows[$i]["count"];
                }
            }
            echo "Count: ".$sum_count;
            echo "<hr>";
            $timestamp = $next_timestamp;
            $next_timestamp = strtotime('+1 week', $timestamp);
        }
        
    } else if ($patient_id == 'all') {
        
        $result = mysqli_query($mysqli,"SELECT temp.count
                                        FROM (select patient_id, test_type,test_date,count(record_id) AS count
                                              from radiology_record 
                                              group by patient_id,test_type,test_date
                                              union
                                              select patient_id, null,test_date,count(record_id)
                                              from radiology_record 
                                              group by patient_id,test_date
                                              union
                                              select null,test_type,test_date,count(record_id)
                                              from radiology_record 
                                              group by test_type, test_date
                                              union
                                              select null,null,test_date,count(record_id)
                                              from radiology_record 
                                              group by test_date
                                              union 
                                              select null,null,null,count(record_id)
                                              from radiology_record) AS temp
                                        WHERE temp.patient_id IS NULL AND
                                              temp.test_type = '$test_type' AND
                                              temp.test_date BETWEEN '$start_date' AND '$end_date'");
        
        $rows = mysqli_fetch_row($result);
        
        echo "Count: ".$rows[0];
    
    } else if ($test_type == 'all') {
        
        $result = mysqli_query($mysqli,"SELECT temp.count
                                        FROM (select patient_id, test_type,test_date,count(record_id) AS count
                                              from radiology_record 
                                              group by patient_id,test_type,test_date
                                              union
                                              select patient_id, null,test_date,count(record_id)
                                              from radiology_record 
                                              group by patient_id,test_date
                                              union
                                              select null,test_type,test_date,count(record_id)
                                              from radiology_record 
                                              group by test_type, test_date
                                              union
                                              select null,null,test_date,count(record_id)
                                              from radiology_record 
                                              group by test_date
                                              union 
                                              select null,null,null,count(record_id)
                                              from radiology_record) AS temp
                                        WHERE temp.patient_id = '$patient_id' AND
                                              temp.test_type IS NULL AND
                                              temp.test_date BETWEEN '$start_date' AND '$end_date'");
        
        $rows = mysqli_fetch_row($result);
        
        echo "Count: ".$rows[0];
    
    } else {
        //No fields are all.
        
        $result = mysqli_query($mysqli,"SELECT temp.count
                                        FROM (select patient_id, test_type,test_date,count(record_id) AS count
                                              from radiology_record 
                                              group by patient_id,test_type,test_date
                                              union
                                              select patient_id, null,test_date,count(record_id)
                                              from radiology_record 
                                              group by patient_id,test_date
                                              union
                                              select null,test_type,test_date,count(record_id)
                                              from radiology_record 
                                              group by test_type, test_date
                                              union
                                              select null,null,test_date,count(record_id)
                                              from radiology_record 
                                              group by test_date
                                              union 
                                              select null,null,null,count(record_id)
                                              from radiology_record) AS temp
                                        WHERE temp.patient_id = '$patient_id' AND
                                              temp.test_type = '$test_type' AND
                                              temp.test_date BETWEEN '$start_date' AND '$end_date'");
        
        $rows = mysqli_fetch_row($result);
        
        echo "Count: ".$rows[0];
        
    }
    
    ?>
    </body>
</html>