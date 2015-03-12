<html>
	<body>
	<?php   
   	 
		session_start();
        
		if(isset($_POST['search_term'])){        	
			
            $searchTerm = $_POST['search_term'];
            
			echo $searchTerm;         
		}	
	
		?>
	</body>
</html>
