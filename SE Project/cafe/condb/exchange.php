<?php
session_start();
include 'database.php';

$cus_username = $_SESSION['cus_login'];
$product_name = $_POST['product_name'];
$product_option = $_POST['option'] ?? '-';
$point_use = $_POST['point_use'];
$point_have = $_POST['point_have'];
$point_result = $point_have - $point_use;

$dess_query = mysqli_query($conn, "SELECT * FROM dessert_menu WHERE dess_menuName = '$product_name'");
$dess_row = mysqli_num_rows($dess_query);
if ($dess_row >= 1) {
    $dessert = mysqli_fetch_assoc($dess_query);
    $update_quantity = $dessert['dess_quantity'] - 1;
}

$fruit_query = mysqli_query($conn, "SELECT * FROM fruit_menu WHERE fruit_menuName = '$product_name'");
$fruit_row = mysqli_num_rows($fruit_query);
if ($fruit_row >= 1) {
    $fruit = mysqli_fetch_assoc($fruit_query);
    $update_quantity = $fruit['fruit_quantity'] - 1;
}

if ($dess_row >= 1) {
    $sql1 = "UPDATE dessert_menu SET dess_quantity = $update_quantity WHERE dess_menuName = '$product_name'";
    $result1 = mysqli_query($conn, $sql1);
} elseif ($fruit_row >= 1) {
    $sql2 = "UPDATE fruit_menu SET fruit_quantity = $update_quantity WHERE fruit_menuName = '$product_name'";
    $result2 = mysqli_query($conn, $sql2);
}
$sql3 = "UPDATE points SET p_pointTotal = {$point_result} WHERE p_customerName = '$cus_username'";
$result3 = mysqli_query($conn, $sql3);

$sql4 = "INSERT INTO redeem (rd_customerName, rd_redeemOrder, rd_option, rd_expire, rd_status) VALUES ('$cus_username', '$product_name', '$product_option', DATE_ADD(NOW(), INTERVAL 7 DAY), 'redeemable')";
$result4 = mysqli_query($conn, $sql4);

if ($result4) {
    $_SESSION['message'] = 'Redeem Porduct successfully';
    header('location: ../Userphp/Userinter.php');
} else {
    $_SESSION['message'] = 'Redeem Product Error';
    header('location: ../Userphp/Userinter.php');
}
