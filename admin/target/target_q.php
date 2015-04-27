<?php
include("../../connection.php");

$prodid = "";
$str = "";

if (isset($_POST["getType"]) && !empty($_POST["getType"])) {

	if($_POST["getType"])
	{
		$str = doQuerygetType();
		echo $str;
	}
}
mysql_close();

function doQuerygetType() {
	$sql = "SELECT userid,name FROM tuser";
	$result = mysql_query($sql);
	$str = "<head>";
	while($uid = mysql_fetch_array($result))
	{
		$str.=("<row>");
		$str.=("<userid>".$uid["userid"]."</userid>");
		$str.=("<name>".$uid["name"]."</name>");
		$str.=("</row>");
	}
	$str .= "</head>";
	return $str;
}


?>