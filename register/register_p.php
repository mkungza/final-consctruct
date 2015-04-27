<?php
include("../connection.php");
$username = "";
$password = "";
$conpassword = "";
$email = "";
$name = "";
$addr = "";
$phone = "";

if (isset($_POST["username"]) && !empty($_POST["username"])) {
	$username = $_POST["username"];    
}
if (isset($_POST["password"]) && !empty($_POST["password"])) {

	$password = $_POST["password"];
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
if (isset($_POST["addr"]) && !empty($_POST["addr"])) {

	$addr = $_POST["addr"];
}
if (isset($_POST["phone"]) && !empty($_POST["phone"])) {

	$phone = $_POST["phone"];
}
$str = "";
if(checkUserData($username)) {
	insertIntoTuser($username,$password,$email,$name,$addr,$phone);
	$str.=("<register>");
	$str.=("<result>Y</result>");
	$str.=("<reason>Register Success.</reason>");
	$str.=("</register>");
	echo $str;

}
else {
	$str.=("<register>");
	$str.=("<result>N</result>");
	$str.=("<reason>Username is used.</reason>");
	$str.=("</register>");
	echo $str;

}

mysql_close();
function checkUserData($username) {
	$sql = "select username from tuser where username='$username';";
	$result = mysql_query($sql);
	$uid = mysql_fetch_array($result);
	if($uid!=null) {
		return false;
	}
	return true;
}
function insertIntoTuser($username,$password,$email,$name,$addr,$phone) {
	$sql = "insert into tuser (username,password,email,usergrpid,name,address,tel) values ('$username','$password','$email','3','$name','$addr','$phone')";
	$insert = mysql_query($sql);
}
?>