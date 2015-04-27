<?php
session_start();
include("../connection.php");
$username = "";
$password = "";
$userid = "";
if (isset($_POST["username"]) && !empty($_POST["username"])) {
	$username = $_POST["username"];    
}
if (isset($_POST["password"]) && !empty($_POST["password"])) {

	$password = $_POST["password"];
}
$str = "";
if(checkUserData($username,$password)) {
	$str.=("<login>");
	$str.=("<result>Y</result>");
	$str.=("<reason>Login Success.</reason>");
	$str.=("<userid>".$userid."</userid>");
	$str.=("</login>");
	echo $str;

}
else {
	$str.=("<login>");
	$str.=("<result>N</result>");
	$str.=("<reason>Username or Password is invalid.</reason>");
	$str.=("</login>");
	echo $str;
	mysql_close();
}

function checkUserData($username,$password) {
	global $userid;
	$sql = "select tu.userid,tu.username,tu.password,tug.groupname from tuser tu,tusergrp tug where tu.username='$username' and tu.usergrpid = tug.groupid;";
	$result = mysql_query($sql);
	$uid = mysql_fetch_array($result);
	$usernamedb = "";
	$passworddb = "";
	if($uid!=null) {

		$usernamedb = $uid['username'];
		$passworddb = $uid['password'];
		$_SESSION['userid'] = $uid['userid'];
		$_SESSION['username'] = $uid['username'];
		$_SESSION['role'] = $uid['groupname'];
		$userid = $uid['userid'];
	}
	if(validateUserPassword($username,$password,$usernamedb,$passworddb)) {
		return true;
	}
	return false;
	
}
function validateUserPassword($username,$password,$usernamedb,$passworddb) {
	if($username != $usernamedb) {
		return false;
	}
	else if($password != $passworddb) {
		return false;
	}
	return true;
}
?>