<?php
include("../../connection.php");

$prodid = "";
$str = "";



$str = queryData();
echo $str;

mysql_close();

function queryData() {
	$sql = "SELECT tstatusid,tstatusname from ttranstatus";
	$result = mysql_query($sql);
	$str = "<head>";
	while($uid = mysql_fetch_array($result))
	{
		$str.=("<row>");
		$str.=("<tstatusid>".$uid["tstatusid"]."</tstatusid>");
		$str.=("<tstatusname>".$uid["tstatusname"]."</tstatusname>");
		$str.=("</row>");
	}
	$str .= "</head>";
	return $str;
	
}
?>