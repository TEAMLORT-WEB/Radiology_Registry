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
    
    if ((($patient_id == 'all') or ($patient_id == '')) and (($test_type == 'all') or ($test_type == ''))){
        
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
    } else if (($patient_id == 'all') or ($patient_id == '')) {     
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
    
    } else if (($test_type == 'all') or ($test_type == '')) {
        
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
        
    }
    
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);
    
    $week_array = array();
    
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
        $timestamp_date = date('Y-m-d', $timestamp);
        $sum_count = 0;
        for($i = 0; $i < count($rows); $i++){
            if ((strtotime($rows[$i]["test_date"]) > $timestamp) and (strtotime($rows[$i]["test_date"]) < $next_timestamp)){
                $sum_count = $sum_count + $rows[$i]["count"];
            }
        }
        $week_array[] = [$timestamp_date, $sum_count];
        $timestamp = $next_timestamp;
        $next_timestamp = strtotime('+1 week', $timestamp);
    }
    for($i = 0; $i < count($week_array); $i++){
        echo "Week of ".$week_array[$i][0]."<br>Count: ".$week_array[$i][1];
        echo "<hr>";
    }
    
    //-----Monthly-----
    $timestamp = strtotime($start_date);
    
    $month_array = array();
    
    //Determine first day of the month.
    for($i = 0; $i < 31; $i++){
        if(date('j', $timestamp) === '1'){
            break;
        } else {
            $timestamp = strtotime('+1 day', $timestamp);
        }
    }
    
    $next_timestamp = strtotime('+1 month', $timestamp);
    
    //Prints out count for each month.
    while($timestamp < $end_timestamp){
        $timestamp_date = date('Y-m-d', $timestamp);
        $sum_count = 0;
        for($i = 0; $i < count($rows); $i++){
            if ((strtotime($rows[$i]["test_date"]) > $timestamp) and (strtotime($rows[$i]["test_date"]) < $next_timestamp)){
                $sum_count = $sum_count + $rows[$i]["count"];
            }
        }
        $month_array[] = [$timestamp_date, $sum_count];
        $timestamp = $next_timestamp;
        $next_timestamp = strtotime('+1 month', $timestamp);
    }
    for($i = 0; $i < count($month_array); $i++){
        echo "Month of ".$month_array[$i][0]."<br>Count: ".$month_array[$i][1];
        echo "<hr>";
    }
    
    //-----Yearly-----
    $timestamp = strtotime($start_date);
    
    $year_array = array();
    
    //Determine first day of the year.
    for($i = 0; $i < 365; $i++){
        if(date('z', $timestamp) === '0'){
            break;
        } else {
            $timestamp = strtotime('-1 day', $timestamp);
        }
    }
    
    $next_timestamp = strtotime('+1 year', $timestamp);
    
    //Prints out count for each year.
    while($timestamp < $end_timestamp){
        $timestamp_date = date('Y-m-d', $timestamp);
        $sum_count = 0;
        for($i = 0; $i < count($rows); $i++){
            if ((strtotime($rows[$i]["test_date"]) > $timestamp) and (strtotime($rows[$i]["test_date"]) < $next_timestamp)){
                $sum_count = $sum_count + $rows[$i]["count"];
            }
        }
        $year_array[] = [$timestamp_date, $sum_count];
        $timestamp = $next_timestamp;
        $next_timestamp = strtotime('+1 year', $timestamp);
    }
    for($i = 0; $i < count($year_array); $i++){
        echo "Year of ".$year_array[$i][0]."<br>Count: ".$year_array[$i][1];
        echo "<hr>";
    }
    
    ?>
    </body>
</html>