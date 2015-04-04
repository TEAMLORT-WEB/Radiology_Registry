<?php

session_start();

if(isset($_SESSION['class']))
{
    if($_SESSION['class'] !='a'&&$_SESSION['class'] !='r')
    {
        echo"<script>alert('you do not authorized to access this page');</script>";
        header ("url=/home.php");
        exit;
    
    }    
}
else
{
    echo"<script>alert('you re trying to access sensitive information, please login to verify your identity');</script>";
    header ("location: index.html");
}    
$doctor_id = @$_POST['doctor_id'];
$patient_id = @$_POST['patient_id'];
$radiologist_id = $_SESSION['id'];
$test_type = @$_POST['test_type'];
$test_type = @$_POST['test_type'];
$submit = @$_POST['submit'];
$prescribing_date =@$_POST['test_date_prescribe'];
$test_date = @$_POST['test_date_completed'];
$diagnosis = @$_POST['test_diagnosis'];
$description  = @$_POST['test_description'];




$mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");

//attempt to include a new ID 

$count = mysqli_query($mysqli,"SELECT COUNT(record_id) as total FROM radiology_record");
$data=mysqli_fetch_assoc($count);
$ID = $data['total']+1;



if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}




    if($doctor_id == true)
    {
        
        
        
        if($patient_id == true)
        {
            
            if($test_type== true)
            {
                
                if($prescribing_date == true)
                {
                    
                    
                    if($test_date == true)
                    {
                        if($diagnosis == true)
                        {
                            if($description == true)
                            {
                                $insert=mysqli_query($mysqli,"INSERT INTO radiology_record VALUES ('$ID','$doctor_id','$patient_id','$radiologist_id','$test_type','$prescribing_date','$test_date','$diagnosis','$description')");
                                echo "record creation successfull successful";
                                if ( false===$insert ) {
                                    printf("error: %s\n", mysqli_error($mysqli));
                                }
                            }
                            else
                                echo
                                "you need a description";
                            
                        }
                        else
                            echo
                            "no diagnosis";

                    }
                    else
                        echo
                        "when is the test conducted?";
                    
                }
                else
                    echo "when is the test prescribed?";
                
            }
            else
                echo"test type is null";
            
        }
        else
            echo "you need to enter a patient id";
        
    }
    else 
        echo "you need to enter a doctor id";

?>