$( document ).ready(function() {
	getRole();
		
	
	
	$("#editproductform").submit(function() {
		doSubmit(this);
		return false;
	});
	
	$('#back').click(function(){
		window.location = '/construct/admin/transaction/transaction.php';
	});

});


function getRole() {
	$.ajax({
		url: "editTrans_q.php",
		type: "POST",
		data: "getrole=true",
		success: function(data){ 
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			$xml.find('row').each(function(d){
				$('#status').append("<option value="+$(this).find('tstatusid').text()+">"+$(this).find('tstatusname').text()+"</option>");
			});
		}
	});
}

function doSubmit(aform) {
	
	// aform.submit();
	$.ajax({
		url: "editTrans_p.php",
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


function locationPage(result) {
	if(result == "Y") {
		location.href = "/construct/admin/transaction/transaction.php";
	}
	else {
		location.href = "/construct/admin/transaction/transaction.php";
	}

}
function setQueryData(prodtypename) {
	$("#pname").val(prodtypename);
	
}