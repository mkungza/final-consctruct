<?php
include("../../connection.php");
if (isset($_POST["page"]) && !empty($_POST["page"])) {
	$pageNow = $_POST["page"];    
}
if (isset($_POST["sort"]) && !empty($_POST["sort"])) {
	$strSort = $_POST["sort"];    
}
if (isset($_POST["order"]) && !empty($_POST["order"])) {
	$strOrder = $_POST["order"];    
}
	

$result = getProduct($pageNow,$strSort,$strOrder);
echo $result;
mysql_close();

function getProduct($pageNow,$strSort,$strOrder){
	$str="";
	$uid="";
	$sql = "SELECT prodid,prodname,price,qty,measure,tpy.prodtypename as prodtype,case when limitreach>qty then 'yes' else 'no' end as limitr FROM tprod tp inner join tprodtype tpy on tpy.prodtypeid = tp.prodtypeid where tp.inShop = '1'";
	$result = mysql_query($sql);
	$numrow = mysql_num_rows($result);
	
	$Per_Page = 10;   // Per Page
	
	if(!$pageNow)
	{
	$pageNow=1;
	}
	$Prev_Page = $pageNow-1;
	$Next_Page = $pageNow+1;
	$Page_Start = (($Per_Page*$pageNow)-$Per_Page);
	if($numrow<=$Per_Page)
	{
	$Num_Pages =1;
	}
	else if(($numrow % $Per_Page)==0)
	{
	$Num_Pages =($numrow/$Per_Page) ;
	}
	else
	{
	$Num_Pages =($numrow/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
	}
	if($strSort == "")
	{
	$strSort = "prodid";
	}
	
	if($strOrder == "")
	{
	$strOrder = "DESC";
	}
	$sql .=" order  by ".$strSort." ".$strOrder." LIMIT $Page_Start , $Per_Page";
	$qry  = mysql_query($sql);
	$strNewOrder = $strOrder == 'ASC' ? 'DESC' : 'ASC';
	
	
	$str = "<head>";
	while($uid = mysql_fetch_array($qry))
	{
		$str.=("<row>");
		$str.=("<numrow>".$numrow."</numrow>");
		$str.=("<PrevPage>".$Prev_Page."</PrevPage>");
		$str.=("<pageNow>".$pageNow."</pageNow>");
		$str.=("<numpage>".$Num_Pages."</numpage>");
		$str.=("<strNewOrder>".$strNewOrder."</strNewOrder>");
		$str.=("<prodid>".$uid["prodid"]."</prodid>");
		$str.=("<prodname>".$uid["prodname"]."</prodname>");
		$str.=("<price>".$uid["price"]."</price>");
		$str.=("<qty>".$uid["qty"]."</qty>");
		$str.=("<measure>".$uid["measure"]."</measure>");
		$str.=("<prodtype>".$uid["prodtype"]."</prodtype>");
		$str.=("<limitr>".$uid["limitr"]."</limitr>");
		$str.=("</row>");
	}
	$str .= "</head>";
	return $str;
}


?>