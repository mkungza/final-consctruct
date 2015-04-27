<?php
session_start();
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
if (isset($_POST["ddlprod"]) && !empty($_POST["ddlprod"])) {
	$userid = $_POST["ddlprod"];    
}
if(isset($userid))
{
	$result = getTargetByUser($pageNow,$strSort,$strOrder,$userid);
	echo $result;
}
else
{
	$result = getTarget($pageNow,$strSort,$strOrder);
	echo $result;
}
mysql_close();

function getTargetByUser($pageNow,$strSort,$strOrder,$userid){
	$str="";
	$uid="";
	$userids = $_SESSION['userid'];
	if($_SESSION["role"]=="employee")
	{
		$sql = "select s.userid as userid,s.name as name,sum(amount) as total from ttransact t inner join tuser s on s.userid = t.userid where s.userid='$userids' group by t.userid";
	}
	else 
	{
		$sql = "select s.userid as userid,s.name as name,sum(amount) as total from ttransact t inner join tuser s on s.userid = t.userid where s.userid='$userid' group by t.userid";
	}
	
	$result2 = mysql_query($sql);
	$numrow = mysql_num_rows($result2);
	
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
	$strSort = "name";
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
		$str.=("<userid>".$uid["userid"]."</userid>");
		$str.=("<name>".$uid["name"]."</name>");
		$str.=("<total>".$uid["total"]."</total>");
		$str.=("</row>");
	}
	$str .= "</head>";
	return $str;
}

function getTarget($pageNow,$strSort,$strOrder){
	$str="";
	$uid="";
	$userid = $_SESSION['userid'];
	if($_SESSION["role"]=="employee")
	{
		$sql = "select s.userid as userid,s.name as name,sum(amount) as total from ttransact t inner join tuser s on s.userid = t.userid where s.userid='$userid' group by t.userid";
	}
	else
	{
		$sql = "select s.userid as userid,s.name as name,sum(amount) as total from ttransact t inner join tuser s on s.userid = t.userid group by t.userid";
	}
	
	$result2 = mysql_query($sql);
	$numrow = mysql_num_rows($result2);
	
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
	$strSort = "name";
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
		$str.=("<userid>".$uid["userid"]."</userid>");
		$str.=("<name>".$uid["name"]."</name>");
		$str.=("<total>".$uid["total"]."</total>");
		$str.=("</row>");
	}
	$str .= "</head>";
	return $str;
}


?>