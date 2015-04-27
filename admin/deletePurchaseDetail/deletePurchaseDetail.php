<?php
include("../../connection.php");
$Product = "";
if (isset($_GET["idpro"]) && !empty($_GET["idpro"])) {
	$idpro = $_GET["idpro"];  
}
if (isset($_GET["id"]) && !empty($_GET["id"])) {
	$Product = $_GET["id"]; 
}

if(deleteProduct($Product,$idpro)) {
	?>
	<script language = "javascript">
		alert("Delete Item Success");
		window.location = "/construct/admin/Purchase/Purchase.php";
	</script>
	<?php
}

mysql_close();

function deleteProduct($Product,$idpro) {
	$sql = "delete FROM tpurdetail where purdid = '$Product'";
	$result = mysql_query($sql);
	
	$sqlupdate = "UPDATE `tpurchase` SET amount=(SELECT sum(price) as tot FROM tpurdetail where purid = '$idpro') WHERE purid = '$idpro'";
	$result1 = mysql_query($sqlupdate);
	
	
	if($result!="") {
		return true;
	}
	else {
		return false;
	}
	
}


?>