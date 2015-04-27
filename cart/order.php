<?php
session_start();
include("../connection.php");
$userid = $_SESSION['userid'];
$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$itemCountCollect = isset($_SESSION['isCollect']) ? count($_SESSION['isCollect']) : 0;
$_SESSION['formid'] = sha1('itoffside.com' . microtime());
if (isset($_SESSION['qty'])) {
	$meQty = 0;
	foreach ($_SESSION['qty'] as $meItem) {
		$meQty = $meQty + (int)$meItem;
	}
} else {
	$meQty = 0;
}
if (isset($_SESSION['qtyCollect'])) {
    $meQtyCollect = 0;
    foreach ($_SESSION['qtyCollect'] as $meItemCollect) {
        $meQtyCollect = $meQtyCollect + (int)$meItemCollect;
    }
} else {
    $meQtyCollect = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0) {
	$itemIds = "";
	foreach ($_SESSION['cart'] as $itemId) {
		$itemIds = $itemIds . $itemId . ",";
	}
	$inputItems = rtrim($itemIds, ",");
    $inputItems = ltrim($inputItems, ",");
	$meSql = "SELECT * FROM tprod WHERE prodid in ({$inputItems})";
	$meQuery = mysql_query($meSql);
    $meCount = 0;
    if($meQuery) {
        $meCount = mysql_num_rows($meQuery);
    }   
	
} else {
	$meCount = 0;
}
if (isset($_SESSION['isCollect']) and $itemCountCollect > 0) {
    $itemCollectIds = "";
    foreach ($_SESSION['isCollect'] as $itemIdCollect) {
        $itemCollectIds = $itemCollectIds . $itemIdCollect . ",";
    }
    $inputItemsCollect = rtrim($itemCollectIds, ",");
    $inputItemsCollect = ltrim($inputItemsCollect, ",");
    $meSqlCollect = "SELECT * FROM tpromo WHERE promoid in ({$inputItemsCollect})";
    $meQueryCollect = mysql_query($meSqlCollect);
    $meCountCollect = 0;
    if($meQueryCollect) {
        $meCountCollect = mysql_num_rows($meQueryCollect);
    }   
    
} else {
    $meCountCollect = 0;
}
if($_SESSION['role'] == "customer") { ?>
    <script>
        var role = "customer";
    </script>    
<?php }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 
        <!-- Bootstrap -->
        <link href="/construct/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script language="JavaScript" type="text/javascript" src="/construct/js/jquery-1.11.2.min.js"></script>
         <script language="JavaScript" type="text/javascript" src="/construct/cart/order.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
<script type="text/javascript">
    var userid = "<?php echo $userid ?>";
	function updateSubmit(aform){
		if(document.formupdate.order_fullname.value == ""){
			alert('โปรดใส่ชื่อนามสกุลด้วย!');
			document.formupdate.order_fullname.focus();
			return false;
		}
			if(document.formupdate.order_address.value == ""){
			alert('โปรดใส่ที่อยู่ด้วย!');
			document.formupdate.order_address.focus();
			return false;
		}
			if(document.formupdate.order_phone.value == ""){
			alert('โปรดใส่เบอร์โทรด้วย!');
			document.formupdate.order_phone.focus();
			return false;
		}
        //prompt("",$(aform).serialize());
        $.ajax({
        url: "updateorder.php",
        type: "POST",
        data: $(aform).serialize(),
        success: function(data){ 
            var xmldocs = $.parseXML(data);
            $xml = $( xmldocs );
            var result = $xml.find( "result" ).text();
            var reason = $xml.find( "reason" ).text();
            //alert(data);
            alert(reason);
            window.close();
        }
    });
		return false;
	}
</script>
    </head>
    <body>
        <div class="container">
 
            <!-- Static navbar -->

			<h3>รายการสั่งซื้อ</h3>
            <!-- Main component for a primary marketing message or call to action -->
            <?php
            if ($action == 'removed')
            {
                echo "<div class=\"alert alert-warning\">Delete product success.</div>";
            }
 
            if ($meCount == 0 && $meCountCollect == 0)
            {
                echo "<div class=\"alert alert-warning\">No product in your class.</div>";
            } else
            {
                ?>
 
                <form action="updateorder.php" method="post" name="formupdate" role="form" id="formupdate" onsubmit="JavaScript:return updateSubmit(this);">
                	<div class="form-group">
    					<label for="exampleInputEmail1">Name-Surname</label>
    					<input type="text" class="form-control" id="order_fullname" placeholder="Enter your name-surname." style="width: 300px;" name="order_fullname">
  					</div>
                	<div class="form-group">
    					<label for="exampleInputAddress">Address</label>
    					<textarea class="form-control" rows="3" style="width: 500px;" name="order_address" id="order_address"></textarea>
  					</div>
                	<div class="form-group">
    					<label for="exampleInputPhone">Mobile No.</label>
    					<input type="text" class="form-control" id="order_phone" placeholder="Enter your mobile number." style="width: 300px;" name="order_phone">
  					</div>
                    <div class="checkbox" id="checkdefault">
                        <label><input type="checkbox" id="default" name="default" checked>Use Default Data</label>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Measure</th>
                                <th>QTY</th>
                                <th>Price</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_price = 0;
                            $num = 0;
                            if(isset($meQuery)) {
                                while ($meResult = mysql_fetch_assoc($meQuery))
                                {
                                    $key = array_search($meResult['prodid'], $_SESSION['cart']);
                                    $total_price = $total_price + ($meResult['price'] * $_SESSION['qty'][$key]);
                                    ?>
                                    <tr>
                                        <td><?php echo $meResult['prodid']; ?></td>
                                        <td><?php echo $meResult['prodname']; ?></td>
                                        <td><?php echo $meResult['measure']; ?></td>
                                        <td>
                                        	<?php echo $_SESSION['qty'][$key]; ?>
                                        	<input type="hidden" name="qty[]" value="<?php echo $_SESSION['qty'][$key]; ?>" />
                                        	<input type="hidden" name="product_id[]" value="<?php echo $meResult['prodid']; ?>" />
                                        	<input  type="hidden" name="product_price[]" value="<?php echo $meResult['price']; ?>" />
                                        </td>
                                        <td><?php echo number_format($meResult['price'], 2); ?></td>
                                        <td><?php echo number_format(($meResult['price'] * $_SESSION['qty'][$key]), 2); ?></td>
                                    </tr>
                                    <?php
    								$num++;
    							}
                            }
                            if(isset($meQueryCollect)) {
                                while ($meCollectResult = mysql_fetch_assoc($meQueryCollect))
                                 {
                                $key = array_search($meCollectResult['promoid'], $_SESSION['isCollect']);
                                $total_price = $total_price + ($meCollectResult['promoprice'] * $_SESSION['qtyCollect'][$key]);
                                ?>
                                <tr>
                                    <td><?php echo $meCollectResult['promoid']; ?></td>
                                    <td><?php echo $meCollectResult['promoname']; ?></td>
                                    <td><?php echo 'set' ?></td>
                                    <td>
                                        <?php echo $_SESSION['qtyCollect'][$key]; ?>
                                        <input type="hidden" name="qtyCollect[]" value="<?php echo $_SESSION['qtyCollect'][$key]; ?>" />
                                        <input type="hidden" name="productCollect_id[]" value="<?php echo $meCollectResult['promoid']; ?>" />
                                        <input  type="hidden" name="productCollect_price[]" value="<?php echo $meCollectResult['promoprice']; ?>" />
                                    </td>
                                    <td><?php echo number_format($meCollectResult['promoprice'], 2); ?></td>
                                    <td><?php echo number_format(($meCollectResult['promoprice'] * $_SESSION['qtyCollect'][$key]), 2); ?></td>
                                </tr>
                                <?php
                                $num++;
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <input  type="hidden" name="totalprice" value="<?php echo $total_price; ?>" />
                                    <h4>Total Amount <?php echo number_format($total_price, 2); ?> Bath</h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                	<input type="hidden" name="formid" value="<?php echo $_SESSION['formid']; ?>"/>
                                	<a href="cart.php" type="button" class="btn btn-danger btn-lg">Back to cart</a>
                                    <button id="ordering" type="submit" class="btn btn-primary btn-lg">Ordering.</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <?php
				}
            ?>
 
        </div> <!-- /container -->
 
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
<?php
mysql_close();
?>
