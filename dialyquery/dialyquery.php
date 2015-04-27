<?php
include("../connection.php");
$name = "";
$price = "";
if (isset($_POST["name"]) && !empty($_POST["name"])) {

	$name = $_POST["name"];
}
if (isset($_POST["price"]) && !empty($_POST["price"])) {

	$price = $_POST["price"];
}
updatePrice($name,$price);

function updatePrice($name,$price) {
	$updateSQL = "update tprod set price='$price' where prodname='$name'";
	mysql_query($updateSQL);
	echo $updateSQL;
}
?>