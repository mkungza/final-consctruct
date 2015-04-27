<?php
include("../connection.php");
$selectid = "";
$str = "";
if (isset($_POST["selectid"]) && !empty($_POST["selectid"])) {
	$selectid = $_POST["selectid"];
}
$str = queryData($selectid);
echo $str;
mysql_close();


function queryData($selectid) {
	$xml = "";
	$sql = "select * from tprod where prodtypeid='{$selectid}';";
	$result = mysql_query($sql);
	$xml.="<design>";
	$i = 1;
	while($uid = mysql_fetch_array($result)) {
		$xml.=('<row id="'.$i.'">');
		$xml.=("<prodid>".$uid['prodid']."</prodid>");
		$xml.=("<prodimg>".base64_encode( $uid['prodimg'] )."</prodimg>");
		$xml.=('</row>');
		$i++;
	}
	$xml.="</design>";
	return $xml;
}
?>