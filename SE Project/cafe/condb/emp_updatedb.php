<?php
// Start the session
session_start();

require_once 'database.php';

if (!isset($_SESSION['manager_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
    header('Location:../signin_cs.php');
} else {
    $empID = $_POST['empID'];
    $emp_username = $_POST['emp_username'];
    $emp_birthday = $_POST['emp_birthday'];
    $emp_name = $_POST['emp_name'];
    $emp_sername = $_POST['emp_sername'];
    $emp_ID = $_POST['emp_ID'];
    $emp_address = $_POST['emp_address'];
    $emp_tell = $_POST['emp_tell'];
    $emp_email = $_POST['emp_email'];
    $emp_branchID = $_POST['emp_branchID'];
}

$sql = "UPDATE employee SET emp_username = '{$emp_username}', emp_birthday = '{$emp_birthday}', emp_name = '{$emp_name}', emp_sername = '{$emp_sername}', emp_ID = '{$emp_ID}', emp_address = '{$emp_address}', emp_tell = '{$emp_tell}', emp_email = '{$emp_email}', emp_branchID = '{$emp_branchID}' WHERE emp_employeeID = '$empID'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['message'] = 'Edit Profile successfully';
    header('location: ../DashboardChartJS/02emp/employee.php');
} else {
    $_SESSION['message'] = 'Edit Profile Error';
    header('location: ../DashboardChartJS/02emp/employee.php');
}
?>
