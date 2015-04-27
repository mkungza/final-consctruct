<?php
include("../../connection.php");


$strSort  ="";
$strOrder = "";
$pageNow= 1;

checkTransaction();

if (isset($_POST["userid"]) && !empty($_POST["userid"])) {
	$userid = $_POST["userid"];   
	$result = getTransaction($pageNow,$strSort,$strOrder,$userid);
	echo $result;	
}
else{
	if (isset($_POST["page"]) && !empty($_POST["page"])) {
		$pageNow = $_POST["page"];    
	}
	if (isset($_POST["sort"]) && !empty($_POST["sort"])) {
		$strSort = $_POST["sort"];    
	}
	if (isset($_POST["order"]) && !empty($_POST["order"])) {
		$strOrder = $_POST["order"];    
	}
	$userid = "";
	$result = getTransaction($pageNow,$strSort,$strOrder,$userid);
	echo $result;
}
mysql_close();

function checkTransaction(){
	$sql = "SELECT tranid FROM ttransact WHERE DATEDIFF(NOW(),createdate) >3";	
	$result = mysql_query($sql);
	while($uid = mysql_fetch_array($result))
	{
		$id = $uid["tranid"];
		$sql1 = "delete FROM ttransact WHERE tranid = '$id'";	
		$result1 = mysql_query($sql1);
	}
	
}

function getTransaction($pageNow,$strSort,$strOrder,$userid){
	$str="";
	$uid="";
	if($userid!="")
	{
		$sql = "SELECT tranid,createdate,amount,tu.name as name, transname, transaddr,transtel ,ts.tstatusname as status,ts.tstatusid as statusid FROM ttransact ta inner join tuser tu on tu.userid = ta.userid inner join ttranstatus ts on ts.tstatusid = ta.transtatus  where ta.userid='$userid'";
	}
	else{
		$sql = "SELECT tranid,createdate,amount,tu.name as name, transname, transaddr,transtel ,ts.tstatusname as status,ts.tstatusid as statusid FROM ttransact ta inner join tuser tu on tu.userid = ta.userid inner join ttranstatus ts on ts.tstatusid = ta.transtatus  ";
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
		$str.=("<transname>".$uid["transname"]."</transname>");
		$str.=("<transaddr>".$uid["transaddr"]."</transaddr>");
		$str.=("<transtel>".$uid["transtel"]."</transtel>");
		$str.=("<amount>".$uid["amount"]."</amount>");
		$str.=("<name>".$uid["name"]."</name>");
		$str.=("<status>".$uid["status"]."</status>");
		$str.=("<statusid>".$uid["statusid"]."</statusid>");
		$str.=("<createdate>".$uid["createdate"]."</createdate>");
		$str.=("</row>");
	}
	$str .= "</head>";
	return $str;
}


?>