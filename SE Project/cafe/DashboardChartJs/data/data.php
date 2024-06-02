<?php
    header('Content-Type: application/json');
    require '../../condb/database.php';

    // รับค่าปีที่เลือกจากผู้ใช้ผ่านตัวแปร POST
    $selectedYear = $_POST['selectedYear'];
    //$selectedYear = 2024; // for test
    // ตรวจสอบว่ามีการเลือกปีหรือไม่
    if (!empty($selectedYear)) {
        // คิวรีข้อมูลจากฐานข้อมูลโดยใช้ปีที่เลือกเป็นเงื่อนไข
        $ord_totalPerํYear = mysqli_query($conn, "SELECT * FROM order_main WHERE YEAR(ord_orderDate) = $selectedYear");

        // ตรวจสอบว่ามีข้อมูลที่ได้จากการคิวรีหรือไม่
        if ($ord_totalPerํYear) {
            // นำข้อมูลที่ได้มาเก็บไว้ในอาร์เรย์
            $data = array();
            foreach ($ord_totalPerํYear as $row1) {
                $data[] = $row1;
            }

            // ปิดการเชื่อมต่อกับฐานข้อมูล
            mysqli_close($conn);

            // ส่งข้อมูลกลับเป็น JSON
            echo json_encode($data);
        } else {
            // หากไม่มีข้อมูลจากการคิวรี ส่งข้อมูลว่างกลับ
            echo json_encode(array());
        }
    } else {
        // หากไม่มีการเลือกปี ส่งข้อมูลว่างกลับ
        echo json_encode(array());
    }
?>
