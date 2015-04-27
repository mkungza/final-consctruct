$( document ).ready(function() {
	doQuery(1);
	doQuery(2);
});

function doQuery(selectid){
	$.ajax({
		url: "design_q.php",
		data: "selectid="+selectid,
		type: "POST",
		success: function(data) { 
			//alert(data);
			var li = "";
			var li2 = "";
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );

			$xml.find('row').each(function(){
				var prodid = $(this).find('prodid').text();
				var prodimg = $(this).find('prodimg').text();
				//alert(selectid);
				if(selectid == 1) {
			
					

					$(".bxslider1").append('<li style="float: left; list-style: none; position: relative; width: 788px;"><img src="data:image/jpeg;base64,'+prodimg+'" id="'+prodid+'" width="800px" height="300px" title="wallpaper"/></li>');
					
					
				}
				else {
					$(".bxslider2").append('<li style="float: left; list-style: none; position: relative; width: 788px;"><img src="data:image/jpeg;base64,'+prodimg+'" id="'+prodid+'" width="800px" height="300px" title="tile"/></li>');
				}
			
			});
			if(selectid ==1 ) {
				setSlide(1);
			}
			else {
				setSlide(2);
			}
		}
		
	});

}
function setSlide(id) {
	$('.bxslider'+id).bxSlider({
	  pagerCustom: '#bx-pager',
	  infiniteLoop: false,
	  hideControlOnEnd: true,
	  captions: true
	});
}