<?php
session_start();

if(!(isset($_SESSION['username']) and !(isset($_SESSION['id']))))
{
    echo"<script>alert('you're trying to access sensitive information, please login to verify your identity');</script>";
    header ("url=/index.html");
}
if($_SESSION['class'] !='a')
{
    echo"<script>alert('you do not authorized to access this page');</script>";
    header ("url=/home.php");
}      


$mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
$submit = @$_POST['submit_action'];
$condition = @$_POST['condition'];

    if($submit)
    {
        
       
        if($condition=='add/')
        {   $updateinfo_patient =mysqli_real_escape_string($mysqli,@$_POST['infopatientid']);
            $updateinfo_doctor =mysqli_real_escape_string($mysqli,@$_POST['infodoctorid']);

            $result = mysqli_query($mysqli,"INSERT INTO `radiology`.`family_doctor` (`doctor_id`, `patient_id`) VALUES (".$updateinfo_doctor.", ".$updateinfo_patient.");  ");
        
        }
        else if($condition =='edit')
        {
            $oldinfo_patient =mysqli_real_escape_string($mysqli, @$_POST['oldpatientvalue']);
            $cuurentinfo_doctor=mysqli_real_escape_string($mysqli,@$_POST['normaldoctorid']);
            $updateinfo_patient =mysqli_real_escape_string($mysqli,@$_POST['infopatientid']);

            $result = mysqli_query($mysqli,"UPDATE `radiology`.`family_doctor` SET `patient_id` = "."'".$updateinfo_patient."'"." WHERE `family_doctor`.`doctor_id` = "."'".$cuurentinfo_doctor."'"." AND `family_doctor`.`patient_id` = "."'".$oldinfo_patient."'"."; ");
        }
        else if($condition =='delete')
        {
            $delete_patient =mysqli_real_escape_string($mysqli, @$_POST['deletepatientvalue']);
            $delete_doctor=mysqli_real_escape_string($mysqli,@$_POST['deletedoctorvalue']);

        
            $result = mysqli_query($mysqli,"DELETE FROM `radiology`.`family_doctor` WHERE `family_doctor`.`doctor_id` = "."'".$delete_doctor."'"." AND `family_doctor`.`patient_id` = "."'".$delete_patient."'"." ;");
        }
    }
    
        $doctor_id;
    
        if(isset($_POST['doctor_id']))
        {
            $doctor_id = $_POST['doctor_id'];
        }
        elseif(isset($_POST['infodoctorid']))
        {
            $doctor_id = @$_POST['infodoctorid'];
        }
        elseif(isset($_POST['normaldoctorid']))
        {
            $doctor_id = @$_POST['normaldoctorid'];
        }
        elseif(isset($_POST['deletedoctorvalue']))
        {
            $doctor_id = @$_POST['deletedoctorvalue'];
        }
        
        if($doctor_id)
        {
            $doctor_id = str_replace('/','',$doctor_id);
            
            
            $result = mysqli_query($mysqli,"SELECT *
                                            FROM family_doctor
                                            WHERE doctor_id = ".$doctor_id."");
            
            $fetch_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        else
        {   
            echo "pleae enter another doctor id";
            header ("refresh:3;location:editassignment.html");
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
        <script type="text/javascript" charset="UTF-8" >
                function add(doctor_id,patient_id,editoradd) {
        
                        $.Dialog({
                            shadow: true,
                            overlay: false,
                            draggable: true,
                            icon: '<span class="icon-wrench"></span>',
                            title: editoradd,
                            width: 'auto',
                            height: 'auto',
                            padding: 30,
                            content: 'This Window is draggable by caption.',
                            onShow: function () {
                            
                                var strVar = "";
                                strVar += "<form id=\"form1\" method =\"post\"> ";
                                strVar += "    <p>Doctor Id: <input name =\"infodoctorid\" type=\"text\"  \/><\/p> ";
                                strVar += "    <p>Patient Id: <input name =\"infopatientid\" type=\"text\"  \/><\/p> ";
                                strVar += "    <p><input name =\"condition\" type=\"hidden\" value="+editoradd+"/><\/p>";
                                strVar += "    <p><input name =\"submit_action\" type=\"submit\" value=\"submit\" \/><\/p>";
                                strVar += "</form>";
        
        
                                $.Dialog.title("Assign New patient To Doctor");
                                $.Dialog.content(strVar);
                            }
        
                        });
                }
                function edit(doctor_id,patient_id,editoradd) {
                
                        $.Dialog({
                            shadow: true,
                            overlay: false,
                            draggable: true,
                            icon: '<span class="icon-wrench"></span>',
                            title: editoradd,
                            width: 'auto',
                            height: 'auto',
                            padding: 30,
                            content: 'This Window is draggable by caption.',
                            onShow: function () {
                            
                                var strVar = "";
                                strVar += "<form id=\"form1\" method =\"post\"> ";
                                strVar += "    <p>Doctor Id:" +doctor_id+" <p><input name =\"normaldoctorid\" type=\"hidden\" value="+doctor_id+"\/><\/p>";
                                strVar += "    <p>Patient Id: <input name =\"infopatientid\" type=\"text\" placeholder="+patient_id+" \/><\/p> ";
                                strVar += "    <p><input name =\"oldpatientvalue\" type=\"hidden\" value="+patient_id+"\/><\/p>";
                                strVar += "    <p><input name =\"condition\" type=\"hidden\" value="+editoradd+" /><\/p>";
                                strVar += "    <p><input name =\"submit_action\" type=\"submit\" value=\"submit\"\/><\/p>";
                                strVar += "</form>";
                
                
                                $.Dialog.title("Change Existing Assignment");
                                $.Dialog.content(strVar);
                            }
                
                        });
                        }
                function delete_assignment(doctor_id,patient_id,editoradd) {
                
                        $.Dialog({
                            shadow: true,
                            overlay: false,
                            draggable: true,
                            icon: '<span class="icon-wrench"></span>',
                            title: editoradd,
                            width: 'auto',
                            height: 'auto',
                            padding: 30,
                            content: 'This Window is draggable by caption.',
                            onShow: function () {
                            
                                var strVar = "";
                                strVar += "<form id=\"form1\" method =\"post\"> ";
                                strVar += "    <p>Are you Sure you want to Perform this?<\/p> ";
                                strVar += "    <p><input name =\"deletedoctorvalue\" type=\"hidden\" value="+doctor_id+"\/><\/p>";
                                strVar += "    <p><input name =\"deletepatientvalue\" type=\"hidden\" value="+patient_id+"\/><\/p>";
                                strVar += "    <p><input name =\"condition\" type=\"hidden\" value="+editoradd+" /><\/p>";
                                strVar += "    <p><input name =\"submit_action\" type=\"submit\" value=\"Confirm\"\/><\/p>";
                                strVar += "</form>";
                
                
                                $.Dialog.title("Delete Assigned Patient");
                                $.Dialog.content(strVar);
                            }
                
                        });
                        }
          
            </script>    
        

        
    </head>
    


	<body class="metro">
        <div class="grid">
        
            <div id="row0" class="row" >
                <div class="span12">
                    <div class="row">
                        <div class="span4 offset5">
                            <a href="home.php"><img src="Assets/AHS_Logo.jpg" alt="Alberta Health Services" height="100px" width ="auto"></a>
                        </div>           
                    </div>
                    <div class ="row">
                        <div class="span8 offset5">
                            <nav class='breadcrumbs'>
                                 <ul>
                                     <li><a href='home.php'>Home</a></li>
                                     <li><a href='modifyinfo.php'>Modify User Info</a></li>
                                     <li><a href='editassignment.php'>Change Doctor Patient Assignment</a></li>
                                     <li class='active'><a href='#'>Results</a></li>
                                 </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class ="span3"></div>
                            <div class ="span6 offset2">
                            <div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <?php
                                        for ($i = 0; $i < count($fetch_result); $i++){
                                            foreach ($fetch_result[$i] as $key => $value) {
                                                echo "<th class='text-left'>".$key."</th>";
                                                
                                            }
                                            break;
                                            
                                        }?>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                             for ($i = 0; $i < count($fetch_result); $i++){
                                                 echo"<tr>"; 
                                                 foreach ($fetch_result[$i] as $key => $value) {
                                                     echo "<td>".$value."</td>";
                                                     
                                                 }
                                                 echo "<td> <button onclick = delete_assignment(".$fetch_result[$i]['doctor_id'].",".$fetch_result[$i]['patient_id'].",'delete'"."); class='button small danger'>Delete</button></td>";
                                                 echo "<td> <button onclick = edit(".$fetch_result[$i]['doctor_id'].",".$fetch_result[$i]['patient_id'].",'edit'"."); class='button small info'>Edit</button></td>";
                                                 echo"</tr>";
                                             }
                                             
                                         ?> 
                                    </tbody>

                                    <tfoot>
                                    <?php
                                        echo "<td> <button onclick=add('','','add'); class='success'>Add New Assignment</button></td>";
                                    ?>
                                    </tfoot>
                                </table>
                            </div>
                        <div class ="span3"></div>
                   </div>
               </div>
           </div>
         </div>    
    </body>
</html>
<!--http://stackoverflow.com/questions/4746079/how-to-create-a-html-table-from-a-php-array-->
