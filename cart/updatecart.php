<?php
 
session_start();
$itemId = isset($_GET['itemId']) ? $_GET['itemId'] : "";
$isCollect = isset($_GET['isCollect']) ? $_GET['isCollect'] : "";
if ($_POST)
{
    for ($i = 0; $i < count($_POST['qty']); $i++)
    {
        $key = $_POST['arr_key_' . $i];
        $_SESSION['qty'][$key] = $_POST['qty'][$i];
        header('location:cart.php');
    }
    for ($i = 0; $i < count($_POST['qtyCollect']); $i++)
    {
        $keyCollect = $_POST['arr_keyCollect_' . $i];
        $_SESSION['qtyCollect'][$keyCollect] = $_POST['qtyCollect'][$i];
        header('location:cart.php');
    }
} else
{
    if (!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] = array();
        $_SESSION['qty'][] = array();
    }
    if (!isset($_SESSION['isCollect']))
    {
        echo 'not session iscollect';
        $_SESSION['isCollect'] = array();
        $_SESSION['qtyCollect'][] = array();
    }
 
    if (in_array($itemId, $_SESSION['cart']))
    {
        if($isCollect==0) {
            $key = array_search($itemId, $_SESSION['cart']);
            $_SESSION['qty'][$key] = $_SESSION['qty'][$key] + 1;
        }
        header('location:/construct/gallery/gallery.php?a=exists');
    } else
    {   
        if($isCollect==0) {
            array_push($_SESSION['cart'], $itemId);
            $key = array_search($itemId, $_SESSION['cart']);
            $_SESSION['qty'][$key] = 1;
        }
        header('location:/construct/gallery/gallery.php?a=add');
    }
    if (in_array($itemId, $_SESSION['isCollect']))
    {
        if($isCollect==1) {
            echo 'collect = 1 and number item';
            $keyCollect = array_search($itemId, $_SESSION['isCollect']);
            $_SESSION['qtyCollect'][$keyCollect] = $_SESSION['qtyCollect'][$keyCollect] + 1;
            header('location:/construct/gallery/gallery.php?a=exists');
        }
    }
    else {
        if($isCollect==1) {
             echo 'add item to iscollect';
            array_push($_SESSION['isCollect'], $itemId);
            $keyCollect = array_search($itemId, $_SESSION['isCollect']);
            $_SESSION['qtyCollect'][$keyCollect] = 1;
            header('location:/construct/gallery/gallery.php?a=add');
        }
    }
}
?>