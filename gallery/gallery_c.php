<?php
include("../connection.php");
$str = "";
$sql = "select * from tpromo";
$result = mysql_query($sql);
$str.=("<collection>");
$i = 1;
while($fresult = mysql_fetch_array($result)) {
	$str.=('<row id="'.$i.'">');
	$str.=("<prodid>".$fresult['promoid']."</prodid>");
	$str.=("<prodname>".$fresult['promoname']."</prodname>");
	$str.=("<prodprice>".$fresult['promoprice']."</prodprice>");
	$str.=("<prodimg>".base64_encode( $fresult['promoimage'] )."</prodimg>");
	$str.=("<iscollection>1</iscollection>");
	$str.=("</row>");
	$i++;
}

$str.=("</collection>");
echo $str;



mysql_close();



?>