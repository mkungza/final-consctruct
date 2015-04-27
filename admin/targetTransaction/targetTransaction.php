<?php
session_start();
include("../../connection.php");
if(isset($_SESSION["username"])=="")
{
	?>
	<script language = "javascript">
		alert("Access Denied");
		window.location.href = "/construct/admin/login/login.php";
	</script>
	<?php
}

if (isset($_POST["userid"]) && !empty($_POST["userid"])) {
	$s = $_POST["userid"];
	$sql = "select name from tuser where userid ='$s'";
	$q = mysql_query($sql);
	$result = mysql_fetch_array($q);
	$name = $result["name"];
}
else{
	$s = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
		
    <title>Administrator Page</title>
	
	<!--Page CSS -->
	<link href="targetTransaction.css" rel="stylesheet"/>
	
	<!--Page CSS -->
	<link href="jquery-ui.min.css" rel="stylesheet"/>
	
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!--<link href="css/plugins/morris.css" rel="stylesheet">-->

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	
	<!-- js -->
	<script type="text/javascript" src="targetTransaction.js"></script>
	
	<!-- jquery UI -->
	<script src="jquery-ui.min.js"></script>
	
</head>

<body>
	<div id="wrapper">
		<!--header -->
		<?php include '../header.php'?>
        <!--side menu-->
		<?php include '../menu.php'?>
		<div id="page-wrapper">	
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h2 class="page-header">Transaction</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12" style="height:100px">
						<div class="col-lg-12 clearl">
							<form id="getSearch" method="post" action="targetPurchase_p.php">
								<div class="col-lg-12 clearl">
									Date Start :<input type="text" class="form-control" id="datestart" style="width:20%;display:inline"> &nbsp; Date End :<input type="text" class="form-control" id="dateend" style="width:20%;display:inline"> 
								</div>
								<div class="col-lg-4">
									Product :<select class="form-control" name="ddlprod" id="ddlprod" style="width:80%;display:inline"><option value="">Search By Product</option></select>
								</div>
								<div class="col-lg-2">
									<?php if($s!="") echo "User : ".$name;?>
								</div>
								<div class="col-lg-2">
									&nbsp; <input type="button" class="btn btn-default" value="Search" id="btnsearch">
								</div>
								<input type="hidden" id="userids" value="<?php echo $s;?>">
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped" id="tableuser">
                                <thead>
                                    <tr>
                                        <th><a class="sort" value="tranid">ID</a></th>
                                        <th><a class="sort" value="createdate">Create Date</a></th>
                                        <th><a class="sort" value="prodname">Product Name</a></th>
                                        <th><a class="sort" value="price">Price</a></th>
                                        <th><a class="sort" value="qty">Qty</a></th>
                                        <th><a class="sort" value="user">User Name</a></th>
                                    </tr>
                                </thead>
                                <tbody align=center>
									
                                </tbody>
                            </table>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div id="results"><!-- content will be loaded here --></div>
						<input type="hidden" id="userid" value="<?php echo $s;?>">
						<input type="hidden" id="strOrderNow">
						<!--<input type="button" class="btn btn-default" value="Add Product" id="btnAdd"> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
