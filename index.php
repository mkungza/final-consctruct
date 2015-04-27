<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>MOCKUP2</title>
		<meta name="description" content="MOCKUP" />
		<meta name="keywords" content="MOCKUP" />
		<meta name="author" content="MOCKUP" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/responsiveslides.css" />
		<script language="JavaScript" type="text/javascript" src="/construct/js/jquery-1.11.2.min.js"></script>
		<script language="JavaScript" type="text/javascript" src="/construct/js/responsiveslides.min.js"></script>
		<!--[if IE]>
  		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<?php include 'header.php'; ?>
			<article>
				<ul class="rslides">
				  <li><img class "rslides-image" src="/construct/images/con1.jpg" alt=""></li>
				  <li><img class "rslides-image" src="/construct/images/con2.jpg" alt=""></li>
				  <li><img class "rslides-image" src="/construct/images/con3.jpg" alt=""></li>
				</ul>
			</article>
			<footer>
			
			</footer>
		</div>
		<script src="js/cbpFWTabs.js"></script>
		<script>
		  $(function() {
			$(".rslides").responsiveSlides();
		  });
			new CBPFWTabs( document.getElementById( 'tabs' ) );
		</script>
	</body>
</html>
