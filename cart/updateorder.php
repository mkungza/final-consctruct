<?php
session_start();
$str = "";
$formid = isset($_POST['formid']) ? $_POST['formid'] : $_SESSION['formid'];
$userid = isset($_POST['userid']) ? $_POST['userid'] : $_SESSION['userid'];
/*if ($formid != $_POST['formid']) {
	$str = "<updateorder>";
	$str.="<result>N</result>";
	$str.="<reason>SESSION ERROR.</reason>";
	$str.="</updateorder>";
} else {*/
	//unset($_SESSION['formid']);
	if ($_POST) {
		include("../connection.php");
		$order_fullname = mysql_real_escape_string($_POST['order_fullname']);
		$order_address = mysql_real_escape_string($_POST['order_address']);
		$order_phone = mysql_real_escape_string($_POST['order_phone']);
 		$totalprice = mysql_real_escape_string($_POST['totalprice']);
 		$isPromotion = 0;
		$meSql = "INSERT INTO ttransact (createdate, userid, amount, transname, transaddr, transtel) VALUES (NOW(),'{$userid}','{$totalprice}','{$order_fullname}','{$order_address}','{$order_phone}') ";
		$meQeury = mysql_query($meSql);
		if ($meQeury) {
			$order_id = mysql_insert_id();
			if(isset($_POST['qty'])) {
				$isPromotion = 0;
				for ($i = 0; $i < count($_POST['qty']); $i++) {
					$order_detail_quantity = mysql_real_escape_string($_POST['qty'][$i]);
					$order_detail_price = mysql_real_escape_string($_POST['product_price'][$i]);
					$product_id = mysql_real_escape_string($_POST['product_id'][$i]);
					$lineSql = "INSERT INTO ttransdetail (transdqty, transdprice, prodid, tranid,isPromotion) ";
					$lineSql .= "VALUES (";
					$lineSql .= "'{$order_detail_quantity}',";
					$lineSql .= "'{$order_detail_price}',";
					$lineSql .= "'{$product_id}',";
					$lineSql .= "'{$order_id}' ,";
					$lineSql .= "'{$isPromotion}'";
					$lineSql .= ") ";
					mysql_query($lineSql);
					/*$lineSql = "UPDATE tprod set qty=qty-'{$order_detail_quantity}' where prodid='{$product_id}' ";
					mysql_query($lineSql);*/
				}
			}
			if(isset($_POST['qtyCollect'])) {
				$isPromotion = 1;
				for ($i = 0; $i < count($_POST['qtyCollect']); $i++) {
					$order_detail_quantity = mysql_real_escape_string($_POST['qtyCollect'][$i]);
					$order_detail_price = mysql_real_escape_string($_POST['productCollect_price'][$i]);
					$product_id = mysql_real_escape_string($_POST['productCollect_id'][$i]);
					$lineSql = "INSERT INTO ttransdetail (transdqty, transdprice, prodid, tranid,isPromotion) ";
					$lineSql .= "VALUES (";
					$lineSql .= "'{$order_detail_quantity}',";
					$lineSql .= "'{$order_detail_price}',";
					$lineSql .= "'{$product_id}',";
					$lineSql .= "'{$order_id}',";
					$lineSql .= "'{$isPromotion}'";
					$lineSql .= ") ";
					mysql_query($lineSql);
					/*$qry =  "select prodid,qty from tipromo where promoid='{$product_id}' ";
					$qryQty = mysql_query($qry);
					while ($qtyResult = mysql_fetch_array($qryQty)) {
						$qty = $qtyResult['qty'];
						$prodid = $qtyResult['prodid'];
						$lineSql = "UPDATE tprod set qty=qty-'{$qty}' where prodid='{$prodid}' ";
						mysql_query($lineSql);
					}*/
				}
			}
			mysql_close();
			unset($_SESSION['cart']);
			unset($_SESSION['qty']);
			unset($_SESSION['isCollect']);
			unset($_SESSION['qtyCollect']);
			$str = "<updateorder>";
			$str.="<result>Y</result>";
			$str.="<reason>Order Success.</reason>";
			$str.="</updateorder>";
		}else{
			mysql_close();
			$str = "<updateorder>";
			$str.="<result>N</result>";
			$str.="<reason>Order Fail please try again.</reason>";
			$str.="</updateorder>";
		}
	}
	echo $str;
//}
?>