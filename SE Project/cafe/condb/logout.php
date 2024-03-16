<?php
session_start();
unset($_SESSION['cus_login']);
unset($_SESSION['cashier_login']);
unset($_SESSION['barista_login']);
unset($_SESSION['manager_login']);
header('Location:../index.php');
?>
