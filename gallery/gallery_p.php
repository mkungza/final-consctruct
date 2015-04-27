<?php
include("../connection.php");
$str = "";
$sql = "select * from tprod where inshop='1'";
$result = mysql_query($sql);
$str.=("<gallery>");
$i = 1;
while($fresult = mysql_fetch_array($result)) {
	$str.=('<row id="'.$i.'">');
	$str.=("<prodid>".$fresult['prodid']."</prodid>");
	$str.=("<prodname>".$fresult['prodname']."</prodname>");
	$str.=("<prodprice>".$fresult['price']."</prodprice>");
	$str.=("<prodqty>".$fresult['qty']."</prodqty>");
	$str.=("<prodimg>".base64_encode( $fresult['prodimg'] )."</prodimg>");
	$str.=("<iscollection>0</iscollection>");
	$str.=("</row>");
	$i++;
}

$str.=("</gallery>");
echo $str;



mysql_close();



?>