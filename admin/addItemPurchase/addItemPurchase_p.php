<?php
include("../../connection.php");
$itemname = "";
$price = "";
$str = "";
$prodid = "";
$itemid = "";
if (isset($_POST["prodid"]) && !empty($_POST["prodid"])) {
	$prodid = $_POST["prodid"];    
}
if (isset($_POST["itemname"]) && !empty($_POST["itemname"])) {
	$itemid = $_POST["itemname"];    
}
if (isset($_POST["price"]) && !empty($_POST["price"])) {

	$price = $_POST["price"];
}
if (isset($_POST["qty"]) && !empty($_POST["qty"])) {

	$qty = $_POST["qty"];
}

$sql = "select prodname from tprod where prodid = '$itemid'";
$result = mysql_query($sql);
$u = mysql_fetch_array($result);
$itemname = $u["prodname"];

if(addProduct($itemid ,$prodid,$price,$qty)){
	$str.=("<add>");
	$str.=("<result>Y</result>");
	$str.=("<reason>Add Item Success.</reason>");
	$str.=("</add>");
	echo $str;
	
}
else{
	$str.=("<add>");
	$str.=("<result>N</result>");
	$str.=("<reason>Add Item Error.</reason>");
	$str.=("</add>");
	echo $str;
}

mysql_close();

function addProduct($itemid,$prodid,$price,$qty){
	
	$sql = "insert into tpurdetail (prodid, price, qty,purid) values('$itemid','$price','$qty','$prodid')";
	$result = mysql_query($sql);
	
	$update = "SELECT amount FROM tpurchase where purid = '$prodid'";
	$result = mysql_query($update);
	while($row = mysql_fetch_array($result)){
		$oldamount = $row["amount"];
		$tot = $price + $oldamount;
		$updateqty = "update tpurchase set amount = '$tot' where purid = '$prodid'";
	    mysql_query($updateqty);
	}
	// $updatePurchase = "SELECT purdid, prodid, qty, price, purid FROM tpurdetail WHERE purid = '$itemid'";
		// $result = mysql_query($updatePurchase);
		// while($row = mysql_fetch_array($result)){
			// $prodidpur = $row["prodid"];
			// $newqty = $row["qty"];
			// $sql = "select qty from tprod where prodid = '$prodidpur'";
			// $result2 = mysql_query($sql);
			// $q = mysql_fetch_array($result2);
			// $oldqty = $q["qty"];
			// $tot = $newqty + $oldqty;
			
			// $updateqty = "update tprod set qty = '$tot' where prodid = '$prodidpur'";
			// mysql_query($updateqty);
		// }
	
	return true;
}


?>