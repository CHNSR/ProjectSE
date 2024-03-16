<?php
session_start();
include 'database.php';

$row = $_POST['row'];
$username = $_POST['username'] ?? '';
$name = $_POST['name'];
$rdm_query = mysqli_query($conn, "SELECT * FROM redeem WHERE rd_customerName = '$username' AND rd_expire > NOW() AND rd_status = 'redeemable'");

if ($row > 0) {
    $now = date('Y-m-d H:i:s');
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $queryID = mysqli_query($conn, "SELECT * FROM customer WHERE cus_username = '{$username}'");

    $customerID = mysqli_fetch_assoc($queryID);
    $query = mysqli_query($conn, "INSERT INTO order_main(ord_orderDate, ord_customerID, ord_total) 
    VALUES ('{$now}','{$customerID['cus_customerID']}', '0')") or die('query failed');

    if ($query) {
        $last_id = mysqli_insert_id($conn);
    }

    while ($rdm = mysqli_fetch_assoc($rdm_query)) {
        $ID = $rdm['rd_redeemID'];
        $name = $rdm['rd_redeemOrder'];
        $option = $rdm['rd_option'];
        $water_query = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_menuName = '{$name}' AND w_HotColdBlended = '{$option}'");
        $water_row = mysqli_num_rows($water_query);
        if ($water_row > 0) {
            $water = mysqli_fetch_assoc($water_query);
            $water_ID = $water['w_menuID'];
            $water_name = $water['w_menuName'];
            $water_option = $water['w_HotColdBlended'];
            $water_type = $water['w_waterType'];
            $query = mysqli_query($conn, "INSERT INTO order_detail(ord_orderID, ord_productID, ord_productName, ord_productType, ord_option, ord_price, ord_quantity, ord_totalPrice) 
            VALUES ('{$last_id}','{$water_ID}', '{$water_name}', '{$water_type}', '{$water_option}', '0', '1', '0')") or die('query failed');
            $query1 = mysqli_query($conn, "UPDATE redeem SET rd_status = 'redeemed' WHERE rd_redeemID = '{$ID}'");
        }
        $dess_query = mysqli_query($conn, "SELECT * FROM dessert_menu WHERE dess_menuName = '{$name}'");
        $dess_row = mysqli_num_rows($dess_query);
        if ($dess_row > 0) {
            $dessert = mysqli_fetch_assoc($dess_query);
            $dessert_ID = $dessert['dess_menuID'];
            $dessert_name = $dessert['dess_menuName'];
            $query = mysqli_query($conn, "INSERT INTO order_detail(ord_orderID, ord_productID, ord_productName, ord_productType, ord_option, ord_price, ord_quantity, ord_totalPrice) 
            VALUES ('{$last_id}','{$dessert_ID}', '{$dessert_name}', 'dessert', '-', '0', '1', '0')") or die('query failed');
            $query1 = mysqli_query($conn, "UPDATE redeem SET rd_status = 'redeemed' WHERE rd_redeemID = '{$ID}'");
        }
        $fruit_query = mysqli_query($conn, "SELECT * FROM fruit_menu WHERE fruit_menuName = '{$name}'");
        $fruit_row = mysqli_num_rows($fruit_query);
        if ($fruit_row > 0) {
            $fruit = mysqli_fetch_assoc($fruit_query);
            $fruit_ID = $fruit['fruit_menuID'];
            $fruit_name = $fruit['fruit_menuName'];
            $query = mysqli_query($conn, "INSERT INTO order_detail(ord_orderID, ord_productID, ord_productName, ord_productType, ord_option, ord_price, ord_quantity, ord_totalPrice) 
            VALUES ('{$last_id}','{$fruit_ID}', '{$fruit_name}', 'fruit', '-', '0', '1', '0')") or die('query failed');
            $query1 = mysqli_query($conn, "UPDATE redeem SET rd_status = 'redeemed' WHERE rd_redeemID = '{$ID}'");
        }
    }
    $_SESSION['message'] = 'Redeem Order successfully!!!';
    header('location: ../Cashierphp/redeem.php');
} else {
    $_SESSION['message'] = 'Redeem not complete!!!';
    header('location: ../Cashierphp/redeem.php');
}
