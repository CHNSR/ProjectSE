<?php
// Start the session
session_start();

require_once 'database.php';

if (!isset($_SESSION['cus_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
    header('Location:../signin_cs.php');
} else {
    $cus_username = $_SESSION['cus_login'];
    $f_name = $_POST['firstName'];
    $l_name = $_POST['lastName'];
    $birthday = $_POST['birthdayDate'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone_number = $_POST['phoneNumber'];
}
$sql = "UPDATE customer SET cus_firstname = '{$f_name}', cus_lastname = '{$l_name}', cus_birthday = '{$birthday}', cus_gender = '{$gender}', cus_email = '{$email}', cus_phoneNumber = '{$phone_number}' WHERE cus_username = '$cus_username'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['message'] = 'Edit Profile successfully';
    header('location: ../Userphp/Information.php');
} else {
    $_SESSION['message'] = 'Edit Profile Error';
    header('location: ../Userphp/Information.php');
}
