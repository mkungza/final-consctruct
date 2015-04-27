$( document ).ready(function() {
	//initial
	$('.fa.fa-credit-card').parent().parent().attr("class","active");
	
	var pageval = 1;
	var sortval = 'tranid';
	var orderval = 'desc';
	var userid = $('#userid').val();
	//alert(userid);
	setTimeout(function(){doQuery(pageval,sortval,orderval,userid),1000});
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
	
	$(document).on('click','.check',function(){
		var role = $('#user').val();
		
		if(role != "employee")
		{
			var id = $(this).attr('getid')
			window.location = '/construct/admin/deleteTransaction/deleteTransaction.php?id='+id;
		}
		else
		{
			alert("You Don't Have Permission");
		}
	});
});
function reset(){
	$("#tableuser").find("tbody").html('');
	$('#results').html('');
}

function doQuery(pageval,sortval,orderval,userid) {
	$.ajax({
		url: "transaction_p.php",
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
				html += "<td>"+ $(this).find("amount").text() +"</td>";
				html += "<td>"+ $(this).find("name").text() +"</td>";
				html += "<td>"+ $(this).find("transname").text() +"</td>";
				html += "<td>"+ $(this).find("transaddr").text() +"</td>";
				html += "<td>"+ $(this).find("transtel").text() +"</td>";
				html += "<td>"+ $(this).find("status").text() +"</td>";
				if($(this).find("statusid").text()=="2"){
					html += "<td><a target='_blank' href='/construct/admin/printTran/printTran/printTran.php?id="+$(this).find("tranid").text()+"'>Print</a> | <a href='/construct/admin/transdetail/transdetail.php?id="+$(this).find("tranid").text()+"'>Detail</a> | <label style='font-weight:normal;cursor:pointer;color:#337ab7' class='check' getid="+$(this).find("tranid").text()+">Delete</label></td>";
				}
				else{
					html += "<td><a target='_blank' href='/construct/admin/printTran/printTran/printTran.php?id="+$(this).find("tranid").text()+"'>Print</a> | <a href='/construct/admin/editTrans/editTrans.php?id="+$(this).find("tranid").text()+"'>Edit</a> | <a href='/construct/admin/transdetail/transdetail.php?id="+$(this).find("tranid").text()+"'>Detail</a> | <label style='font-weight:normal;cursor:pointer;color:#337ab7' class='check' getid="+$(this).find("tranid").text()+">Delete</label></td>";
				}
				
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
