<?php
include("../../../connection.php");
$prodid = (isset($_GET['id']) ? $_GET['id'] : "");
$str="";
$uid="";
$sql = "SELECT td.prodid as id, transdqty as qty, transdprice as price, d.prodname as name 
		FROM ttransdetail td	
		inner join tprod d on d.prodid = td.prodid
		where tranid = '$prodid'
UNION ALL
SELECT 'Total',(select SUM(transdqty) from ttransdetail where tranid = '$prodid')  as TOT,(select SUM(transdprice) from ttransdetail where tranid = '$prodid')  as TOT,''";
$result = mysql_query($sql);


// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Construction');
$pdf->SetTitle('Receipt');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('freeserif', '', 10);
// add a page
$pdf->AddPage();

// create some HTML content
$sub ="";
while($uid=mysql_fetch_array($result))
{
	$sub .= '<tr>';
	$sub .= '<td align="center">'.$uid["id"].'</td>';
	$sub .= '<td align="center">'.$uid["name"].'</td>';
	$sub .= '<td align="center">'.$uid["qty"].'</td>';
	$sub .= '<td align="center">'.$uid["price"].'</td>';
	$sub .= '</tr>';
}


$html = '<h2>Receipt</h2>
<table class="table table-bordered table-hover table-striped" id="tableuser">
<thead>
	<tr>
		<th align="center">Product ID</th>
		<th align="center">Product Name</th>
		<th align="center">Quantity</th>
		<th align="center">Product Price</th>
	</tr>
</thead>
<tbody >
	'. $sub .'
</tbody>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('test.pdf', 'I');
