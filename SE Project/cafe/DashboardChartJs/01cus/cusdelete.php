<?php
// เชื่อมต่อกับฐานข้อมูล
include '../../condb/database.php';

// ตรวจสอบว่ามีการส่งค่า ID ของลูกค้ามาหรือไม่
if (isset($_GET['delete_id'])) {
    $customer_id = $_GET['delete_id'];

    // คำสั่ง SQL สำหรับลบข้อมูลลูกค้า
    $delete_query = "DELETE FROM employee WHERE emp_employeeID = $customer_id";

    // ทำการลบข้อมูล
    if (mysqli_query($conn, $delete_query)) {
        // หากลบข้อมูลสำเร็จ
        $result =  "ลบข้อมูลลูกค้าเรียบร้อยแล้ว";
    } else {
        // หากเกิดข้อผิดพลาดในการลบข้อมูล
        $result = "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
    }
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
</head>
<body>
    <center>
    <?php echo $result ?>
    <div id="countdown">5</div> <!-- แสดงตัวเลขนับถอยหลังที่นี่ -->
    </center>
    <script>
        // ตัวแปรเก็บค่าเวลาที่นับถอยหลัง
        var seconds = 5;

        // ฟังก์ชันนับถอยหลังและแสดงผลบนหน้าเว็บ
        function countdown() {
            // ลดค่าของตัวแปร seconds ลงทีละ 1
            seconds--;

            // แสดงค่าตัวแปร seconds บนหน้าเว็บ
            document.getElementById('countdown').innerText = seconds;

            // เมื่อเวลานับถอยหลังเท่ากับ 0 ให้รีเฟรชหน้าเว็บ
            if (seconds == 0) {
                window.location.href = 'employee.php';
            }
        }

        // เรียกใช้ฟังก์ชัน countdown() ทุกๆ 1 วินาที
        setInterval(countdown, 1000);
    </script>
</body>
</html>

