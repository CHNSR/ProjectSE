/*
$(document).ready(function() {
    // เรียกฟังก์ชัน showGraph() เมื่อเอกสารพร้อม
    showGraph();

    // ส่งข้อมูลฟอร์มเมื่อมีการส่งฟอร์ม
    $('#filterForm').submit(function(event) {
        event.preventDefault(); // ป้องกันการโหลดหน้าใหม่
        showGraph();
    });
});

function showGraph() {
    //let filterDate = $('#dateFilter').val(); // รับค่าวันที่จากฟอร์ม
    let filterType = $('#filterType').val(); // รับค่าประเภทการกรองจากฟอร์ม

    // ส่งข้อมูลไปยังสคริปต์ PHP สำหรับดึงข้อมูลตามฟิลเตอร์
    $.post('data/data.php', { filterType: filterType }, function(data) {
        let chartData = {}; // ข้อมูลสำหรับกราฟ

        if (filterType === 'Month') {
            chartData = prepareDataForMonth(data);
        } else if (filterType === 'Year') {
            chartData = calculateYearlyRevenue(data);
        }

        // สร้างกราฟเส้นโดยใช้ Chart.js
        let graphCanvas = document.getElementById('graphCanvas').getContext('2d');
        let lineChart = new Chart(graphCanvas, {
            type: 'line',
            data: chartData.chartData,
            options: chartData.chartOptions
        });
        
        
    });
}
*/

$(document).ready(function() {
    // เรียกฟังก์ชัน showGraph() เมื่อเอกสารพร้อม
    showGraph();

    // ส่งข้อมูลฟอร์มเมื่อมีการส่งฟอร์ม
    $('#filterForm').submit(function(event) {
        event.preventDefault(); // ป้องกันการโหลดหน้าใหม่
        showGraph();
    });

    // เมื่อมีการเปลี่ยนแปลงใน select element
    $('#filterType').change(function() {
        showGraph();
    });
});

function showGraph() {
    let filterType = $('#filterType').val(); // รับค่าประเภทการกรองจากฟอร์ม

    // ส่งข้อมูลไปยังสคริปต์ PHP สำหรับดึงข้อมูลตามฟิลเตอร์
    $.post('data/data.php', { filterType: filterType }, function(data) {
        let chartData = {}; // ข้อมูลสำหรับกราฟ

        if (filterType === 'Month') {
            chartData = prepareDataForMonth(data);
        } else if (filterType === 'Year') {
            chartData = calculateYearlyRevenue(data);
        }

        // สร้างกราฟเส้นโดยใช้ Chart.js
        let graphCanvas = document.getElementById('graphCanvas').getContext('2d');
        let lineChart = new Chart(graphCanvas, {
            type: 'line',
            data: chartData.chartData,
            options: chartData.chartOptions
        });
    });
}

/* //error 
function prepareDataForHour(data) {
    // สร้างอาร์เรย์เก็บรายได้ของแต่ละชั่วโมงในช่วงที่ร้านเปิด (9:00 - 17:00)
    let hours = new Array(8).fill(0); // สร้างอาร์เรย์เก็บรายได้ของแต่ละชั่วโมง (8 ชั่วโมงเพราะร้านเปิด 8 ชั่วโมง)

    // การประมวลผลข้อมูลตามชั่วโมง
    for (let i in data) {
        let orderDate = new Date(data[i].ord_orderDate);
        let hour = orderDate.getHours(); // รับชั่วโมงของวัน (0 - 23)

        // ตรวจสอบว่าเวลาอยู่ในช่วงเปิดร้านหรือไม่ (9:00 - 17:00)
        if (hour >= 9 && hour < 17) {
            // เพิ่มรายได้ในชั่วโมงที่เหมาะสม
            hours[hour - 9] += parseFloat(data[i].ord_total); // ลบ 9 เพื่อปรับให้ชั่วโมงเริ่มต้นที่ 0
        }
    }

    let chartDataforhour = {
        labels: Array.from({ length: 8 }, (9, i) => i + 1), // สร้างรายชั่วโมงตั้งแต่ 9 โมงเช้าถึง 16 โมง
        datasets: [{
            label: 'Revenue (Hourly)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            data: hours
        }]
    };

    let chartOptions = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    return { chartData: chartDataforhour, chartOptions: chartOptions };
}
*/



function prepareDataForMonth(data) {
    let months = new Array(12).fill(0); // สร้างอาร์เรย์เก็บรายได้ของแต่ละเดือน

    // การประมวลผลข้อมูลตามเดือน
    for (let i in data) {
        let orderDate = new Date(data[i].ord_orderDate);
        let month = orderDate.getMonth();

        // เพิ่มรายได้ในเดือนที่เหมาะสม
        months[month] += parseFloat(data[i].ord_total);
    }

    let chartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Revenue (Monthly)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            data: months
        }]
    };

    let chartOptions = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    return { chartData: chartData, chartOptions: chartOptions };
}

function prepareDataForYear(data) {
    let years = {}; // สร้างออบเจกต์เก็บรายได้ของแต่ละปี

    // การประมวลผลข้อมูลตามปี
    for (let i in data) {
        let orderDate = new Date(data[i].ord_orderDate);
        let year = orderDate.getFullYear();

        // เพิ่มรายได้ในปีที่เหมาะสม
        if (!years[year]) {
            years[year] = 0;
        }
        years[year] += parseFloat(data[i].ord_total);
    }

    let chartData = {
        labels: Object.keys(years),
        datasets: [{
            label: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', '2'],//'Revenue (Yearly)',
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1,
            data: Object.values(years)
        }]
    };

    let chartOptions = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    return { chartData: chartData, chartOptions: chartOptions };
}

function calculateYearlyRevenue(data) {
    let years = {}; // เก็บยอดขายรายปี

    // วน loop เพื่อประมวลผลข้อมูล
    for (let i = 0; i < data.length; i++) {
        let orderDate = new Date(data[i].ord_orderDate);
        let year = orderDate.getFullYear();

        // เพิ่มยอดขายในปีนั้นๆ
        if (!years[year]) {
            years[year] = 0;
        }
        years[year] += parseFloat(data[i].ord_total);
    }

    // สร้างออบเจกต์สำหรับเก็บข้อมูลกราฟ
    let chartData = {
        labels: Object.keys(years),
        datasets: [{
            label: 'Revenue (Yearly)',
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1,
            data: Object.values(years)
        }]
    };

    // ตั้งค่าตัวเลือกของกราฟ
    let chartOptions = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    return { chartData: chartData, chartOptions: chartOptions };
}


