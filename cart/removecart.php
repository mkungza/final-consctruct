<?php
session_start();
 
$itemId = isset($_GET['itemId']) ? $_GET['itemId'] : "";
$isCollect = isset($_GET['isCollect']) ? $_GET['isCollect'] : "";
if (!isset($_SESSION['cart']))
{
    $_SESSION['cart'] = array();
    $_SESSION['qty'][] = array();
    $_SESSION['isCollect'] = array();
    $_SESSION['qtyCollect'][] = array();
}
if($isCollect!=1) {
	$key = array_search($itemId, $_SESSION['cart']);
	$_SESSION['qty'][$key] = "";
	$_SESSION['cart'] = array_diff($_SESSION['cart'], array($itemId));
}
else {
	$key = array_search($itemId, $_SESSION['isCollect']);
	$_SESSION['qtyCollect'][$key] = "";
	$_SESSION['isCollect'] = array_diff($_SESSION['isCollect'], array($itemId));
}
header('location:/construct/cart/cart.php?a=remove');
?>