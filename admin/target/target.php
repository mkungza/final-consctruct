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
	<link href="target.css" rel="stylesheet"/>
	
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
	<script type="text/javascript" src="target.js"></script>
	
	
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
						<h2 class="page-header">Target Employee</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12" style="height:50px" id="searchbar">
						<div class="col-lg-12 clearl" >
							<form id="getSearch" method="post" action="target_p.php">
								<div class="col-lg-4">
									User :<select class="form-control" name="ddlprod" id="ddlprod" style="width:80%;display:inline"><option value="">Search By User</option></select>
								</div>
								<div class="col-lg-4">
									&nbsp; <input type="button" class="btn btn-default" value="Search" id="btnsearch">
								</div>
								
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
										<th><a class="sort" value="userid">ID</a></th>
                                        <th><a class="sort" value="name">Name</a></th>
                                        <th><a class="sort" value="tot">Total</a></th>
                                        <th><a class="sort" value="detail">Detail</a></th>
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
						<input type="hidden" id="strOrderNow"><br/>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
	<script>
		if("<?php echo $_SESSION["role"]?>"=="employee"){
			$('#searchbar').css('display','none');
		}
	</script>
</html>
