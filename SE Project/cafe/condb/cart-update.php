<?php
session_start();
include 'database.php';

foreach($_SESSION['cart'] as $productID => $productQty ){
    $_SESSION['cart'][$productID] = $_POST['product'][$productID]['quantity'];
}

$_SESSION['message'] = 'Cart update successfully';
header('location: ../Cashierphp/cart.php');