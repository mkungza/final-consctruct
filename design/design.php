<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<script language="JavaScript" type="text/javascript" src="/construct/js/jquery-1.11.2.min.js"></script>
		<title>MOCKUP2</title>
		<meta name="description" content="MOCKUP" />
		<meta name="keywords" content="MOCKUP" />
		<meta name="author" content="MOCKUP" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/component.css" />
		<link rel="stylesheet" type="text/css" href="../css/center.css" />
   	 	<link rel="stylesheet" type="text/css" href="/construct/bootstrap/bootstrap.min.css" />
    	<script type="text/javascript" src="/construct/js/jquery.bxslider/jquery.bxslider.min.js"></script>
     
    	 <link href="/construct/css/jquery.bxslider.css" rel="stylesheet" />
		
		<script type="text/javascript" src="design.js"></script>
		
		<!--[if IE]>
  		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<?php include '../header.php'; ?>
			
			<div class="content">
				<div style="width:70%; margin:0 auto;">
				<ul class="bxslider1">
				</ul>
				</div>
				<div style="width:70%; margin:0 auto;">
				<ul class="bxslider2">
				 
				</ul>
				</div>
				
		
			</div>
		</div>
			<script src="/construct/js/cbpFWTabs.js"></script>
			
	</body>
</html>

