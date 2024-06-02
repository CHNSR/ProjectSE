
$(document).ready(function() {
    // สร้างวันที่ปัจจุบัน
    let currentDate = new Date();
    // ดึงปีปัจจุบัน
    let currentYear = currentDate.getFullYear();
    // กำหนดค่าเริ่มต้นให้กับ select element
    $('#yearSelect').val(currentYear);

    // เมื่อมีการเปลี่ยนแปลงใน select element
    $('#yearSelect').change(function() {
        // ส่งค่าปีที่เลือกไปยังฟังก์ชัน showGraph()
        showGraphLine($('#yearSelect').val());
    });

    // ส่งค่าปีที่เริ่มต้นไปยังฟังก์ชัน showGraph()
    showGraphLine(currentYear);
});


 function showGraphLine(selectedYear ) {
    // แสดงค่าปีที่รับมาใน console เพื่อ debug
    console.log("Selected Year:", selectedYear);

    // ถ้าไม่มีค่าใดๆ ถูกส่งเข้ามาใน selectedYear ให้ใช้ค่าปี 2024 เป็นค่า default
    selectedYear = selectedYear || 2024;

    // แสดงค่าปีที่ใช้ในการดึงข้อมูลใน debugInfo div
    $('#debugInfo').html("Selected Year(money): " + selectedYear);

    // ทำลาย Chart เก่าก่อนที่จะสร้าง Chart ใหม่
    destroyChartline();

    // ส่งข้อมูลไปยังสคริปต์ PHP สำหรับดึงข้อมูลตามปีที่เลือก
    $.post('data/data.php', { selectedYear: selectedYear }, function(data) {
        let chartData = {}; // ข้อมูลสำหรับกราฟ

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if (data.length > 0) {
            // กรณีมีข้อมูล
            chartData = prepareDataForMonth(data);

            // สร้างกราฟเส้นโดยใช้ Chart.js
           
        } else {
            // กรณีไม่มีข้อมูล
            // ทำการแสดงข้อความหรือปรับปรุงส่วนของกราฟตามต้องการ
            console.log('ไม่พบข้อมูลสำหรับปีที่เลือก');
        }
    });
}

function prepareDataForMonth(data) {
    let monthsDic = {
        'January': 0, 'February': 0, 'March': 0, 'April': 0,
        'May': 0, 'June': 0, 'July': 0, 'August': 0,
        'September': 0, 'October': 0, 'November': 0, 'December': 0
    };
    let labelsmonth = Object.keys(monthsDic);

    data.forEach(function(order) {
        let orderDate = new Date(order.ord_orderDate);
        let month = orderDate.getMonth();
        let priceInOrder =  parseInt(order.ord_total);
        let monthName = Object.keys(monthsDic)[month];
        monthsDic[monthName] += priceInOrder;
    });

    // แสดงรายได้ของแต่ละเดือนใน Console
    Object.keys(monthsDic).forEach(function(month) {
        console.log(month + ': ' + monthsDic[month]);
    });

    let lineCanvas = document.getElementById('graphCanvas').getContext('2d');
    let lineChart = new Chart(lineCanvas, {
        type: 'line',
        data: {
            labels: labelsmonth, // Label เดือน
            datasets: [{
                label: 'รายได้ตามเดือน', // ชื่อของข้อมูล
                data: Object.values(monthsDic), // ข้อมูลรายได้ในแต่ละเดือน
                backgroundColor: 'rgba(255, 99, 132, 0.2)', // สีพื้นหลังกราฟ
                borderColor: 'rgba(255, 99, 132, 1)', // สีเส้นกราฟ
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // เริ่มต้นที่ 0 บนแกน Y
                }
            }
        }
    });

    return { chartData: lineChart }; // ส่งค่า instance ของ Chart ออกไป
}



 function destroyChartline() {
    let graphCanvas = document.getElementById('graphCanvas');
    if (graphCanvas) {
        let chart = Chart.getChart(graphCanvas);
        if (chart) {
            chart.destroy(); // ทำลาย Chart เก่า
        }
    }
}
