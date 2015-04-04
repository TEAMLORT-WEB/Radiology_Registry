<?php
session_start();

if(!(isset($_SESSION['username']) and isset($_SESSION['id'])))
{
    echo"you're trying to access sensitive information, please login to verify your identity";
    header ("refresh:3;location:index.html");
}
$submit = @$_POST['submit'];
$condition = @$_POST['condition'];
if($submit)
{
    if($condition)
    {
    
    }
}

            $doctor_id = $_POST['doctor_id'];
            


            
            $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
            
            $result = mysqli_query($mysqli,"SELECT *
                                            FROM family_doctor
                                            WHERE doctor_id = ".$doctor_id."");
            
            $fetch_result = mysqli_fetch_all($result,MYSQLI_ASSOC);
            
            
            
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

        
    </head>
    
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
                            strVar += "    <p>Doctor Id: <input name =\"doctor_id\" type=\"text\"  placeholder="+doctor_id+" \/><\/p> ";
                            strVar += "    <p>Patient Id: <input name =\"patient_id\" type=\"text\" placeholder="+patient_id+" \/><\/p> ";
                            strVar += "    <p><input name =\"condition\" type=\"hidden\" value="+editoradd+"\/><\/p>";
                            strVar += "    <p><input name =\"submit_edit\" type=\"submit\"\/><\/p>";
                            strVar += "</form>";


                            $.Dialog.title("Perform Administrative Action");
                            $.Dialog.content(strVar);
                        }

                    });


                
            }
            
      
        </script>    

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
                                                 echo "<td> <button class='button small danger'>Delete</button></td>";
                                                 echo "<td> <button onclick = add(".$fetch_result[$i]['doctor_id'].",".$fetch_result[$i]['patient_id'].",'edit'"."); class='button small info'>Edit</button></td>";
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
