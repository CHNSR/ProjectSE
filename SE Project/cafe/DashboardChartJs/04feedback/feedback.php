<?php 
session_start();
include '../../condb/database.php';

if (!isset($_SESSION['manager_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
    header('Location:../signin_ep.php');
}

if (isset($_SESSION['manager_branch'])) {
    // แสดงชื่อสาขาที่ Manager นั้นอยู่
    $branch =  $_SESSION['manager_branch'];
} else {
    $branch = "ไม่พบข้อมูลของสาขาที่ Manager อยู่";
}

$emp_query = mysqli_query($conn, "SELECT * FROM employee");
$empnum = mysqli_num_rows($emp_query);

$feedback_query = mysqli_query($conn, "SELECT * FROM feedback");
$feedbacknum = mysqli_num_rows($feedback_query);

$current_year = date('Y');
$totalyear = 0;
$ord_total_query = mysqli_query($conn, "SELECT * FROM order_main WHERE YEAR(ord_orderDate) = $current_year");
$ord_total_row = mysqli_num_rows($ord_total_query);
if ($ord_total_row > 0) {
    while ($order_main = mysqli_fetch_assoc($ord_total_query)) {
        $totalyear += $order_main['ord_total'];
        
    }
}

// คำสั่ง SQL เพื่อค้นหาอายุของลูกค้าทั้งหมด
$avgsql = "SELECT AVG(YEAR(CURRENT_DATE) - YEAR(emp_birthday)) AS avg_age FROM employee";
$result = mysqli_query($conn, $avgsql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $avgAge = intval($row['avg_age']);
    
} else {
    // กรณีเกิดข้อผิดพลาดในการดึงข้อมูล
    $avgAge = "error"; // กำหนดค่าเฉลี่ยอายุเป็น 0
}

// คำสั่ง SQL เพื่อรวมจำนวน point ของแต่ละลูกค้า
$totalsql = mysqli_query($conn, "SELECT p_pointTotal FROM points");
$num_rows = mysqli_num_rows($totalsql);

$totalPoint = 0; // กำหนดค่าเริ่มต้นของรวมจำนวน point เป็น 0

// ตรวจสอบผลลัพธ์
if ($num_rows > 0 ) {
    
    // วนลูปผลลัพธ์แต่ละแถวเพื่อรวมจำนวน point ของแต่ละลูกค้า
    while ($row = mysqli_fetch_assoc($totalsql)) {
        $totalPoint += $row['p_pointTotal'];
    }
} else {
    // กรณีเกิดข้อผิดพลาดในการดึงข้อมูล
    $totalPoint = 0; // กำหนดค่ารวมจำนวน point เป็น 0
}
// ปิดการเชื่อมต่อกับฐานข้อมูล
mysqli_close($conn);








?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> 
    <script src="Javascript/test.js"></script>
    <script src="Javascript/money.js"></script>
    <link rel="stylesheet" href="../css/employee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="topbar">
            <div class="logo">
                <h2>P E R T</h2>
                <h3><?php echo "สาขา : " . $branch ?></h3>
                
            </div>
            <div class="search">
                
                <input type="text" id="search" placeholder="search here">
                <label for="search"><i class="fas fa-search"></i></label>
            </div>
            <i class="fas fa-bell"></i>
            <div class="user">
                <img src="../../image/computer.png" alt="">
            </div>
        </div>
        <div class="sidebar">
            <ul>
                <li>
                    <a href="../../Managerphp/index.php">
                        <img src="../../image/icondashboard/EditeMenu.png" alt="Dashboard Icon">
                        <div>Edite Menu</div>
                    </a>
                </li>
                <li>
                    <a href="../index.php">
                        <img src="../../image/icondashboard/dashboard.png" alt="Order Icon">
                        <div>Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="../02emp/employee.php">
                        <img src="../../image/icondashboard/Employee.png" alt="Student Icon">
                        <div>Employee</div>
                    </a>
                </li>
                <li>
                    <a href="../01cus/customer.php">
                        <img src="../../image/icondashboard/customer.png" alt="Employee Icon">
                        <div>Customer</div>
                    </a>
                </li>
               
                <li>
                    <a href="feedback.php">
                        <img src="../../image/icondashboard/feedback.png" alt="Feedback Icon">
                        <div>Feedback</div>
                    </a>
                </li>
                <li>
                    <a href="../../condb/logout.php">
                        <img src="../../image/icondashboard/logout.png" alt="Logout Icon">
                        <div>Logout</div>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main">
            <div class="cards">
                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $empnum ?></div>
                        <div class="card-name">Employee</div>

                        
                    </div>

                    <div class="icon-box">
                        <img src="../../image/icondashboard/mainemployee.png" alt="Dashboard Icon">
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $avgAge ?> Y </div>
                        <div class="card-name">Avg Age</div>
                    </div>
                    <div class="icon-box">
                        <img src="../../image/icondashboard/mainemployee.png" alt="Dashboard Icon">
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $totalyear." $" ?></div>
                        <div class="card-name">Total Point</div>
                    </div>
                    <div class="icon-box">
                        <img src="../../image/icondashboard/money.png" alt="Dashboard Icon">
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $feedbacknum ?></div>
                        <div class="card-name">Feedback</div>
                    </div>
                    <div class="icon-box">
                        <img src="../../image/icondashboard/feedback2.png" alt="Dashboard Icon">
                    </div>
                </div>

            </div>

            <!-- Charts -->
            <div class="charts">
                <div class="chart">
                <h1>Feedback Table</h1>

                    <table>
                        <thead>
                            <tr>
                                <th><center>ID</center></th>
                                <th><center>CustomerID</center></th>
                                <th><center>Feedback</center></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                            // วนลูปเพื่อแสดงข้อมูลลูกค้าทั้งหมด
                            while ($row = mysqli_fetch_assoc($feedback_query)) {
                                echo "<tr>";
                                echo "<td>  <center>" . $row['fb_feedbackID'] . " </center>  </td>";
                                echo "<td>  <center>" . $row['fb_customerID'] . " </center>  </td>";
                                echo "<td>  " . $row['fb_comment'] . "  </td>";
                                echo "</tr>";
                            }
                            ?>
                            
                        </tbody>
                    </table>
                    
                </div>
                    
                    
            </div>

               
            
            
        </div>
    </div>
</body>
</html>