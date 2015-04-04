<html>
    <head>
        <link rel="stylesheet" href="metro/css/metro-bootstrap.css">
        <link rel="stylesheet" href="metro/css/iconFont.min.css">
        <link rel="stylesheet" href="metro/css/metro-bootstrap-responsive.css">
        <script src="metro/jquery/jquery.min.js"></script>
        <script src="metro/jquery/jquery.widget.min.js"></script>
        <script src="metro/min/metro.min.js"></script>
        <script src="metro/min/load-metro.js"></script>
 
    </head>
    <body classes="metro">
        <div classes="grid">
        
        <div id="row0" classes="row" >
            <div classes="span12">
                <div classes="row">
                    <div classes ="span4"></div>
                    <div classes ="span4 offset2">
                        <a href="home.php"><img src="Assets/AHS_Logo.jpg" alt="Alberta Health Services" height="100px" width ="auto"></a>
    
    
	<?php   
    
    session_start();
    //Create a connection
    $mysqli = new mysqli("localhost", "root", "goodtogo", "radiology");
    if(isset($_POST['key']) and isset($_POST['id_provided']))
    {
        $searchID = $_POST['id_provided'];
        $new_first_name = mysqli_real_escape_string($mysqli,$_POST['first_name']);
        $new_last_name = mysqli_real_escape_string($mysqli,$_POST['last_name']);
        $new_address = mysqli_real_escape_string($mysqli,$_POST['address']);
        $new_email = mysqli_real_escape_string($mysqli,$_POST['email']);
        $new_phone = mysqli_real_escape_string($mysqli,$_POST['phone']);
        $sql = "UPDATE `radiology`.`persons` SET `first_name` = "."'".$new_first_name."'".", `last_name` = "."'".$new_last_name."'".", `address` = "."'". $new_address."'".", `email` = "."'".$new_email."'".", `phone` = "."'".$new_phone."'"." WHERE `persons`.`person_id` = "."'".$searchID."'".";";
        $insert=mysqli_query($mysqli,$sql);
        //$mysqli,"UPDATE persons SET first_name = ".$new_first_name.", last_name = ".$new_last_name.", address = ".$new_address.",email = ".$new_email.",phone = ".$new_phone." WHERE 'person_id' = ".$searchID
        Echo "Taking you back to User Info Modify page.";
        header( "refresh:3; url=/modifyinfo.php" ); 
        
        echo"<script>
            $(function(){
            
                $.Notify({
                    shadow: true,
                    position: 'bottom-right',
                    style: {background: 'green', color: 'white'},
                    content: 'Update Success'
                });
         
            });
            </script>";

        
        
        
        if ( false===$insert ) {
            printf("error: %s\n", mysqli_error($mysqli));
        }
    }else
    {
        
		if(isset($_POST['id_provided'])){        	
			
            $searchID = (int)$_POST['id_provided'];
            //echo gettype($searchID);

            if ($_SESSION['classes'] == 'a') {
            //there should only be one account for each id
            
                $result = mysqli_query($mysqli,"select * 
                                               from persons
                                               WHERE person_id = ".$searchID );
                
                
                $numrows = mysqli_num_rows($result);
                if($numrows != 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $db_first_name = $row['first_name'];
                        $db_last_name = $row['last_name'];
                        $db_address=$row['address'];
                        $db_email=$row['email'];
                        $db_phone=$row['phone'];
                           
                    }
                    //display for user to change info
                   echo'
                        <form name="modify" method="post" action="search_account_backend.php">
                            <label>Edit your First Name <br/>(old: '.$db_first_name.')</label>
                            <div classes="input-control text">
                                <input type="text" name="first_name">
                                <button classes="btn-clear"></button>
                            </div>
                            <label>Edit your Last Name <br/>(old: '.$db_last_name.') </label>
                            <div classes="input-control text">
                                <input type="text" name="last_name">
                                <button classes="btn-clear"></button>
                            </div>
                            <label>Edit your Address <br/>(old: '.$db_address.')</label>
                            <div classes="input-control text">
                                <input type="text" name="address" >
                                <button classes="btn-clear"></button>
                            </div>
                            <label>Edit your e-mail <br/>(old: '.$db_email.')</label>
                            <div classes="input-control text">
                                <input type="text" name="email" />
                                <button classes="btn-clear"></button>
                            </div>
                            <label>Edit your phone number <br/>(old: '.$db_phone.')</label>
                            <div classes="input-control text">
                                <input type="text" name="phone">
                                <button classes="btn-clear"></button>
                            </div>
                            <label>ID</label>
                            <div classes="input-control text">
                                <input type="text" name="id_provided" value='.$searchID.' readonly="readonly">
                                <button classes="btn-clear"></button>
                            </div>
                            <label></label>
                            <div classes="form-actions">
                                <INPUT TYPE = "Submit" classes="button primary" Name = "key" VALUE = "Update">
                            </div>
                        </form>
                      ';
                }else{
                    echo '<br/> No user with id: '.$searchID.' found,you can try entering a different id';
                    header( "refresh:3; url=/account_search.php" ); 
                }
                               
            } 
            else 
            {
                echo '<br/> Error: Invalid session classes, only admin can access this function,sending you back to homepage';
                header( "refresh:3; url=/home.php" ); 
            }
            
		}
        else 
        {
            echo '<br/> Error: no id provided';
            //header( "refresh:3; url=/home.php" ); 
        }
    }
	
		?>
        
        
        
        
        
        
        
        
        
        
        
        
	</body>
</html>
