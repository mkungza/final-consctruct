$( document ).ready(function() {
	$('.fa.fa-exchange').parent().parent().attr("class","active");
	
	getUser();
	getStatus();
	
	$('#status').attr("disabled","disabled");
	if($('#checkrole').val() == "admin")
	{
		$('#userss').attr("disabled","disabled");
	}
	
	$( "#datepicker" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true
    });
	
	$("#addPurchase").submit(function() {
		doSubmit(this);
		return false;
    });

    $('#back').click(function () {
        window.location = '/construct/admin/Purchase/Purchase.php';
    });
});

function getUser(){
	$.ajax({
		url: "addPurchase_q.php",
		type: "POST",
		data: "getUsers=true",
		success: function(data){ 
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			$xml.find('row').each(function(d){
				$('#userss').append("<option value="+$(this).find('userid').text()+">"+$(this).find('name').text()+"</option>");
			});
		}
	});
}

function getStatus(){
	$.ajax({
		url: "addPurchase_q.php",
		type: "POST",
		data: "getStatus=true",
		success: function(data){ 
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			$xml.find('row').each(function(d){
				$('#status').append("<option value="+$(this).find('statusid').text()+">"+$(this).find('statusname').text()+"</option>");
			});
		}
	});
}

function doSubmit(aform) {
	if(!chkNullValue()) {
		return false;
	}
	//aform.submit();
	$('#userss').removeAttr("disabled");
	$('#status').removeAttr("disabled");
	$.ajax({
		url: "addPurchase_p.php",
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
	if($("#pname").val() == "") {
		alert("Please enter your productname");
		$("#pname").focus();
		return false;
	}
	return true;
}

function locationPage(result) {
	if(result == "Y") {
		location.href = "/construct/admin/Purchase/Purchase.php";
	}
	else {
		location.href = "/construct/admin/addPurchase/addPurchase.php";
	}
}
