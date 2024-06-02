<?php 
session_start();
include '../condb/database.php';

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

$customer_query = mysqli_query($conn, "SELECT * FROM customer");
$cusnum = mysqli_num_rows($customer_query);

$employee_query = mysqli_query($conn, "SELECT * FROM employee");
$empnum = mysqli_num_rows($employee_query);

$current_year = date('Y');
$totalyear = 0;
$ord_total_query = mysqli_query($conn, "SELECT * FROM order_main WHERE YEAR(ord_orderDate) = $current_year");
$ord_total_row = mysqli_num_rows($ord_total_query);
if ($ord_total_row > 0) {
    while ($order_main = mysqli_fetch_assoc($ord_total_query)) {
        $totalyear += $order_main['ord_total'];
        
    }
}

$feedback_query = mysqli_query($conn, "SELECT * FROM feedback");
$feedbacknum = mysqli_num_rows($feedback_query);



$years_set = array(); // เก็บปีที่ไม่ซ้ำกันไว้ใน Set
$option_query = mysqli_query($conn, "SELECT * FROM order_main WHERE ord_orderDate IS NOT NULL");
$ord_total_row = mysqli_num_rows($option_query);

if ($ord_total_row > 0) {
    while ($order_main = mysqli_fetch_assoc($option_query)) {
        $orderDate = date('Y', strtotime($order_main['ord_orderDate'])); // ดึงปีจากวันที่
        $years_set[$orderDate] = true; // เพิ่มปีลงใน Set
    }
}


$dateforpie_set = array(); //เก็บวันเวลา
$pie_query = mysqli_query($conn, "SELECT * FROM order_main WHERE ord_orderDate IS NOT NULL");

if ($ord_total_row > 0) {
    while ($order_mainpie = mysqli_fetch_assoc($pie_query)) {
        $orderDatepie = date( 'Y-m-d H:i:s', strtotime($order_mainpie['ord_orderDate'])); // 
        $dateforpie_set[$orderDatepie] = true; // เพิ่มปีลงใน Set
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> 
    <script src="Javascript/waterpop.js"></script>
    <script src="Javascript/money.js"></script>
    <script src="Javascript/fruitpop.js"></script>
    <script src="Javascript/desspop.js"></script>
    <script src="Javascript/poptime.js"></script>
    <script src="Javascript/branchpopseal.js"></script>
    <link rel="stylesheet" href="css/style.css">
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
                <img src="../image/computer.png" alt="">
            </div>
        </div>
        <div class="sidebar">
            <ul>
                <li>
                    <a href="../Managerphp/index.php">
                        <img src="../image/icondashboard/EditeMenu.png" alt="Dashboard Icon">
                        <div>Edite Menu</div>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <img src="../image/icondashboard/dashboard.png" alt="Order Icon">
                        <div>Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="02emp/employee.php">
                        <img src="../image/icondashboard/Employee.png" alt="Student Icon">
                        <div>Employee</div>
                    </a>
                </li>
                <li>
                    <a href="01cus/customer.php">
                        <img src="../image/icondashboard/customer.png" alt="Employee Icon">
                        <div>Customer</div>
                    </a>
                </li>
                
                <li>
                    <a href="04feedback/feedback.php">
                        <img src="../image/icondashboard/feedback.png" alt="Feedback Icon">
                        <div>Feedback</div>
                    </a>
                </li>
                <li>
                    <a href="../condb/logout.php">
                        <img src="../image/icondashboard/logout.png" alt="Logout Icon">
                        <div>Logout</div>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main">
            <div class="cards">
                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $cusnum ?></div>
                        <div class="card-name">Customer</div>
                    </div>
                    <div class="icon-box">
                        <img src="../image/icondashboard/mainemployee.png" alt="Dashboard Icon">
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $empnum ?></div>
                        <div class="card-name">Employee</div>
                    </div>
                    <div class="icon-box">
                        <img src="../image/icondashboard/mainemployee.png" alt="Dashboard Icon">
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $totalyear." $" ?></div>
                        <div class="card-name">Sales <?php echo $current_year ?> </div>
                    </div>
                    <div class="icon-box">
                        <img src="../image/icondashboard/money.png" alt="Dashboard Icon">
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $feedbacknum ?></div>
                        <div class="card-name">Feedback</div>
                    </div>
                    <div class="icon-box">
                        <img src="../image/icondashboard/feedback2.png" alt="Dashboard Icon">
                    </div>
                </div>

            </div>

            <!-- Charts -->
            <div class="charts">
                <div class="chart">
                    <h2>Money 12 month</h2>
                        <!--<canvas id="myCharts"></canvas>-->
                        <canvas id="graphCanvas"></canvas>

                        <form id="filterForm">
                            

                            <p>Start Date : 
                            <select id="yearSelect">
                                <?php
                                foreach ($years_set as $year => $value) {
                                    echo "<option value=\"$year\">$year</option>";
                                }
                                ?>
                                
                            </select>
                            <div id="debugInfo"></div>
                            </p>
                            

                        </form> 
                        
                </div>

                <div class="chart">
                    <div class="waterpopchart" >
                        <h2>Popular Water Type</h2>
                        <canvas id="watercanvas"></canvas>
                    </div>
                    <br>
                    <form id="filterFormpie">
                        <p>Start Date : 
                        <input type="date" name="startdate" id="startdate">
                        <br>
                        End Date :
                        <input type="date" name="enddate" id="enddate">
                        <div id="debugInfoWater"></div>
                        </p>
                    </form> 
                </div>

                <div class="chart">
                    <div class="Timepopchart">
                        <h2>Popular Time</h2>
                        <canvas id="poptimescanvas"></canvas>
                    </div>
                    <br>
                    <form id="filterFormbarTP">
                        <p>Start Date : 
                        <input type="date" name="startdate2" id="startdate2">
                        <br>
                        End Date :
                        <input type="date" name="enddate2" id="enddate2">
                        <div id="debugInfoPopTimes"></div>
                        </p>
                    </form> 
                </div>

                <div class="chart">
                    <div class="dresspopchart">
                        <h2>Popular Dressert</h2>
                        <canvas id="desspopcanvas"></canvas>
                    </div>
                    <br>
                    <form id="filterFormpiePD">
                        <p>Start Date : 
                        <input type="date" name="startdate3" id="startdate3">
                        <br>
                        End Date :
                        <input type="date" name="enddate3" id="enddate3">
                        <div id="debugInfoDess"></div>
                        </p>
                    </form> 
                </div>

                <div class="chart">
                    <div class="brancesalepopchart">
                        <h2>Brance Most Sale</h2>
                        <canvas id="popbranchcanvas"></canvas>
                    </div>
                    <form id="filterFormbarBR">
                        <p>Start Date : 
                        <input type="date" name="startdate4" id="startdate4">
                        <br>
                        End Date :
                        <input type="date" name="enddate4" id="enddate4">
                        <div id="debugInfoPopBranch"></div>
                        </p>
                    </form> 
                </div>

                <div class="chart">
                    <div class="fruitpopchart">
                        <h2>Popular Fruit </h2>
                        <canvas id="fruitpopcanvas"></canvas>
                    </div>
                    <br>
                    <form id="filterFormpiePF">
                        <p>Start Date : 
                        <input type="date" name="startdate5" id="startdate5">
                        <br>
                        End Date :
                        <input type="date" name="enddate5" id="enddate5">
                        <div id="debugInfoFruit"></div>
                        </p>
                    </form> 
                </div>
                    
                    
            </div>

               
            
            
        </div>
    </div>
</body>
</html>