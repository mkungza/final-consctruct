<?php
include("../../connection.php");
$username = "";
$conpassword = "";
$email = "";
$name = "";
$tel = "";
$address = "";
$userid = "";
if (isset($_POST["userid"]) && !empty($_POST["userid"])) {

	$userid = $_POST["userid"];
}
if (isset($_POST["username"]) && !empty($_POST["username"])) {
	$username = $_POST["username"];    
}
if (isset($_POST["conpassword"]) && !empty($_POST["conpassword"])) {

	$conpassword = $_POST["conpassword"];
}
if (isset($_POST["email"]) && !empty($_POST["email"])) {

	$email = $_POST["email"];
}
if (isset($_POST["name"]) && !empty($_POST["name"])) {

	$name = $_POST["name"];
}
if (isset($_POST["tel"]) && !empty($_POST["tel"])) {

	$tel = $_POST["tel"];
}
if (isset($_POST["role"]) && !empty($_POST["role"])) {

	$role = $_POST["role"];
}
if (isset($_POST["address"]) && !empty($_POST["address"])) {

	$address = $_POST["address"];
}
$str = "";
if(checkUserData($userid,$conpassword)) {
	updateTuser($userid,$email,$tel,$name,$role,$address);
	$str.=("<register>");
	$str.=("<result>Y</result>");
	$str.=("<reason>Edit Profile Success.</reason>");
	$str.=("</register>");
	echo $str;

}
else {
	$str.=("<register>");
	$str.=("<result>N</result>");
	$str.=("<reason>Invalid Password.</reason>");
	$str.=("</register>");
	echo $str;

mysql_close();
}

function checkUserData($userid,$conpassword) {
	$sql = "select password from tuser where userid='$userid';";
	$result = mysql_query($sql);
	$uid = mysql_fetch_array($result);
	if($uid!=null) {
		if(!checkPassword($conpassword,$uid['password'])) {
			return false;
		}
	}
	return true;
}
function checkPassword($pass1,$pass2) {
	if($pass1 != $pass2) {
		return false;
	}
	return true;
}
function updateTuser($userid,$email,$tel,$name,$role,$address) {
	$updateSQL = "update tuser set email='$email', tel='$tel', name='$name',usergrpid='$role',address='$address' where userid='$userid'";
	mysql_query($updateSQL);
}
?>