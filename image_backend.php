<html>
	<body>
    <?php

    session_start();
    $img = $_FILES['image']['tmp_name'];
    $image = addslashes(file_get_contents($img));
    $record_id = $_POST['record_id'];
    
    $source = imagecreatefromjpeg($img);
    
    $size = 150; // new image width for thumbnail
    $size2 = 600; // new image width for regular size
        
    $width = imagesx($source);
    $height = imagesy($source);
    $ratio = $height/$width;
    
    if ($width <= $size) {
        $new_w = $width;
        $new_h = $height;
    } else {
        $new_w = $size;
        $new_h = abs($new_w * $ratio);
    }
    
    if ($width <= $size2) {
        $new_w2 = $width;
        $new_h2 = $height;
    } else {
        $new_w2 = $size2;
        $new_h2 = abs($new_w2 * $ratio);
    }
    
    $new_img = imagecreatetruecolor($new_w,$new_h); //For the thumbnail
    $new_img2 = imagecreatetruecolor($new_w2,$new_h2);; //For the normal size
    imagecopyresized($new_img,$source,0,0,0,0,$new_w,$new_h,$width,$height); //new_img is the thumbnail as an image
    imagecopyresized($new_img2,$source,0,0,0,0,$new_w2,$new_h2,$width,$height); //new_img2 is the normal size as an image
    //Convert back to binary to put into blob
    ob_start();
    imagejpeg($new_img);
    $new_image_string = ob_get_contents();
    ob_end_clean();
    $thumbnail = addslashes($new_image_string);
    
    ob_start();
    imagejpeg($new_img2);
    $new_image_string2 = ob_get_contents();
    ob_end_clean();
    $normalSize = addslashes($new_image_string2);
    
    $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
    
    //Generate a new ID based on the previous max ID.
    $result = mysqli_query($mysqli,"SELECT MAX(`image_id`) FROM pacs_images");
    
    $row = mysqli_fetch_row($result); //This returns an array, so use row[0] to get the highest id number.
    if($row[0] == NULL){
        $new_id = 0; 
    } else {
        $new_id = $row[0]+1; 
    }
    
    $insert = mysqli_query($mysqli,"INSERT INTO pacs_images VALUES ('$record_id', '$new_id', '$thumbnail', '$normalSize', '$image')");
    if ( false===$insert ) {
        printf("error: %s\n", mysqli_error($mysqli));
    } else {
        echo "New Image ID: ".$new_id;
        echo "<br>";
        echo "Image added successfully";
    }
        
    
    ?>
    </body>
</html>