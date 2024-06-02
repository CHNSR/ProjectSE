<?php
header('Content-Type: application/json');
require '../../condb/database.php';

// รับค่าวันที่เริ่มต้นและสิ้นสุดจากผู้ใช้ผ่านตัวแปร POST
$start_date = $_POST['startDate'];
$end_date = $_POST['endDate'];
/*
// for test
$start_date = "2024-01-01";
$end_date = "2024-12-31";
*/


// ตรวจสอบว่ามีการเลือกวันที่เริ่มต้นและสิ้นสุดหรือไม่
if (!empty($start_date) && !empty($end_date)) {
    // คิวรีข้อมูลจากฐานข้อมูลโดยใช้วันที่เริ่มต้นและสิ้นสุดเป็นเงื่อนไข
    
    $sql2 = "SELECT order_detail.*, order_main.ord_orderDate 
        FROM order_detail
        INNER JOIN order_main
        ON order_detail.ord_orderID = order_main.ord_orderID 
        WHERE order_main.ord_orderDate BETWEEN '$start_date' AND '$end_date' 
        AND order_detail.ord_ProductType = 'dessert'";
    $result = mysqli_query($conn, $sql2);
    

    // ตรวจสอบว่ามีข้อมูลที่ได้จากการคิวรีหรือไม่
    if ($result) {
        // นำข้อมูลที่ได้มาเก็บไว้ในอาร์เรย์
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
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
    // หากไม่มีการเลือกวันที่เริ่มต้นและสิ้นสุด ส่งข้อมูลว่างกลับ
    echo json_encode(array());
}
?>
