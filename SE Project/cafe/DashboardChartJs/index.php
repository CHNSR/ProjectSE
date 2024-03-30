<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord JS</title>
    <!-- เพิ่มการเชื่อมโยงสคริปต์ Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <!-- เพิ่มการเชื่อมโยง jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> 
    <!-- เชื่อมโยงไฟล์ JavaScript ที่สร้างขึ้น -->
    <script src="money.js"></script>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <!-- top bar -->
    <div class="nav">
        <div class="logo-container">
            <a href="#"><img src="../image/coffee-cup.png" class="logo" /></a>
            <h2>P E R T</h2>
        </div>
        <div class="links">
            <a href="#">Menu</a>
            <a href="../Dashboard/index.php">Dashboard</a>
            <button id="LogoutBtn"><i class="bi bi-check2-circle"></i> Log Out</button>
        </div>
    </div>
    <div class="chart-container">
        <canvas id="graphCanvas"></canvas>
        
    </div>
    <form id="filterForm">
        <label for="dateFilter">Select Date:</label>
        
        <select id="filterType">
            
            <option value="Month">Month</option>
            <option value="Year">Year</option>
        </select>
        <button type="button" onclick="applyFilter()">Apply Filter</button>
    </form>


    
</body>
</html>
