<?php
session_start();
include 'database.php';

if(!empty($_GET['id']));{
    unset($_SESSION['cart'][$_GET['id']]);
    $_SESSION['message'] = 'Cart delete successfully';
}
header('location: ../Cashierphp/cart.php');