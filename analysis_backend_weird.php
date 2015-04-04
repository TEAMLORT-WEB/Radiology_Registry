<?php
function displayable_resultset ($result)
{

    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    $category_array = array();
    $data_array = array();
    
    for($i = 0; $i < count($rows); $i++){
        foreach($rows[$i] as $key => $value){
    
            array_push($category_array,$key);
        }
        break;
    }
    
    
    for($i = 0; $i < count($rows); $i++){
        $temp_array = array();
        foreach($rows[$i] as $key => $value){
            
            array_push($temp_array,$value);
        }
        array_push($data_array,$temp_array);

    }
    $result_set = array();
    array_push($result_set,$category_array);
    array_push($result_set,$data_array);
    return $result_set;
}
?>

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
    
$a_result = mysqli_query($mysqli,"CREATE TEMPORARY TABLE TEMPTABLE(
                               `patient_id` int(11) DEFAULT NULL,
                               `first_name` varchar(24) DEFAULT NULL,
                               `last_name` varchar(24) DEFAULT NULL,
                               `test_type` varchar(24) DEFAULT NULL,
                               `test_date` date DEFAULT NULL,
                               `count` int(11))");

$b_result = mysqli_query($mysqli,"INSERT INTO TEMPTABLE (select * 
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

$c_result = mysqli_query($mysqli,"SELECT patient_id, first_name, last_name, count
                                FROM TEMPTABLE
                                WHERE patient_id IS NOT NULL AND
                                      test_type IS NULL AND
                                      test_date IS NULL");

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
    <meta charset="UTF-8">
        
    </head>
    
    <script>
        
         function displaywindow(window_title,head_content,data_content) {
            $.Dialog
            ({
                flat: false,
                shadow: true,
                draggable: true,
                title: window_title,
                content: '',
                resizable: true,
                modal: false,
                width: '50%',
                onShow: function(_dialog)
                {
                    var content = '<table class="table striped bordered">';
                    
                    
                    content += "<thead>";
                    content += "<tr>";
                    for(i =0; i<head_content.length; i++)
                    {
                        content+="<th class='text-left'>";
                        content+=head_content[i];
                        content+="</th>";
                    }
                    content += "<\/tr>";
                    content += "<\/thead>";
                    

                    
                    
                    content += "<tbody >";
                    
                    for(i =0; i<data_content.length; i++)
                    {
                        content += "<tr>";
                        for(j =0; j<data_content[i].length; j++)
                        {
                            content+="<td>";
                            content+=data_content[i][j];
                            content+="</td>";
                        }
                        content += "<\/tr>";
                    }
                    
                    content += "<\/tbody>";
                    content +='</table>';
                    $.Dialog.content(content);
                    $.Metro.initInputs();
                }


            });
        }
        var unpack = <?php echo json_encode(displayable_resultset ()); ?>;
        var categories = unpack[0]; 
        var data = unpack[1]; 

        displaywindow("Number of images for each patient",categories,data);

    </script>

    
    <script>
    
        function createwindow(content) {
        
            if (document.getElementById('by_p').checked) {
        
                if (document.getElementById('by_y').checked) {
                    
                    displaywindow(content);
        
                } else if (document.getElementById('by_m').checked) {
                    
                    displaywindow(content);
        
                } else if (document.getElementById('by_w').checked) {
                    
                    displaywindow(content);
        
                }
              
            } else if (document.getElementById('by_t').checked) {
        
                if (document.getElementById('by_y').checked) {
                    
                    displaywindow(content);
        
                } else if (document.getElementById('by_m').checked) {
                
                    displaywindow(content);
        
                } else if (document.getElementById('by_w').checked) {
                    
                    displaywindow(content);
        
                }
        
        
                
            } else {
        
                if (document.getElementById('by_y').checked) {
                    
                    displaywindow(content);
        
                } else if (document.getElementById('by_m').checked) {
                
                    displaywindow(content);
        
                } else if (document.getElementById('by_w').checked) {
                    
                    displaywindow(content);
        
                }
        
            }
        
        }
 
    </script>

    <body class="metro">
    
        <div id="by_p" class="input-control switch margin10" data-role="input-control">
            <label>
                By Patient
                <input type="checkbox" checked/>
                <span class="check"></span>
            </label>
        </div>

        <div id="by_t" class="input-control switch margin10" data-role="input-control">
            <label>
                By Test Type
                <input type="checkbox"/>
                <span class="check"></span>
            </label>
        </div>
        <div>
            <div id="by_w" class="input-control radio margin10" data-role="input-control">
                <label>
                    By Week
                    <input type="radio" name="r1" checked />
                    <span class="check"></span>
                </label>
            </div>
            <div id="by_m" class="input-control radio margin10" data-role="input-control">
                <label>
                    By Month
                    <input type="radio" name="r1" />
                    <span class="check"></span>
                </label>
            </div>
            <div id="by_y" class="input-control radio margin10" data-role="input-control">
                <label>
                    By Year
                    <input type="radio" name="r1" />
                    <span class="check"></span>
                </label>
            </div>

        </div>
    </body>
</html>