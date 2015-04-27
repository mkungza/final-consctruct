var i = 1;
$( document ).ready(function() {
		doQuery();
		doQueryCollection();
	
});
function doQuery(){
	$.ajax({
		url: "gallery_p.php",
		type: "POST",
		success: function(data){ 
			//alert(data);
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			$("#content1").append("<h3>Gallery</h3>");
			$xml.find('row').each(function(){
				var prodid = $(this).find('prodid').text();
				var prodname = $(this).find('prodname').text();
				var prodprict = $(this).find('prodprice').text();
				var prodqty = $(this).find('prodqty').text();
				var prodimg = $(this).find('prodimg').text();
				var iscollection = $(this).find('iscollection').text();
		
				$("#content1").append("<div id='"+i+"' class='mediabox'>");
			
				$("#"+i).html(' <img width="360px" height="195px" src="data:image/jpeg;base64,'+prodimg+'" alt="Construct Product" /> <a href="/construct/cart/updatecart.php?itemId='+prodid+'&isCollect='+iscollection+'" class="buy" onclick="return checkLogin()">Add to Cart</a> <input type="hidden" name="prodid" id="prodid" value="'+prodid+'"> <input type="hidden" name="iscollection" id="iscollection" value="'+iscollection+'"><p>'+prodname+'('+prodqty+')</p>');

				i++;
			});
	      
		}
	});
}

function doQueryCollection(){
	$.ajax({
		url: "gallery_c.php",
		type: "POST",
		success: function(data){ 
	
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			$("#content2").append("<h3>Collection</h3>");
			$xml.find('row').each(function(){
				var prodid = $(this).find('prodid').text();
				var prodname = $(this).find('prodname').text();
				var prodprict = $(this).find('prodprice').text();
				var prodimg = $(this).find('prodimg').text();
				var iscollection = $(this).find('iscollection').text();
				
				$("#content2").append("<div id='"+i+"' class='mediabox'>");
				$("#"+i).html(' <img width="360px" height="195px" src="data:image/jpeg;base64,'+prodimg+'" alt="Construct Product" /> <a href="/construct/cart/updatecart.php?itemId='+prodid+'&isCollect='+iscollection+'" class="buy" onclick="return checkLogin()">Add to Cart</a> <input type="hidden" id="prodid" value="'+prodid+'"> <p>'+prodname+'</p>');

				i++;
			});
		
		}
	});
}

function checkLogin() {
	//alert(session);
	if(session=="false") {
	    alert("Please Login.");
	     return false;
	}
	else {
		return true;
	}
}