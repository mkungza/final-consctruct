<?php
    session_Start();
	unset($_SESSION["username"]);
	unset($_SESSION["userid"]);
	unset($_SESSION["role"]);
	header( "location: /construct/index.php" );
	session_destroy();
?> 
