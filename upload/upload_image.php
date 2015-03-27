<html>
	<body>
    <?php

    session_start();
    
    $image = $_POST['image'];
    $record_id = $_POST['record_id'];
    
    $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
    
    $new_id = mysqli_query($mysqli,"SELECT MAX(`image_id`) FROM pacs_images");
    $new_id_num = mysqli_fetch_row(); //This is an array, so use $get new_id_num[0]
    
    $result = mysqli_query($mysqli,"INSERT INTO pacs_images VALUES ('$record_id')");
                                echo "image added successfully";
    
    ?>
    </body>
</html>
