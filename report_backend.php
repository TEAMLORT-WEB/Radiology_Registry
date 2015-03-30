<html>
	<body>
    <?php

    $search_diagnosis = $_POST['search_diagnosis'];
    
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
    
    $result = mysqli_query($mysqli,"SELECT persons.first_name, persons.last_name, persons.address, persons.phone
                                    FROM persons, radiology_record
                                    WHERE radiology_record.diagnosis LIKE '$search_diagnosis' AND
                                          radiology_record.patient_id = persons.person_id");
    
    $fetch_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for ($i = 0; $i < count($fetch_result); $i++){
        foreach ($fetch_result[$i] as $key => $value) {
            echo " $key: $value";
        }
        echo "<br>";
    }
    
    ?>
    </body>
</html>