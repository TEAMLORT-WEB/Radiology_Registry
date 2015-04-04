<?php
    session_start();
    if(!(isset($_SESSION['username']) and isset($_SESSION['id'])))
    {
        echo"you're trying to access sensitive information, please login to verify your identity";
        header ("refresh:1;location:index.html");
    }
    if($_SESSION['classes'] !='a')
    {
        echo"<script>alert('you do not authorized to access this page');</script>";
        header ("url=/home.php");
    }    
?>

<html>
<head></head>
<body>

<script type="text/javascript">
    var patientCheck = 0;
    var testCheck = 0;
    var dateMode = "weekly";

    function switchTables() {
        
        /*
        alert("Value of patientCheck " + patientCheck);
        alert("Value of testCheck " + testCheck);
        alert("Value of dateMode " + dateMode);
        */

        var ele = document.getElementById("weekPatientText");
        var weekPatientText = document.getElementById("weekPatientText");
        var weekTestText = document.getElementById("weekTestText");
        var weekPatientTestText = document.getElementById("weekPatientTestText");
        var weekTotalText = document.getElementById("weekTotalText");
        var monthPatientText = document.getElementById("monthPatientText");
        var monthTestText = document.getElementById("monthTestText");
        var monthPatientTestText = document.getElementById("monthPatientTestText");
        var monthTotalText = document.getElementById("monthTotalText");
        var yearPatientText = document.getElementById("yearPatientText");
        var yearTestText = document.getElementById("yearTestText");
        var yearPatientTestText = document.getElementById("yearPatientTestText");
        var yearTotalText = document.getElementById("yearTotalText");

        /*
        weekPatientText.style.display = "none";
        weekTestText.style.display = "none";
        weekPatientTestText.style.display = "none";
        weekTotalText.style.display = "none";
        monthPatientText.style.display = "none";
        monthTestText.style.display = "none";
        monthPatientTestText.style.display = "none";
        monthTotalText.style.display = "none";
        yearPatientText.style.display = "none";
        yearTestText.style.display = "none";
        yearPatientTestText.style.display = "none";
        yearTotalText.style.display = "none";
        */
        
        /*
        while((weekPatientText.style.display != "none") || (weekTestText.style.display != "none") || (weekPatientTextText.style.display != "none") ||
            (weekTotalText.style.display != "none") || (monthPatientText.style.display != "none") || (monthTestText.style.display != "none") ||
            (monthPatientTextText.style.display != "none") || (monthTotalText.style.display != "none") || (yearPatientText.style.display != "none") ||
            (yearTestText.style.display != "none") || (yearPatientTextText.style.display != "none") || (yearTotalText.style.display != "none")) {
        } */

        //NOTE: A ton of repeated code here because setting display to none before setting block didn't work for some reason.
        
        if (dateMode == "weekly") {
            //alert("Value of dateMode " + dateMode);
            if ((patientCheck == 0) && (testCheck == 0)) {
                weekTotalText.style.display = "block";
                weekPatientText.style.display = "none";
                weekTestText.style.display = "none";
                weekPatientTestText.style.display = "none";
                monthPatientText.style.display = "none";
                monthTestText.style.display = "none";
                monthPatientTestText.style.display = "none";
                monthTotalText.style.display = "none";
                yearPatientText.style.display = "none";
                yearTestText.style.display = "none";
                yearPatientTestText.style.display = "none";
                yearTotalText.style.display = "none";
            } else if ((patientCheck == 0) && (testCheck == 1)) {
                weekTestText.style.display = "block";
                weekPatientText.style.display = "none";
                weekPatientTestText.style.display = "none";
                weekTotalText.style.display = "none";
                monthPatientText.style.display = "none";
                monthTestText.style.display = "none";
                monthPatientTestText.style.display = "none";
                monthTotalText.style.display = "none";
                yearPatientText.style.display = "none";
                yearTestText.style.display = "none";
                yearPatientTestText.style.display = "none";
                yearTotalText.style.display = "none";
            } else if ((patientCheck == 1) && (testCheck == 0)) {
                weekPatientText.style.display = "block";
                weekTestText.style.display = "none";
                weekPatientTestText.style.display = "none";
                weekTotalText.style.display = "none";
                monthPatientText.style.display = "none";
                monthTestText.style.display = "none";
                monthPatientTestText.style.display = "none";
                monthTotalText.style.display = "none";
                yearPatientText.style.display = "none";
                yearTestText.style.display = "none";
                yearPatientTestText.style.display = "none";
                yearTotalText.style.display = "none";
            } else if ((patientCheck == 1) && (testCheck == 1)){
                weekPatientTestText.style.display = "block";
                weekPatientText.style.display = "none";
                weekTestText.style.display = "none";
                weekTotalText.style.display = "none";
                monthPatientText.style.display = "none";
                monthPatientText.style.display = "none";
                monthPatientTestText.style.display = "none";
                monthTotalText.style.display = "none";
                yearPatientText.style.display = "none";
                yearTestText.style.display = "none";
                yearPatientTestText.style.display = "none";
                yearTotalText.style.display = "none";
            }
        } else if (dateMode == "monthly") {
            //alert("Value of dateMode " + dateMode);
            if ((patientCheck == 0) && (testCheck == 0)) {
                monthTotalText.style.display = "block";
                weekTotalText.style.display = "none";
                weekPatientText.style.display = "none";
                weekTestText.style.display = "none";
                weekPatientTestText.style.display = "none";
                monthPatientText.style.display = "none";
                monthTestText.style.display = "none";
                monthPatientTestText.style.display = "none";
                yearPatientText.style.display = "none";
                yearTestText.style.display = "none";
                yearPatientTestText.style.display = "none";
                yearTotalText.style.display = "none";
            } else if ((patientCheck == 0) && (testCheck == 1)) {
                monthTestText.style.display = "block";
                weekTotalText.style.display = "none";
                weekPatientText.style.display = "none";
                weekTestText.style.display = "none";
                weekPatientTestText.style.display = "none";
                monthPatientText.style.display = "none";
                monthPatientTestText.style.display = "none";
                monthTotalText.style.display = "none";
                yearPatientText.style.display = "none";
                yearTestText.style.display = "none";
                yearPatientTestText.style.display = "none";
                yearTotalText.style.display = "none";
            } else if ((patientCheck == 1) && (testCheck == 0)) {
                monthPatientText.style.display = "block";
                weekTotalText.style.display = "none";
                weekPatientText.style.display = "none";
                weekTestText.style.display = "none";
                weekPatientTestText.style.display = "none";
                monthTestText.style.display = "none";
                monthPatientTestText.style.display = "none";
                monthTotalText.style.display = "none";
                yearPatientText.style.display = "none";
                yearTestText.style.display = "none";
                yearPatientTestText.style.display = "none";
                yearTotalText.style.display = "none";
            } else if ((patientCheck == 1) && (testCheck == 1)) {
                monthPatientTestText.style.display = "block";
                weekTotalText.style.display = "none";
                weekPatientText.style.display = "none";
                weekTestText.style.display = "none";
                weekPatientTestText.style.display = "none";
                monthPatientText.style.display = "none";
                monthTestText.style.display = "none";
                monthTotalText.style.display = "none";
                yearPatientText.style.display = "none";
                yearTestText.style.display = "none";
                yearPatientTestText.style.display = "none";
                yearTotalText.style.display = "none";
            }
        } else {
            //alert("Value of dateMode " + dateMode);
            if ((patientCheck == 0) && (testCheck == 0)) {
                yearTotalText.style.display = "block";
                yearPatientText.style.display = "none";
                yearTestText.style.display = "none";
                yearPatientTestText.style.display = "none";
                monthPatientText.style.display = "none";
                monthTestText.style.display = "none";
                monthPatientTestText.style.display = "none";
                monthTotalText.style.display = "none";
                weekTotalText.style.display = "none";
                weekPatientText.style.display = "none";
                weekTestText.style.display = "none";
                weekPatientTestText.style.display = "none";
            } else if ((patientCheck == 0) && (testCheck == 1)) {
                yearTestText.style.display = "block";
                yearPatientText.style.display = "none";
                yearPatientTestText.style.display = "none";
                yearTotalText.style.display = "none";
                monthPatientText.style.display = "none";
                monthTestText.style.display = "none";
                monthPatientTestText.style.display = "none";
                monthTotalText.style.display = "none";
                weekTotalText.style.display = "none";
                weekPatientText.style.display = "none";
                weekTestText.style.display = "none";
                weekPatientTestText.style.display = "none";
            } else if ((patientCheck == 1) && (testCheck == 0)) {
                yearPatientText.style.display = "block";
                yearTestText.style.display = "none";
                yearPatientTestText.style.display = "none";
                yearTotalText.style.display = "none";
                monthPatientText.style.display = "none";
                monthTestText.style.display = "none";
                monthPatientTestText.style.display = "none";
                monthTotalText.style.display = "none";
                weekTotalText.style.display = "none";
                weekPatientText.style.display = "none";
                weekTestText.style.display = "none";
                weekPatientTestText.style.display = "none";
            } else if ((patientCheck == 1) && (testCheck == 1)) {
                yearPatientTestText.style.display = "block";
                yearPatientText.style.display = "none";
                yearTestText.style.display = "none";
                yearTotalText.style.display = "none";
                monthPatientText.style.display = "none";
                monthTestText.style.display = "none";
                monthPatientTestText.style.display = "none";
                monthTotalText.style.display = "none";
                weekTotalText.style.display = "none";
                weekPatientText.style.display = "none";
                weekTestText.style.display = "none";
                weekPatientTestText.style.display = "none"; 
            }
        }

    }
    function oncheck() {
        if (patientCheck == 1) {
            patientCheck = 0;
            while (patientCheck != 0) { //Block until assignment complete.
            }
        } else {
            patientCheck = 1;
            while (patientCheck != 1) { //Block until assignment complete.
            }
        }
        switchTables();
    }
    function oncheck2() {
        if (testCheck == 1) {
            testCheck = 0;
            while (testCheck != 0) { //Block until assignment complete.
            }
        } else {
            testCheck = 1;
            while (testCheck != 1) { //Block until assignment complete.
            }
        }
        switchTables();
    }
    function weekButton() {
        dateMode = "weekly";
        while (dateMode != "weekly") { //Block until assignment complete.
        }
        switchTables();
    }
    function monthButton() {
        dateMode = "monthly";
        while (dateMode != "monthly") { //Block until assignment complete.
        }
        switchTables();
    }
    function yearButton() {
        dateMode = "yearly";
        while (dateMode != "yearly") { //Block until assignment complete.
        }
        switchTables();
    }

    </script>

<input type="checkbox" onclick="oncheck()"> By patient
<input type="checkbox" onclick="oncheck2()"> By test type
<div id="by_w" class="input-control radio margin10" data-role="input-control">
                <label>
                    By Week
                    <input type="radio" name="r1" onchange="weekButton()" checked />
                    <span class="check"></span>
                </label>
            </div>
            <div id="by_m" class="input-control radio margin10" data-role="input-control">
                <label>
                    By Month
                    <input type="radio" name="r1" onchange="monthButton()"/>
                    <span class="check"></span>
                </label>
            </div>
            <div id="by_y" class="input-control radio margin10" data-role="input-control">
                <label>
                    By Year
                    <input type="radio" name="r1" onchange="yearButton()" />
                    <span class="check"></span>
                </label>
            </div>

<?php
        
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

//Create a connection
$mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");

//all is used to indicate searching for all patient ids or all test types.
    
$result = mysqli_query($mysqli,"CREATE TEMPORARY TABLE TEMPTABLE(
                               `patient_id` int(11) DEFAULT NULL,
                               `first_name` varchar(24) DEFAULT NULL,
                               `last_name` varchar(24) DEFAULT NULL,
                               `test_type` varchar(24) DEFAULT NULL,
                               `test_date` date DEFAULT NULL,
                               `count` int(11))");

$result = mysqli_query($mysqli,"INSERT INTO TEMPTABLE (select * 
                                                       FROM(select patient_id,first_name,last_name, test_type,test_date,count(record_id)
                                                            from radiology_record, persons
                                                            where radiology_record.patient_id = persons.person_id 
                                                            group by patient_id,test_type,test_date
                                                            union
                                                            select patient_id,first_name,last_name, null,test_date,count(record_id)
                                                            from radiology_record , persons
                                                            where radiology_record.patient_id = persons.person_id 
                                                            group by patient_id,test_date
                                                            union 
                                                            select patient_id,first_name,last_name, test_type,null,count(record_id)
                                                            from radiology_record , persons
                                                            where radiology_record.patient_id = persons.person_id 
                                                            group by patient_id,test_type
                                                            union
                                                            select null,null,null,test_type,test_date,count(record_id)
                                                            from radiology_record 
                                                            group by test_type, test_date

                                                            union
                                                            select null,null,null,null,test_date,count(record_id)
                                                            from radiology_record 
                                                            group by test_date
                                                            union
                                                            select patient_id,first_name,last_name, null,null,count(record_id)
                                                            from radiology_record , persons
                                                            where radiology_record.patient_id = persons.person_id 
                                                            group by patient_id

                                                            union
                                                            select null,null,null,test_type,null,count(record_id)
                                                            from radiology_record 
                                                            group by test_type
                                                            union
                                                            select null,null,null,null,null,count(record_id)
                                                            from radiology_record ) AS temp)");           
?>

<div>

<div id="weekPatientText" style="display: none"><h4>Number of images for each patient weekly(Patient ID, First Name, Last Name, Count)</h4>
    

<?php

//-----Weekly-----
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

$first_day_timestamp = $timestamp; //Store initial value for next three queries.

$next_timestamp = strtotime('+1 week', $timestamp);

while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "<h5>Week of $timestamp_date</h5>";
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
    $next_timestamp = strtotime('+1 week', $timestamp);
}

?>

</div>

<div id="weekTestText" style="display: none"><h4>Number of images for each test type weekly(Test type, Count) </h4>
                                                

<?php

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 week', $timestamp);

while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "<h5>Week of $timestamp_date<h5>";
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
    $next_timestamp = strtotime('+1 week', $timestamp);
}

?>

</div>

<div id="weekPatientTestText" style="display: none"><h4>Number of images for each patient for each test type weekly(Patient_id, First_name 
                                                     Last_name, Test_type, Count)</h4>

<?php

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 week', $timestamp);

while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "<h5>Week of $timestamp_date</h5>";
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
    $next_timestamp = strtotime('+1 week', $timestamp);
}

?>

</div>

<div id="weekTotalText" style="display: block"><h4>Total number of images weekly(Count)</h4>

<?php

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 week', $timestamp);

while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "<h5>Week of $timestamp_date</h5>";
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
    $next_timestamp = strtotime('+1 week', $timestamp);
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

?>

</div>

<div id="monthPatientText" style="display: none"><h4>Number of images for each patient monthly(Patient ID, First Name, Last Name, Count)</h4>

<?php

while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "<h5>Month of $timestamp_date</h5>";
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

?>

</div>

<div id="monthTestText" style="display: none"><h4>Number of images for each test type monthly(Test type, Count)</h4>

<?php

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 month', $timestamp);

while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "<h5>Month of $timestamp_date</h5>";
    $result = mysqli_query($mysqli,"SELECT test_type, SUM(count)
                                FROM TEMPTABLE
                                WHERE patient_id IS NULL AND
                                      test_type IS NOT NULL AND
                                      test_date BETWEEN '$timestamp_date' AND '$next_timestamp_date'
                                GROUP BY test_type");
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i = 0; $i < count($rows); $i++){
        foreach($rows[$i] as $key => $value){
            echo $value." ";
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

?>

</div>

<div id="monthPatientTestText" style="display: none"><h4>Number of images for each patient for each test type monthly(Patient_id, First_name, 
                                                         Last_name, Test_type, Count)</h4>

<?php

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 month', $timestamp);

while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "<h5>Month of $timestamp_date</h5>";
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

?>

</div>

<div id="monthTotalText" style="display: none"><h4>Total number of images monthly(Count)</h4>

<?php

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 month', $timestamp);

while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "<h5>Month of $timestamp_date</h5>";
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

?>

</div>

<div id="yearPatientText" style="display: none"><h4>Number of images for each patient yearly(Patient ID, First Name, Last Name, Count)</h4>

<?php

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

while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "<h5>Year of $timestamp_date</h5>";
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

?>

</div>

<div id="yearTestText" style="display: none"><h4>Number of images for each test type yearly(Test type, Count)</h4>
    
<?php

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 year', $timestamp);

while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "<h5>Year of $timestamp_date</h5>";
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

?>

</div>

<div id="yearPatientTestText" style="display: none"><h4>Number of images for each patient for each test type yearly
    (Patient_id, First_name, Last_name, Test_type, Count) </h4>

<?php

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 year', $timestamp);

while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "<h5>Year of $timestamp_date</h5>";
    $result = mysqli_query($mysqli,"SELECT patient_id, first_name, last_name, test_type, SUM(count) 
                                FROM TEMPTABLE
                                WHERE patient_id IS NOT NULL AND
                                      test_type IS NOT NULL AND
                                      test_date BETWEEN '$timestamp_date' AND '$next_timestamp_date'
                                GROUP BY patient_id, first_name, last_name, test_type");
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i = 0; $i < count($rows); $i++){
        foreach($rows[$i] as $key => $value){
            echo $value." ";
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

?>

</div>

<div id="yearTotalText" style="display: none"><h4>Total number of images yearly(Count)</h4>

<?php

$timestamp = $first_day_timestamp;

$next_timestamp = strtotime('+1 month', $timestamp);

while($timestamp < $end_timestamp){
    $timestamp_date = date('Y-m-d', $timestamp);
    $next_timestamp_date = date('Y-m-d', $next_timestamp);
    ob_start();
    echo "<h5>Year of $timestamp_date</h5>";
    $result = mysqli_query($mysqli,"SELECT SUM(count)
                                FROM TEMPTABLE
                                WHERE patient_id IS NULL AND
                                      test_type IS NULL AND
                                      test_date BETWEEN '$timestamp_date' AND '$next_timestamp_date'");
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i = 0; $i < count($rows); $i++){
        foreach($rows[$i] as $key => $value){
            echo $value." ";
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

?>

    </div>

</div>
    </body>
</html>



