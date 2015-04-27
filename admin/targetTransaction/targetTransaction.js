$( document ).ready(function() {
	//initial
	$('.fa.fa-credit-card').parent().parent().attr("class","active");
	
	var pageval = 1;
	var sortval = 'tranid';
	var orderval = 'desc';
	var userid = $('#userid').val();
	QuerygetType();
	
	$('#datestart').datepicker({
		dateFormat: 'yy-mm-dd' 
	});
	
	$('#dateend').datepicker({
		dateFormat: 'yy-mm-dd' 
	});
	
	$('#btnsearch').click(function(){
		var start = $('#datestart').val();
		var end = $('#dateend').val();
		var ddlprod = $('#ddlprod').val();
		var userids = $('#userids').val();
		reset();
		doQueryByDate(pageval,sortval,orderval,start,end,ddlprod,userids)
		
		
	});
	//alert(userid);
	setTimeout(function(){
		doQuery(pageval,sortval,orderval,userid),1000}
	);
	
	// $('#btnAdd').click(function(){
		// window.location = "/construct/admin/addProduct/addProduct.php";
	// });
	
	$('.sort').click(function(){
		sortval = $(this).attr('value');
		orderval = $('#strOrderNow').val();
		reset();
		doQuery(pageval,sortval,orderval,userid);
	});
	
	$(document).on('click','.getpage',function(){
		pageval = $(this).attr('value');
		//orderval = $('#strOrderNow').val();
		reset();
		doQuery(pageval,sortval,orderval,userid);
	});
	
	
});
function reset(){
	$("#tableuser").find("tbody").html('');
	$('#results').html('');
}


function QuerygetType() {
	$.ajax({
		url: "targetTransaction_q.php",
		type: "POST",
		data: "getType=true",
		success: function(data){ 
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			$xml.find('row').each(function(d){
				$('#ddlprod').append("<option value="+$(this).find('prodid').text()+">"+$(this).find('prodname').text()+"</option>");
			});
		}
	});
}

function doQueryByDate(pageval,sortval,orderval,start,end,ddlprod,userids) {
	$.ajax({
		url: "targetTransaction_p.php",
		type: "POST",
		data: 'page='+pageval+'&sort='+sortval+'&order='+orderval+'&start='+start+'&end='+end+'&ddlprod='+ddlprod+'&userid='+userids,//"{ page : '"+page+"', sort : '"+sort+"',order : '"+order+"' }",
		success: function(data){ 
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			var numrow = $xml.find('numrow:first').text();
			var numpage = $xml.find("numpage:first").text();
			var prevpage = $xml.find("PrevPage:first").text();
			var pagenow = $xml.find("pageNow:first").text();
			var strNewOrder = $xml.find("strNewOrder:first").text();
			var nextpage = parseInt(pagenow)+1;
			
			var html;
			$xml.find("row").each(function(d){
				html = "<tr>";
				html += "<td>"+ $(this).find("tranid").text() +"</td>";
				html += "<td>"+ $(this).find("createdate").text() +"</td>";
				html += "<td>"+ $(this).find("prodname").text() +"</td>";
				html += "<td>"+ $(this).find("price").text() +"</td>";
				html += "<td>"+ $(this).find("qty").text() +"</td>";
				html += "<td>"+ $(this).find("name").text() +"</td>";
				html += "</tr>";
				$("#tableuser").find("tbody").append(html);
			});
			$('#results').append("Total "+numrow+" Record : "+numpage+" Page :");
			if(prevpage!=0)
			{
				$('#results').append(" <a class='getpage' value="+prevpage+"><< Back</a>");
			}
			for(var i=1; i<=numpage; i++)
			{
				if(i != pagenow)
				{
					$('#results').append(" <a class='getpage' value="+i+">"+i+"</a> ");
				}
				else
				{
					$('#results').append(" <b> "+i+" </b>");
				}
			}
			if(pagenow!=numpage)
			{
				$('#results').append("<a class='getpage' value="+nextpage+">Next>></a> ");
			}
			$('#strOrderNow').val(strNewOrder);
		},
		error: function(data){
			alert("Error Please Try Again");
		}
	});
}

function doQuery(pageval,sortval,orderval,userid) {
	$.ajax({
		url: "targetTransaction_p.php",
		type: "POST",
		data: 'page='+pageval+'&sort='+sortval+'&order='+orderval+'&userid='+userid,//"{ page : '"+page+"', sort : '"+sort+"',order : '"+order+"' }",
		success: function(data){ 
			var xmldocs = $.parseXML(data);
			$xml = $( xmldocs );
			var numrow = $xml.find('numrow:first').text();
			var numpage = $xml.find("numpage:first").text();
			var prevpage = $xml.find("PrevPage:first").text();
			var pagenow = $xml.find("pageNow:first").text();
			var strNewOrder = $xml.find("strNewOrder:first").text();
			var nextpage = parseInt(pagenow)+1;
			
			var html;
			$xml.find("row").each(function(d){
				html = "<tr>";
				html += "<td>"+ $(this).find("tranid").text() +"</td>";
				html += "<td>"+ $(this).find("createdate").text() +"</td>";
				html += "<td>"+ $(this).find("prodname").text() +"</td>";
				html += "<td>"+ $(this).find("price").text() +"</td>";
				html += "<td>"+ $(this).find("qty").text() +"</td>";
				html += "<td>"+ $(this).find("name").text() +"</td>";
				html += "</tr>";
				$("#tableuser").find("tbody").append(html);
			});
			$('#results').append("Total "+numrow+" Record : "+numpage+" Page :");
			if(prevpage!=0)
			{
				$('#results').append(" <a class='getpage' value="+prevpage+"><< Back</a>");
			}
			for(var i=1; i<=numpage; i++)
			{
				if(i != pagenow)
				{
					$('#results').append(" <a class='getpage' value="+i+">"+i+"</a> ");
				}
				else
				{
					$('#results').append(" <b> "+i+" </b>");
				}
			}
			if(pagenow!=numpage)
			{
				$('#results').append("<a class='getpage' value="+nextpage+">Next>></a> ");
			}
			$('#strOrderNow').val(strNewOrder);
		},
		error: function(data){
			alert("Error Please Try Again");
		}
	});

}
