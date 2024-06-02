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

//นับพนักงานโดยใช้แถวในการนับ
$employee_query = mysqli_query($conn, "SELECT * FROM employee ");
$empnum = mysqli_num_rows($employee_query);


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
// เช็คว่ามีการส่งค่า ID มาหรือไม่
if (isset($_GET['edite_id'])) {
    // ดึงค่า ID ออกมาจาก URL
    $empID = $_GET['edite_id'];
    $edite_employee_query = mysqli_query($conn, "SELECT * FROM employee WHERE emp_employeeID = $empID");
    if ($employee_query) {
        $employee_data = mysqli_fetch_assoc($employee_query);
        $emp_username = $employee_data['emp_username'];
        $emp_birthday = $employee_data['emp_birthday'];
        $emp_name = $employee_data['emp_name'];
        $emp_sername = $employee_data['emp_sername'];
        $emp_ID = $employee_data['emp_ID'];
        $emp_address = $employee_data['emp_address'];
        $emp_tell = $employee_data['emp_tell'];
        $emp_email = $employee_data['emp_email'];
        $emp_branchID = $employee_data['emp_branchID'];
    } else {
        // กรณีเกิดข้อผิดพลาดในการดึงข้อมูล
        echo "เกิดข้อผิดพลาดในการดึงข้อมูล: " . mysqli_error($conn);
    }
} else {
    // ถ้าไม่มี ID ใน URL ให้ทำอย่างอื่น เช่น แสดงข้อความบอกว่าไม่พบ ID
    echo "ไม่พบ ID ที่ส่งมาแก้ไข";
}
$feedback_query = mysqli_query($conn, "SELECT * FROM feedback");
$feedbacknum = mysqli_num_rows($feedback_query);





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
                    <a href="employee.php">
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
                    <a href="../04feedback/feedback.php">
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
                        <div class="number"><?php echo $totalPoint." P" ?></div>
                        <div class="card-name">Total Point</div>
                    </div>
                    <div class="icon-box">
                        <img src="../../image/icondashboard/mainemployee.png" alt="Dashboard Icon">
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
                <h1>Edit Employee</h1>
                <br>
                    <form action="../../condb/emp_updatedb.php" method="POST">
                    
                       
                        <label for="empID">Username:</label>
                        <input type="text" id="empID" name="empID" value="<?php echo $empID; ?>" readonly>
                        
                        <label for="emp_username">Username:</label>
                        <input type="text" id="emp_username" name="emp_username" value="<?php echo $emp_username; ?>">
                        <br>
                        <label for="emp_password">Password:</label>
                        <input type="password" id="emp_password" name="emp_password">
                        <br>
                        <label for="emp_employeelevel">Employee Level:</label>
                        <select id="emp_employeelevel" name="emp_employeelevel">
                            <option value="A">Manager</option>
                            <option value="B">Barista</option>
                            <option value="C">Cashier</option>
                        </select>
                        <br>
                        <label for="emp_birthday">Birthday:</label>
                        <input type="date" id="emp_birthday" name="emp_birthday" value="<?php echo $emp_birthday; ?>">
                        <br>
                        <label for="emp_name">Name:</label>
                        <input type="text" id="emp_name" name="emp_name" value="<?php echo $emp_name; ?>">
                        <br>
                        <label for="emp_sername">Surname:</label>
                        <input type="text" id="emp_sername" name="emp_sername" value="<?php echo $emp_sername; ?>">
                        <br>
                        <label for="emp_ID">ID Number:</label>
                        <input type="text" id="emp_ID" name="emp_ID" value="<?php echo $emp_ID; ?>">
                        <br>
                        <label for="emp_address">Address:</label>
                        <textarea id="emp_address" name="emp_address"><?php echo $emp_address; ?></textarea>
                        <br>
                        <label for="emp_tell">Telephone:</label>
                        <input type="text" id="emp_tell" name="emp_tell" value="<?php echo $emp_tell; ?>">
                        <br>
                        <label for="emp_email">Email:</label>
                        <input type="email" id="emp_email" name="emp_email" value="<?php echo $emp_email; ?>">
                        <br>
                        <label for="emp_branchID">branch:</label>
                        <input type="number" id="emp_branchID" name="emp_branchID"" value="<?php echo $emp_branchID; ?>">
                        <br>
                        <input type="submit" value="Submit">

                    </form>

  
                </div>
                    
                    
            </div>

               
            
            
        </div>
    </div>
</body>
</html>