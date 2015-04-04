<?php

session_start();

session_destroy();

echo "you have been logged out";

echo "heading back to login page";

header( "refresh:3; url=/index.html" ); 


?>