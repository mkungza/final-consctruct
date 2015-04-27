var name = "";
var addr = "";
var tel = "";
$( document ).ready(function() {
	$("#checkdefault").hide();
	if(role=="customer") {
		doQuery();
		$("#checkdefault").show();
	}

	$("#default").click(function() {
		if($("#default").is(':checked')) {
			setQueryData(tel,name,addr);
		}
		else {
			$("#order_phone").val("");
			$("#order_fullname").val("");
			$("#order_address").val("");
		}
	});
});

function doQuery() {
	$.ajax({
		url: "order_q.php",
		type: "POST",
		data: "userid="+userid,
		success: function(data){ 
			//alert(data);
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			tel = $xml.find( "tel" ).text();
			name = $xml.find( "name" ).text();
			addr = $xml.find( "addr" ).text();
			setQueryData(tel,name,addr);
		}
	});

}

function setQueryData(order_phone,name,addr) {
	$("#order_phone").val(order_phone);
	$("#order_fullname").val(name);
	$("#order_address").val(addr);
}