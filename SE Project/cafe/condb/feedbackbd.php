<?php
// Start the session
//ยังบ่เสร็จ
session_start();

require_once '../condb/database.php';



if (!isset($_SESSION['cus_username'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
    header('Location:../signin_cs.php');
}else{
    $cus_username = $_SESSION['cus_username'];
    $zone = $_POST['zone'];
    $province = $_POST['province'];
    $branchname = $_POST['branchname'];
    $feedback_date = $_POST['feedback_date'];
    
    }
    // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO feedback (fb_rating,fb_comment) 
            VALUES ()";

    // ส่งคำสั่ง SQL ไปยังฐานข้อมูล
    if(mysqli_query($conn, $sql)) {
        // หากสำเร็จให้เปลี่ยนเส้นทางไปที่หน้า index.php
        header("Location: ../index.php");
        exit();
    } else {
        // หากเกิดข้อผิดพลาดในการเพิ่มข้อมูล
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);
}
?>
