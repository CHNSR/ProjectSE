<?php
session_start();
include '../condb/database.php';

if (!isset($_SESSION['manager_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
    header('Location:../signin_ep.php');
}

$maneger_ID = $_SESSION['manager_login'];
$manager_query = mysqli_query($conn, "SELECT * FROM employee WHERE emp_employeeID = '{$maneger_ID}'");
$manager_resule = mysqli_fetch_assoc($manager_query);
$manager_name = $manager_resule['emp_name'];
$manager_surname = $manager_resule['emp_sername'];


$customer_query = mysqli_query($conn, "SELECT * FROM customer");
$customer_row = mysqli_num_rows($customer_query);

$employee_query = mysqli_query($conn, "SELECT * FROM employee");
$employee_row = mysqli_num_rows($employee_query);

$current_month = date('m');
$ord_total_query = mysqli_query($conn, "SELECT * FROM order_main WHERE MONTH(ord_orderDate) = $current_month");
$ord_total_row = mysqli_num_rows($ord_total_query);
$total = 0;
if ($ord_total_row > 0) {
    while ($order_main = mysqli_fetch_assoc($ord_total_query)) {
        $total += $order_main['ord_total'];
    }
}

$feedback_query = mysqli_query($conn, "SELECT * FROM feedback");
$feedback_row = mysqli_num_rows($feedback_query);

$data = array();
for ($i = 1; $i <= 12; $i++) {
    // Query to retrieve data from database
    $month_query = mysqli_query($conn, "SELECT COALESCE(SUM(ord_total), 0) AS total FROM order_main WHERE MONTH(ord_orderDate) = $i");

    if ($month_query) {
        $row = mysqli_fetch_assoc($month_query);
        $month_total = $row['total'];
        $data[] = $month_total; // เพิ่มข้อมูลเข้าไปในอาร์เรย์ $data
    } else {
        echo "Error executing query for month $i: " . mysqli_error($conn);
    }
}

$cof_query = mysqli_query($conn, "SELECT * FROM order_detail WHERE ord_productType = 'coffee'");
$cof_row = mysqli_num_rows($cof_query);

$mil_query = mysqli_query($conn, "SELECT * FROM order_detail WHERE ord_productType = 'milk'");
$mil_row = mysqli_num_rows($mil_query);

$tea_query = mysqli_query($conn, "SELECT * FROM order_detail WHERE ord_productType = 'tea'");
$tea_row = mysqli_num_rows($tea_query);

$water = array(
    $cof_row,
    $mil_row,
    $tea_row
);

$age_query = mysqli_query($conn, "SELECT cus_birthday FROM customer");

// ตรวจสอบว่ามีผลลัพธ์ที่ได้หรือไม่
if (mysqli_num_rows($age_query) > 0) {
    // เก็บข้อมูลอายุไว้ใน array
    $age_array = array();

    // วนลูปผลลัพธ์ที่ได้
    while ($row = mysqli_fetch_assoc($age_query)) {
        // ดึงวันเกิดแต่ละคน
        $birthday = $row['cus_birthday'];

        // คำนวณอายุจากวันเกิด
        $birth_date = new DateTime($birthday);
        $current_date = new DateTime();
        $age = $current_date->diff($birth_date)->y; // ดึงอายุเป็นปี

        // เก็บอายุลงใน array
        $age_array[] = $age;
    }
} else {
    echo "ไม่พบข้อมูลวันเกิด";
}
$age_count = array(
    '12-18' => 0,
    '19-29' => 0,
    '30-40' => 0
);

// นับจำนวนคนในแต่ละช่วงอายุ
foreach ($age_array as $age) {
    if ($age >= 12 && $age <= 18) {
        $age_count['12-18']++;
    } elseif ($age >= 19 && $age <= 29) {
        $age_count['19-29']++;
    } elseif ($age >= 30 && $age <= 40) {
        $age_count['30-40']++;
    }
}
$age_values = array_values($age_count);

$water_hit_query = mysqli_query($conn, "SELECT ord_productName, COUNT(*) AS total_count 
                                         FROM order_detail 
                                         WHERE ord_productType IN ('coffee', 'milk', 'tea')
                                         GROUP BY ord_productName 
                                         ORDER BY total_count DESC 
                                         LIMIT 4");

$top_product_names = array(); // อาเรย์สำหรับเก็บชื่อสินค้า
$top_product_counts = array(); // อาเรย์สำหรับเก็บจำนวนของสินค้า

while ($row = mysqli_fetch_assoc($water_hit_query)) {
    $product_name = $row['ord_productName'];
    $product_count = $row['total_count'];
    $top_product_names[] = $product_name; // เพิ่มชื่อสินค้าลงในอาเรย์
    $top_product_counts[] = $product_count; // เพิ่มจำนวนของสินค้าลงในอาเรย์
}

// แปลงข้อมูลเป็นรูปแบบ JSON
$data_json = json_encode($data);
$water_jason = json_encode($water);
$age_jason = json_encode($age_values);
$water_top_name_jason = json_encode($top_product_names);
$water_top_count_jason = json_encode($top_product_counts);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script>
        // ใช้ข้อมูลจาก PHP แทนที่ข้อมูลจาก JavaScript
        var chartData = <?php echo $data_json; ?>;
    </script>
    <script>
        // ใช้ข้อมูลจาก PHP แทนที่ข้อมูลจาก JavaScript
        var chartWater = <?php echo $water_jason ?>;
    </script>
    <script>
        // ใช้ข้อมูลจาก PHP แทนที่ข้อมูลจาก JavaScript
        var cahrtAge = <?php echo $age_jason ?>;
    </script>
    <script>
        // ใช้ข้อมูลจาก PHP แทนที่ข้อมูลจาก JavaScript
        var cahrtName = <?php echo $water_top_name_jason ?>;
        var cahrtCount = <?php echo $water_top_count_jason ?>;
    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin Dashboard</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $manager_name . ' ' . $manager_surname ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../condb/logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Customer</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $customer_row ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Employee</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $employee_row ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Sales</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">฿<?php echo number_format($total, 2) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Feedback</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $feedback_row ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Order Overview</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <input type="hidden" id="phpData" value="<?php echo $data; ?>">
                                        <canvas id="OrderOverviewChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Drink Poppular</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <input type="hidden" id="phpData1" value="<?php echo $water; ?>">
                                        <canvas id="Drink_Poppular"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Coffee
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Milk
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Tea
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Age Range</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <input type="hidden" id="phpData2" value="<?php echo $age_values; ?>">
                                        <canvas id="Age_range"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> 12 - 18
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> 19 - 29
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> 30 - 40
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Content Column -->
                        <!-- Project Card Example -->
                        <div class="card shadow mb-4 col-xl-8 col-lg-7">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Dessert</h6>
                            </div>
                            <style>
                                .scrollable-menu {
                                    max-height: 300px;
                                    /* กำหนดความสูงสูงสุดของเมนู */
                                    overflow-y: auto;
                                    /* เพิ่ม scrollbar เมื่อมีเมนูเกิน 5 รายการ */
                                }
                            </style>
                            <div class="card-body scrollable-menu"> <!-- ใส่ class "scrollable-menu" เพื่อให้ CSS นี้ใช้กับ div นี้เท่านั้น -->
                                <?php
                                $dess_query = mysqli_query($conn, "SELECT * FROM dessert_menu");
                                $dess_row = mysqli_num_rows($dess_query);

                                $quantities = array();
                                while ($row = mysqli_fetch_assoc($dess_query)) {
                                    // คำนวณเป็นเปอร์เซ็นต์เมื่อเทียบกับ 20
                                    $percentage = ($row['dess_quantity'] / 20) * 100;
                                    // เพิ่มข้อมูลลงในอาเรย์พร้อมกับชื่อเมนู
                                    $quantities[] = array(
                                        'menuName' => $row['dess_menuName'],
                                        'percentage' => $percentage
                                    );
                                }
                                // วนลูปผ่านอาเรย์เพื่อแสดงผล
                                foreach ($quantities as $key => $data) {
                                    echo '<h4 class="small font-weight-bold">' . $data['menuName'] . '<span class="float-right">' . $data['percentage'] . '%</span></h4>';
                                    echo '<div class="progress mb-4">';
                                    $percentage = $data['percentage'];
                                    if ($percentage >= 0 && $percentage <= 20) {
                                        echo '<div class="progress-bar bg-danger" role="progressbar" style="width: ' . $percentage . '%" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>';
                                    } elseif ($percentage > 20 && $percentage <= 40) {
                                        echo '<div class="progress-bar bg-warning" role="progressbar" style="width: ' . $percentage . '%" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>';
                                    } elseif ($percentage > 40 && $percentage <= 60) {
                                        echo '<div class="progress-bar" role="progressbar" style="width: ' . $percentage . '%" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>';
                                    } elseif ($percentage > 60 && $percentage <= 80) {
                                        echo '<div class="progress-bar bg-info" role="progressbar" style="width: ' . $percentage . '%" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>';
                                    } elseif ($percentage > 80 && $percentage <= 100) {
                                        echo '<div class="progress-bar bg-success" role="progressbar" style="width: ' . $percentage . '%" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>';
                                    }
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Donut Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Water Menu Poppular</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <input type="hidden" id="phpData3" value="<?php echo $top_product_names; ?>">
                                        <input type="hidden" id="phpData3" value="<?php echo $top_product_counts; ?>">
                                        <canvas id="waterTopChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Donut Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Dessert Menu Poppular</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <canvas id="myPieChart"></canvas>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Donut Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Fruit Menu Poppular</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../condb/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-pie-demo-2.js"></script>
    <script src="js/demo/chart-bar-demo-2.js"></script>
    <script src="js/demo/chart-pie-demo-3.js"></script>

</body>

</html>