<?php
session_start();
include 'database.php';

$ID = $_GET['id'];

$update = mysqli_query($conn, "UPDATE order_detail SET ord_status = 'Success' WHERE ord_detailID = '{$ID}'");
if ($update) {
    $_SESSION['message'] = 'Order update successfully';
}
header('location: ../Baristaphp/index.php');