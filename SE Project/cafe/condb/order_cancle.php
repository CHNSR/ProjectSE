<?php
session_start();
include 'database.php';

$ID = $_GET['id'];
echo $ID.'cancle';

$update = mysqli_query($conn, "UPDATE order_detail SET ord_status = 'Cancle' WHERE ord_detailID = '{$ID}'");
if ($update) {
    $_SESSION['message'] = 'Order cancle successfully';
}
header('location: ../Baristaphp/index.php');