<?php
session_start();
include 'database.php';

$now = date('Y-m-d H:i:s');
$username = mysqli_real_escape_string($conn, $_POST['username']);
$queryID = mysqli_query($conn, "SELECT * FROM customer WHERE cus_username = '{$username}'");

$customerID = mysqli_fetch_assoc($queryID);
$query = mysqli_query($conn, "INSERT INTO order_main(ord_orderDate, ord_customerID, ord_total) 
VALUES ('{$now}','{$customerID['cus_customerID']}', '{$_POST['grand_total']}')") or die('query failed');

if ($query) {
    $last_id = mysqli_insert_id($conn);
    foreach ($_SESSION['cart'] as $product => $productQty) {
        $productID = $_POST['product'][$product]['id'];
        $product_name = $_POST['product'][$product]['name'];
        $price = $_POST['product'][$product]['price'];
        $hcb = $_POST['product'][$product]['hcb'] ?? '-';
        $type = $_POST['product'][$product]['type'];
        $quantity = $_POST['product'][$product]['quantity'];
        $total = $price * $productQty;

        // $_SESSION['cart'][$productID] = $_POST['product'][$productID]['quantity'];
        $query = mysqli_query($conn, "INSERT INTO order_detail(ord_orderID, ord_productID, ord_productName, ord_productType, ord_option, ord_price, ord_quantity, ord_totalPrice, ord_status) 
        VALUES ('{$last_id}','{$productID}', '{$product_name}', '{$type}', '{$hcb}', '{$price}', '{$productQty}', '{$total}', 'wait')") or die('query failed');

        $dess_query = mysqli_query($conn, "SELECT * FROM dessert_menu WHERE dess_menuName = '{$product_name}'");
        if (mysqli_num_rows($dess_query) >= 1) {
            $dessrt = mysqli_fetch_assoc($dess_query);
            $dessert_quantity = $dessrt['dess_quantity'] - $quantity;
            $dess_update = mysqli_query($conn, "UPDATE dessert_menu SET dess_quantity = $dessert_quantity WHERE dess_menuName = '{$product_name}'") or die('query failed');
        }
        $fruit_query = mysqli_query($conn, "SELECT * FROM fruit_menu WHERE fruit_menuName = '{$product_name}'");
        if (mysqli_num_rows($fruit_query) >= 1) {
            $fruit = mysqli_fetch_assoc($fruit_query);
            $fruit_quantity = $fruit['fruit_quantity'] - $quantity;
            $fruit_updatr = mysqli_query($conn, "UPDATE fruit_menu SET fruit_quantity = $fruit_quantity WHERE fruit_menuName = '{$product_name}'") or die('query failed');
        }
        $point_query = mysqli_query($conn, "SELECT * FROM points WHERE p_customerName = '{$username}'") or die('query failed');
        $point = mysqli_fetch_assoc($point_query);
        $point_up = $_POST['grand_total'] / 2;
        $point_total = $point['p_pointTotal'] + $point_up;
        $point_update = mysqli_query($conn, "UPDATE points SET p_pointTotal = '{$point_total}' WHERE p_customerName = '{$username}'");
    }
    unset($_SESSION['cart']);
    $_SESSION['message'] = 'Checkout Order successfully!!!';
    header('location: ../Cashierphp/checkout-success.php');
} else {
    $_SESSION['message'] = 'Checkout not complete!!!';
    header('location: ../Cashierphp/checkout-success.php');
}
