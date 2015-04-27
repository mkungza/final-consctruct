<?php
session_start();
include("../connection.php");

$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$itemCollectCount = isset($_SESSION['isCollect']) ? count($_SESSION['isCollect']) : 0;
if (isset($_SESSION['qty']))
{
    $meQty = 0;
    foreach ($_SESSION['qty'] as $meItem)
    {
        $meQty = $meQty + (int)$meItem;
    }
} else
{
    $meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0)
{
    $itemIds = "";
    foreach ($_SESSION['cart'] as $itemId)
    {
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
    
} else
{
    $meCount = 0;
}
if (isset($_SESSION['qtyCollect']))
{
    $meCollectQty = 0;
    foreach ($_SESSION['qtyCollect'] as $meCollectItem)
    {
        $meCollectQty = $meCollectQty;
    }
} else
{
    $meCollectQty = 0;
}
if (isset($_SESSION['isCollect']) and $itemCollectCount > 0)
{
    $itemCollectIds = "";
    foreach ($_SESSION['isCollect'] as $itemCollectId)
    {
        $itemCollectIds = $itemCollectIds . $itemCollectId . ",";
    }
    $inputCollectItems = rtrim($itemCollectIds, ",");
    $inputCollectItems = ltrim($inputCollectItems, ",");
    $meCollectSql = "SELECT * FROM tpromo WHERE promoid in ({$inputCollectItems})";
    $meCollectQuery = mysql_query($meCollectSql);

    $meCollectCount = 0;
    if($meCollectQuery) {
        $meCollectCount = mysql_num_rows($meCollectQuery);
    }
    
} else
{
    $meCollectCount = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>sometime.com shopping cart</title>

        <!-- Bootstrap -->
        <link href="/construct/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div class="container">

			<h3>MY CART</h3>
            <!-- Main component for a primary marketing message or call to action -->
            <?php
            if ($action == 'removed')
            {
                echo "<div class=\"alert alert-warning\">Delete Successed</div>";
            }

            if ($meCount == 0 && $meCollectCount ==0 )
            {
                echo "<div class=\"alert alert-warning\">No item in your cart.</div>";
            } else
            {
                ?>
                <form action="updatecart.php" method="post" name="fromupdate">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Measure</th>
                                <th>QTY</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>&nbsp;</th>
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
                                        <td><?php echo '<img width="100px" height="80px" src="data:image/jpeg;base64,'.base64_encode( $meResult['prodimg'] ).'" border="0">'?></td>
                                        <td><?php echo $meResult['prodid']; ?></td>
                                        <td><?php echo $meResult['prodname']; ?></td>
                                        <td><?php echo $meResult['measure']; ?></td>
                                        <td>
                                            <input type="text" name="qty[<?php echo $num; ?>]" value="<?php echo $_SESSION['qty'][$key]; ?>" class="form-control" style="width: 60px;text-align: center;">
                                            <input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $key; ?>">
                                        </td>
                                        <td><?php echo number_format($meResult['price'],2); ?></td>
                                        <td><?php echo number_format(($meResult['price'] * $_SESSION['qty'][$key]),2); ?></td>
                                        <td>
                                            <a class="btn btn-danger btn-lg" href="/construct/cart/removecart.php?itemId=<?php echo $meResult['prodid']; ?>" role="button">
                                                <span class="glyphicon glyphicon-trash"></span>
                                                remove</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $num++;
                                }
                           }
                            $num = 0;
                            if(isset($meCollectQuery)) {
                                while ($meCollectResult = mysql_fetch_assoc($meCollectQuery))
                                {

                                    $key = array_search($meCollectResult['promoid'], $_SESSION['isCollect']);
                                    $total_price = $total_price + ($meCollectResult['promoprice'] * $_SESSION['qtyCollect'][$key]);
                                    ?>
                                    <tr>
                                        <td><?php echo '<img width="100px" height="80px" src="data:image/jpeg;base64,'.base64_encode( $meCollectResult['promoimage'] ).'" border="0">'?></td>
                                        <td><?php echo $meCollectResult['promoid']; ?></td>
                                        <td><?php echo $meCollectResult['promoname']; ?></td>
                                        <td>
                                        <?php 
                                            $itemsql = "SELECT * from tipromo where promoid='{$meCollectResult['promoid']}'";
                                            $itemQuery = mysql_query($itemsql);
                                            while ($itemResult = mysql_fetch_assoc($itemQuery)) {
                                                echo $itemResult['prodname'].' (qty :'.$itemResult['qty'].')<br/>';
                                            }
                                        ?>
                                        </td>
                                        <td>
                                            <input type="text" name="qtyCollect[<?php echo $num; ?>]" value="<?php echo $_SESSION['qtyCollect'][$key]; ?>" class="form-control" style="width: 60px;text-align: center;">
                                            <input type="hidden" name="arr_keyCollect_<?php echo $num; ?>" value="<?php echo $key; ?>">
                                        </td>
                                        <td><?php echo number_format($meCollectResult['promoprice'],2); ?></td>
                                        <td><?php echo number_format(($meCollectResult['promoprice'] * $_SESSION['qtyCollect'][$key]),2); ?></td>
                                        <td>
                                            <a class="btn btn-danger btn-lg" href="/construct/cart/removecart.php?itemId=<?php echo $meCollectResult['promoid']; ?>&isCollect=1" role="button">
                                                <span class="glyphicon glyphicon-trash"></span>
                                                remove</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $num++;
                                }
                            }
                            
                              ?>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <h4>Total amount <?php echo number_format($total_price,2); ?> Bath</h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <button type="submit" class="btn btn-info btn-lg">Update Cart</button>
                                    <a id="ordernow" href="order.php" type="button" class="btn btn-primary btn-lg">Order Now</a>
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
        <script src="/construct/js/jquery-1.11.2.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/construct/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
<?php
mysql_close();
?>
<?php $session = isset($_SESSION['userid']) ? 'true' : 'false' ?>"
<script>

    var session = "<?php echo $session; ?>";
    $("#ordernow").click(function() {
         if(session=="false") {
            alert("Please Login.");
            return false;
         }
    });
</script>
