<?php
session_start();
include_once("database.php");

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['name'];
    $lastname = $_POST['surname'];
    $phone_number = $_POST['phone_num'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];

    $check_username_sql = "SELECT * FROM customer WHERE cus_username = '$username'";
    $result = mysqli_query($conn, $check_username_sql);

    if (mysqli_num_rows($result) > 0) {
        // If duplicate username is found, set session variable and redirect
        $_SESSION['duplicate_username'] = true;
        header("Location: ../RegisCus.php");
        mysqli_close($conn);
        exit();
    }
    $check_email_sql = "SELECT * FROM customer WHERE cus_email = '$email'";
    $result1 = mysqli_query($conn, $check_email_sql);
    if (mysqli_num_rows($result1) > 0) {
        // If duplicate username is found, set session variable and redirect
        $_SESSION['duplicate_email'] = true;
        header("Location: ../RegisCus.php");
        mysqli_close($conn);
        exit();
    }

    // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO customer (cus_username, cus_password, cus_firstname, cus_lastname, cus_phoneNumber, cus_gender, cus_birthday, cus_email) 
            VALUES ('$username', '$password', '$firstname', '$lastname', '$phone_number', '$gender', '$birthdate', '$email')";
    $sql1 = "INSERT INTO points (p_customerName) VALUES ('$username')";
    // ส่งคำสั่ง SQL ไปยังฐานข้อมูล
    if (mysqli_query($conn, $sql)) {
        if (mysqli_query($conn, $sql1)) {
            // หากสำเร็จให้เปลี่ยนเส้นทางไปที่หน้า index.php
            header("Location: ../index.php");
            exit();
        }
    } else {
        // หากเกิดข้อผิดพลาดในการเพิ่มข้อมูล
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);
}
