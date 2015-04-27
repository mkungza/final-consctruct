<?php

	if(!isset($_SESSION)){
		session_start();
	}
	$meSql = "SELECT * FROM products ";
	$meQuery = mysql_query($meSql);
	 
	$action = isset($_GET['a']) ? $_GET['a'] : "";
	$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
	if(isset($_SESSION['qty'])){
	    $meQty = 0;
	    foreach($_SESSION['qty'] as $meItem){
	        $meQty = $meQty + (int)$meItem;
	    }
	}else{
	    $meQty=0;
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
		<link rel="stylesheet" type="text/css" href="gallery.css" />
		<script language="JavaScript" type="text/javascript" src="/construct/js/responsiveslides.min.js"></script>
		<script type="text/javascript" src="gallery.js"></script>
		
		<!--[if IE]>
  		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
	<center>
	<?php
		if($action == 'exists'){
		    echo "<div class=\"alert alert-warning\">Add item number to your cart.</div>";
		}
		if($action == 'add'){
		    echo "<div class=\"alert alert-success\">Add item to your class success.</div>";
		}
		if($action == 'order'){
			echo "<div class=\"alert alert-success\">Order is success.</div>";
		}
		if($action == 'orderfail'){
			echo "<div class=\"alert alert-warning\">Order fail please try again.</div>";
		}
	?>
	</center>
		<div class="container">
			<?php include '../header.php'; ?>
			
			<div class="content">
			<section class="content-current" id="content1">
			</section>
			<section class="content-current" id="content2">
			</section>
			</div>
		</div>
		
	</body>
</html>

<?php $session = isset($_SESSION['userid']) ? 'true' : 'false' ?>"
<script>
    var session = "<?php echo $session; ?>";
</script>