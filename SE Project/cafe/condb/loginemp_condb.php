<?php
session_start();
include "database.php";

// เมื่อกดปุ่ม Login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าที่ส่งมาจากฟอร์ม
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // สร้างคำสั่ง SQL เพื่อตรวจสอบข้อมูลในฐานข้อมูล
    $sql = "SELECT * FROM employee WHERE emp_username='$username' AND emp_password='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($result->num_rows == 1){
        if ($row['emp_employeelevel'] == 'A') {
            $_SESSION['cashier_login'] = $row['emp_employeeID'];
            header("Location: ../Cashierphp/index.php");
        }
        if ($row['emp_employeelevel'] == 'B') {
            $_SESSION['barista_login'] = $row['emp_employeeID'];
            header("Location: ../Baristaphp/index.php");
        }
        if ($row['emp_employeelevel'] == 'C') {
            $_SESSION['manager_login'] = $row['emp_employeeID'];
            header("Location: ../Managerphp/index.php");
        }
    }else {
        $_SESSION['duplicate_username'] = true;
        header('location: ../signin_ep.php');
        mysqli_close($conn);
        exit();
    }
}
?>