<?php
include("../../connection.php");


$strSort  ="";
$strOrder = "";
$pageNow= 1;
$start ="";
$end = "";
$prodid = "";
$userid = "";
if (isset($_POST["page"]) && !empty($_POST["page"])) {
	$pageNow = $_POST["page"];    
}
if (isset($_POST["sort"]) && !empty($_POST["sort"])) {
	$strSort = $_POST["sort"];    
}
if (isset($_POST["order"]) && !empty($_POST["order"])) {
	$strOrder = $_POST["order"];    
}
if (isset($_POST["start"]) && !empty($_POST["start"])) {
	$start = $_POST["start"];    
}
if (isset($_POST["end"]) && !empty($_POST["end"])) {
	$end = $_POST["end"];    
}
if (isset($_POST["ddlprod"]) && !empty($_POST["ddlprod"])) {
	$prodid = $_POST["ddlprod"];    
}
if (isset($_POST["userid"]) && !empty($_POST["userid"])) {
	$userid = $_POST["userid"];    
}

if($start!="" && $end!="" || $prodid != "" || $userid !="")
{
	$result = getTransactionByDate($pageNow,$strSort,$strOrder,$start,$end,$prodid,$userid);
	echo $result;
}
else
{
	$result = getTransaction($pageNow,$strSort,$strOrder,$userid);
	echo $result;
}

mysql_close();

function getTransactionByDate($pageNow,$strSort,$strOrder,$start,$end,$prodid,$userid){
	$str="";
	$uid="";
	$sql = "SELECT ta.tranid as tranid,ta.createdate as createdate,p.prodname as prodname,td.transdprice as price,td.transdqty as qty,tu.name as name
			FROM ttransact ta
			INNER JOIN tuser tu on tu.userid = ta.userid
			INNER JOIN ttransdetail td on td.tranid = ta.tranid
			INNER JOIN tprod p on p.prodid = td.prodid
			where ";
			if($start!="" && $end!="" && $prodid != "" && $userid != ""){
				$sql .= "p.prodid = '$prodid' and tu.userid = $userid and createdate between '$start' and '$end'";
			}
			else if ($start!="" && $end!="" && $userid != ""){
				$sql .= "createdate between '$start' and '$end' and tu.userid = '$userid'";
			}
			else if ($start!="" && $end!="" && $prodid != ""){
				$sql .= "createdate between '$start' and '$end' and p.prodid = '$prodid'";
			}
			else if($prodid!=""){
				$sql .= "p.prodid = '$prodid'";
			}
			else if($userid != "")
			{
				$sql .= "tu.userid = '$userid'";
			}
			
			//echo $sql ;
			

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
	$strSort = "tranid";
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
		$str.=("<tranid>".$uid["tranid"]."</tranid>");
		$str.=("<prodname>".$uid["prodname"]."</prodname>");
		$str.=("<price>".$uid["price"]."</price>");
		$str.=("<qty>".$uid["qty"]."</qty>");
		$str.=("<name>".$uid["name"]."</name>");
		$str.=("<createdate>".$uid["createdate"]."</createdate>");
		$str.=("</row>");
	}
	$str .= "</head>";
	return $str;
}

function getTransaction($pageNow,$strSort,$strOrder,$userid){
	$str="";
	$uid="";
	if($userid!="")
	{
		$sql = "SELECT ta.tranid as tranid,ta.createdate as createdate,p.prodname as prodname,td.transdprice as price,td.transdqty as qty,tu.name as name
				FROM ttransact ta
				INNER JOIN tuser tu on tu.userid = ta.userid
				INNER JOIN ttransdetail td on td.tranid = ta.tranid
				INNER JOIN tprod p on p.prodid = td.prodid
				WHERE tu.userid = '$userid'
				";
	}
	else{
		$sql = "SELECT ta.tranid as tranid,ta.createdate as createdate,p.prodname as prodname,td.transdprice as price,td.transdqty as qty,tu.name as name
		FROM ttransact ta
		INNER JOIN tuser tu on tu.userid = ta.userid
		INNER JOIN ttransdetail td on td.tranid = ta.tranid
		INNER JOIN tprod p on p.prodid = td.prodid
		";

	}	
	
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
	$strSort = "tranid";
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
		$str.=("<tranid>".$uid["tranid"]."</tranid>");
		$str.=("<prodname>".$uid["prodname"]."</prodname>");
		$str.=("<price>".$uid["price"]."</price>");
		$str.=("<qty>".$uid["qty"]."</qty>");
		$str.=("<name>".$uid["name"]."</name>");
		$str.=("<createdate>".$uid["createdate"]."</createdate>");
		$str.=("</row>");
	}
	$str .= "</head>";
	return $str;
}


?>