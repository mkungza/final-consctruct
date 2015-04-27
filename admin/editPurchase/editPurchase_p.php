<?php
include("../../connection.php");
$pname = "";
$price = "";
$Qty = "";
$Measure = "";
$Role = "";
$prodid = "";
if (isset($_POST["prodid"]) && !empty($_POST["prodid"])) {

	$prodid = $_POST["prodid"];
}
if (isset($_POST["userss"]) && !empty($_POST["userss"])) {

	$userss = $_POST["userss"];
}
if (isset($_POST["status"]) && !empty($_POST["status"])) {

	$status = $_POST["status"];
}
$str = "";
if(updateTprod($prodid,$status)){
	$str.=("<register>");
	$str.=("<result>Y</result>");
	$str.=("<reason>Edit Purchase Success.</reason>");
	$str.=("</register>");
	echo $str;

}
else {
	$str.=("<register>");
	$str.=("<result>N</result>");
	$str.=("<reason>Edit Purchase Error.</reason>");
	$str.=("</register>");
	echo $str;

mysql_close();
}

function updateTprod($prodid,$status) {
	$updateSQL = "UPDATE tpurchase SET status='$status' where purid='$prodid'";
	mysql_query($updateSQL);
	if($status == 2)
	{
		$updatePurchase = "SELECT purdid, prodid, qty, price, purid FROM tpurdetail WHERE purid = '$prodid'";
		$result = mysql_query($updatePurchase);
		while($row = mysql_fetch_array($result)){
			$prodidpur = $row["prodid"];
			$newqty = $row["qty"];
			$sql = "select qty from tprod where prodid = '$prodidpur'";
			$result2 = mysql_query($sql);
			$q = mysql_fetch_array($result2);
			$oldqty = $q["qty"];
			$tot = $newqty + $oldqty;
			
			$updateqty = "update tprod set qty = '$tot' where prodid = '$prodidpur' ";
			
			mysql_query($updateqty);
		}
	
	}
	return true;
}
?>