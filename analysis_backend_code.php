<?php

echo "Number of images for each patient<br>";
$result = mysqli_query($mysqli,"SELECT patient_id, first_name, last_name, count
                                FROM TEMPTABLE
                                WHERE patient_id IS NOT NULL AND
                                      test_type IS NULL AND
                                      test_date IS NULL");

$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
for($i = 0; $i < count($rows); $i++){
    foreach($rows[$i] as $key => $value){
        echo $value." ";
    }
    echo "<br>";
}

echo "<br>Number of images for each test type<br>";
$result = mysqli_query($mysqli,"SELECT test_type, count
                                FROM TEMPTABLE
                                WHERE patient_id IS NULL AND
                                      test_type IS NOT NULL AND
                                      test_date IS NULL");

$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
for($i = 0; $i < count($rows); $i++){
    foreach($rows[$i] as $key => $value){
        echo $value." ";
    }
    echo "<br>";
}

echo "<br>Number of images for each patient for each test type<br>";
$result = mysqli_query($mysqli,"SELECT patient_id, first_name, last_name, test_type, count 
                                FROM TEMPTABLE
                                WHERE patient_id IS NOT NULL AND
                                      test_type IS NOT NULL AND
                                      test_date IS NULL");

$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
for($i = 0; $i < count($rows); $i++){
    foreach($rows[$i] as $key => $value){
        echo  $value." ";
    }
    echo "<br>";
}

echo "<br>Total number of images<br>";
$result = mysqli_query($mysqli,"SELECT count 
                                FROM TEMPTABLE
                                WHERE patient_id IS NULL AND
                                      test_type IS NULL AND
                                      test_date IS NULL");

$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
for($i = 0; $i < count($rows); $i++){
    foreach($rows[$i] as $key => $value){
        echo  $value." ";
    }
    echo "<br>";
}


//-----Monthly-----
$timestamp = strtotime($start_date);
$end_timestamp = strtotime($end_date);

//Determine first day of the month.
for($i = 0; $i < 31; $i++){
    if(date('j', $timestamp) === '1'){
        break;
    } else {
        $timestamp = strtotime('+1 day', $timestamp);
    }
}

$first_day_timestamp = $timestamp; //Store initial value for next three queries.

$next_timestamp = strtotime('+1 month', $timestamp);

echo "<br>Number of images for each patient monthly<br>";
while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "Month of $timestamp_date<br>";
    $result = mysqli_query($mysqli,"SELECT patient_id, first_name, last_name, SUM(count)
                                FROM TEMPTABLE
                                WHERE patient_id IS NOT NULL AND
                                      test_type IS NULL AND
                                      test_date BETWEEN '$timestamp_date' AND '$next_timestamp_date'
                                GROUP BY patient_id, first_name, last_name");
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i = 0; $i < count($rows); $i++){
        foreach($rows[$i] as $key => $value){
            echo  $value." ";
        }
        echo "<br>";
    }
    echo "<hr>";
    if(count($rows) > 0){
        ob_end_flush();
    } else {
        ob_end_clean();
    }
    
    $timestamp = $next_timestamp;
    $next_timestamp = strtotime('+1 month', $timestamp);
}

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 month', $timestamp);

echo "<br>Number of images for each test type monthly<br>";
while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "Month of $timestamp_date<br>";
    $result = mysqli_query($mysqli,"SELECT test_type, SUM(count)
                                FROM TEMPTABLE
                                WHERE patient_id IS NULL AND
                                      test_type IS NOT NULL AND
                                      test_date BETWEEN '$timestamp_date' AND '$next_timestamp_date'
                                GROUP BY test_type");
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i = 0; $i < count($rows); $i++){
        foreach($rows[$i] as $key => $value){
            echo  $value." ";
        }
        echo "<br>";
    }
    echo "<hr>";
    if(count($rows) > 0){
        ob_end_flush();
    } else {
        ob_end_clean();
    }
    
    $timestamp = $next_timestamp;
    $next_timestamp = strtotime('+1 month', $timestamp);
}

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 month', $timestamp);

echo "<br>Number of images for each patient for each test type monthly<br>";
while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "Month of $timestamp_date<br>";
    $result = mysqli_query($mysqli,"SELECT patient_id, first_name, last_name, test_type, SUM(count)
                                FROM TEMPTABLE
                                WHERE patient_id IS NOT NULL AND
                                      test_type IS NOT NULL AND
                                      test_date BETWEEN '$timestamp_date' AND '$next_timestamp_date'
                                GROUP BY patient_id, first_name, last_name, test_type");
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i = 0; $i < count($rows); $i++){
        foreach($rows[$i] as $key => $value){
            echo  $value." ";
        }
        echo "<br>";
    }
    echo "<hr>";
    if(count($rows) > 0){
        ob_end_flush();
    } else {
        ob_end_clean();
    }
    
    $timestamp = $next_timestamp;
    $next_timestamp = strtotime('+1 month', $timestamp);
}

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 month', $timestamp);

echo "<br>Total number of images monthly<br>";
while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "Month of $timestamp_date<br>";
    $result = mysqli_query($mysqli,"SELECT SUM(count)
                                FROM TEMPTABLE
                                WHERE patient_id IS NULL AND
                                      test_type IS NULL AND
                                      test_date BETWEEN '$timestamp_date' AND '$next_timestamp_date'");
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i = 0; $i < count($rows); $i++){
        foreach($rows[$i] as $key => $value){
            echo  $value." ";
        }
        echo "<br>";
    }
    echo "<hr>";
    if($rows[0]['SUM(count)'] != NULL){
        ob_end_flush();
    } else {
        ob_end_clean();
    }
    
    $timestamp = $next_timestamp;
    $next_timestamp = strtotime('+1 month', $timestamp);
}

//-----Yearly-----
$timestamp = strtotime($start_date);
$end_timestamp = strtotime($end_date);

//Determine first day of the year.
for($i = 0; $i < 365; $i++){
    if(date('z', $timestamp) === '0'){
        break;
    } else {
        $timestamp = strtotime('-1 day', $timestamp);
    }
}

$first_day_timestamp = $timestamp; //Store initial value for next three queries.

$next_timestamp = strtotime('+1 year', $timestamp);

echo "<br>Number of images for each patient yearly<br>";
while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "Year of $timestamp_date<br>";
    $result = mysqli_query($mysqli,"SELECT patient_id, first_name, last_name, SUM(count)
                                FROM TEMPTABLE
                                WHERE patient_id IS NOT NULL AND
                                      test_type IS NULL AND
                                      test_date BETWEEN '$timestamp_date' AND '$next_timestamp_date'
                                GROUP BY patient_id, first_name, last_name");
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i = 0; $i < count($rows); $i++){
        foreach($rows[$i] as $key => $value){
            echo  $value." ";
        }
        echo "<br>";
    }
    echo "<hr>";
    if(count($rows) > 0){
        ob_end_flush();
    } else {
        ob_end_clean();
    }
    
    $timestamp = $next_timestamp;
    $next_timestamp = strtotime('+1 year', $timestamp);
}

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 year', $timestamp);

echo "<br>Number of images for each test type yearly<br>";
while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "Year of $timestamp_date<br>";
    $result = mysqli_query($mysqli,"SELECT test_type, SUM(count)
                                FROM TEMPTABLE
                                WHERE patient_id IS NULL AND
                                      test_type IS NOT NULL AND
                                      test_date BETWEEN '$timestamp_date' AND '$next_timestamp_date'
                                GROUP BY test_type");
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i = 0; $i < count($rows); $i++){
        foreach($rows[$i] as $key => $value){
            echo  $value." ";
        }
        echo "<br>";
    }
    echo "<hr>";
    if(count($rows) > 0){
        ob_end_flush();
    } else {
        ob_end_clean();
    }
    
    $timestamp = $next_timestamp;
    $next_timestamp = strtotime('+1 year', $timestamp);
}

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 year', $timestamp);

echo "<br>Number of images for each patient for each test type yearly<br>";
while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "Year of $timestamp_date<br>";
    $result = mysqli_query($mysqli,"SELECT patient_id, first_name, last_name, test_type, SUM(count) 
                                FROM TEMPTABLE
                                WHERE patient_id IS NOT NULL AND
                                      test_type IS NOT NULL AND
                                      test_date BETWEEN '$timestamp_date' AND '$next_timestamp_date'
                                GROUP BY patient_id, first_name, last_name, test_type");
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i = 0; $i < count($rows); $i++){
        foreach($rows[$i] as $key => $value){
            echo  $value." ";
        }
        echo "<br>";
    }
    echo "<hr>";
    if(count($rows) > 0){
        ob_end_flush();
    } else {
        ob_end_clean();
    }
    
    $timestamp = $next_timestamp;
    $next_timestamp = strtotime('+1 year', $timestamp);
}

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 month', $timestamp);

echo "<br>Total number of images yearly<br>";
while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "Year of $timestamp_date<br>";
    $result = mysqli_query($mysqli,"SELECT SUM(count)
                                FROM TEMPTABLE
                                WHERE patient_id IS NULL AND
                                      test_type IS NULL AND
                                      test_date BETWEEN '$timestamp_date' AND '$next_timestamp_date'");
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i = 0; $i < count($rows); $i++){
        foreach($rows[$i] as $key => $value){
            echo  $value." ";
        }
        echo "<br>";
    }
    echo "<hr>";
    if($rows[0]['SUM(count)'] != NULL){
        ob_end_flush();
    } else {
        ob_end_clean();
    }
    
    $timestamp = $next_timestamp;
    $next_timestamp = strtotime('+1 year', $timestamp);
}

return false;

echo "<br>";
?>