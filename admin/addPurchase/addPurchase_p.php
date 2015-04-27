<?php
include("../../connection.php");

$userss = "";
$status = "";
$str = "";

if (isset($_POST["datepicker"]) && !empty($_POST["datepicker"])) {
	$date = date('Y-m-d H:i:s', strtotime($_POST["datepicker"]));
}
if (isset($_POST["userss"]) && !empty($_POST["userss"])) {

	$userss = $_POST["userss"];
}
if (isset($_POST["status"]) && !empty($_POST["status"])) {

	$status = $_POST["status"];
}

if(addPurchase($date,$userss,$status)){
	$str.=("<add>");
	$str.=("<result>Y</result>");
	$str.=("<reason>Add Product Success.</reason>");
	$str.=("</add>");
	echo $str;
}
else{
	$str.=("<add>");
	$str.=("<result>N</result>");
	$str.=("<reason>Add Product Error.</reason>");
	$str.=("</add>");
	echo $str;
}

mysql_close();



function addPurchase($date,$userss,$status){
	
	$sql = "INSERT INTO tpurchase( createdate, userid, status) VALUES ('$date','$userss','$status')";
	$result = mysql_query($sql);
	return true;
}


?>