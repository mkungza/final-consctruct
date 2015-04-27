$( document ).ready(function() {
	$("#username").focus();
	
	getRole();
	setTimeout(function(){
		doQuery(),500
	});
	$("#editprofileform").submit(function() {
		doSubmit(this);
		return false;
	});
	
	$('#back').click(function(){
		window.location = '/construct/admin/User/user.php';
	});

});

function getRole() {
	$.ajax({
		url: "editprofile_q.php",
		type: "POST",
		data: "getrole=true",
		success: function(data){ 
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			$xml.find('row').each(function(d){
				$('#role').append("<option value="+$(this).find('groupid').text()+">"+$(this).find('groupname').text()+"</option>");
			});
		}
	});
}
function doQuery() {
	$.ajax({
		url: "editprofile_q.php",
		type: "POST",
		data: "userid="+$('#userid').val(),
		success: function(data){ 
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			var email = $xml.find( "email" ).text();
			var tel = $xml.find( "tel" ).text();
			var name = $xml.find( "name" ).text();
			var username = $xml.find( "username" ).text();
			var role = $xml.find( "role" ).text();
			var address = $xml.find( "address" ).text();
			setQueryData(username,email,tel,name,role,address);
		}
	});

}
function doSubmit(aform) {
	if(!chkNullValue()) {
		return false;
	}
	//aform.submit();
	$.ajax({
		url: "editprofile_p.php",
		type: "POST",
		data: $(aform).serialize(), 
		success: function(data){ 
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			var reason = $xml.find( "reason" ).text();
			var result = $xml.find( "result" ).text();
			alert(reason);
			locationPage(result);
		}
	});
	

}
function chkNullValue() {
	if($("#username").val() == "") {
		alert("Please enter your username");
		$("#username").focus();
		return false;
	}
	else if($("#conpassword").val() == "") {
		alert("Please enter confirm password");
		$("#conpassword").focus();
		return false;
	}
	else if($("#email").val() == "") {
		alert("Please enter email");
		$("#email").focus();
		return false;
	}
	return true;
}

function locationPage(result) {
	if(result == "Y") {
		location.href = "/construct/admin/user/user.php";
	}
	else {
		location.href = "/construct/admin/editprofile/editprofile.php";
	}

}
function setQueryData(username,email,tel,name,role,address) {
	$("#username").val(username);
	$("#email").val(email);
	$("#tel").val(tel);
	$("#name").val(name);
	$("#role").val(role);
	$("#address").val(address);
}