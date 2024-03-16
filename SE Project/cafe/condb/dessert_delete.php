<?php
session_start();
include 'database.php';
if (!empty($_GET['id'])) {
    $query_product = mysqli_query($conn, "SELECT * FROM dessert_menu WHERE dess_menuID = '{$_GET['id']}'");
    $result = mysqli_fetch_assoc($query_product);
    @unlink('../image/menu/Dessert/' . $result['dess_picture']);

    $query = mysqli_query($conn, "DELETE FROM dessert_menu WHERE dess_menuID  = '{$_GET['id']}'") or die('query failed');
    mysqli_close($conn);

    if ($query) {
        $_SESSION['message'] = 'Product Deleted successfully';
        header('location: ../Managerphp/index.php');
    }else{
        $_SESSION['message'] = 'Product could not be deleted';
        header('location: ../Managerphp/index.php');
    }
}
