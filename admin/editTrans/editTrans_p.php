<?php
include("../../connection.php");
$pname = "";
$prodid = "";
if (isset($_POST["status"]) && !empty($_POST["status"])) {
	$status = $_POST["status"];    
}
if (isset($_POST["prodid"]) && !empty($_POST["prodid"])) {
	$prodid = $_POST["prodid"];    
}

$str = "";

if(updateTprod($prodid,$status)){
	$str.=("<Edit>");
	$str.=("<result>Y</result>");
	$str.=("<reason>Edit Status Success.</reason>");
	$str.=("</Edit>");
	echo $str;
}
else{
	$str.=("<Edit>");
	$str.=("<result>N</result>");
	$str.=("<reason>Edit Status Error.</reason>");
	$str.=("</Edit>");
	echo $str;
}
mysql_close();

function updateTprod($prodid,$status) {
	$updateSQL = "update ttransact set transtatus='$status' where tranid='$prodid'";
	mysql_query($updateSQL);
	
	if($status == "2")
	{
		$sql = "SELECT td.prodid as prodid,td.transdqty as qty,isPromotion 
				FROM ttransact ta
				INNER JOIN ttransdetail td on td.tranid = ta.tranid
				WHERE ta.tranid = '$prodid'";
		$qry = mysql_query($sql);
		while($result = mysql_fetch_array($qry))
		{
			if($result["isPromotion"] != 0)
			{
				$qtypromo = $result["qty"];
				$sql2 = "SELECT prodid,qty FROM tipromo where promoid = '".$result["prodid"]."'";
				$qrysql2 = mysql_query($sql2);
				while($resultsql2 = mysql_fetch_array($qrysql2))
				{
					$qtyfrompromo = $resultsql2["qty"];
					$productid2 = $resultsql2["prodid"];
					$newqty2 = $qtyfrompromo*$qtypromo;
					
					$sqlSelectOldqty = "select qty from tprod where prodid='$productid2'";
					$qry2 = mysql_query($sqlSelectOldqty);
					$result2 = mysql_fetch_array($qry2);
					$qtyold = $result2["qty"];
					$newqtyFin = $qtyold-$newqty2;
					
					$sqlupdateProduct = "update tprod set qty='$newqtyFin' where prodid = '$productid2'";
					mysql_query($sqlupdateProduct);
				}
				
				
			}
			else{
				$productid = $result["prodid"];
				$qty = $result["qty"];
				
				$sqlSelectOldqty = "select qty from tprod where prodid='$productid'";
				$qry2 = mysql_query($sqlSelectOldqty);
				$result2 = mysql_fetch_array($qry2);
				$qtyold = $result2["qty"];
				$newqty = $qtyold-$qty;
				
				
				$sqlupdateProduct = "update tprod set qty='$newqty' where prodid = '$productid'";
				mysql_query($sqlupdateProduct);
			}
		}
	}
	return true;
}
?>