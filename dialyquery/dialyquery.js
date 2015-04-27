$( document ).ready(function() {
	doUpdate();

});

function doUpdate() {
	$.ajax({
		url: "/ConstructAPI/?method=all&format=xml",
		type: "GET",
		dataType: "html",
		success: function(data){ 
			//alert(data);
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			$xml.find('row').each(function(){

				updateQuery($(this).find('name').text(),$(this).find('price').text());
			});
		}
	});
}
function updateQuery(name,price) {
	$.ajax({
		url: "dialyquery.php",
		type: "POST",
		data: "name="+name+"&price="+price,
		success: function(data){ 
			//prompt('',data);
		}
	});
}