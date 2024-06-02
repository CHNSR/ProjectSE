$(document).ready(function() {
    let startDate = "2024-01-01";
    let endDate = "2024-12-31";
    $('#startdate3').val(startDate);
    $('#enddate3').val(endDate);

    // เมื่อมีการเปลี่ยนแปลงใน input element ทั้งสอง
    $('#startdate3, #enddate3').change(function() {
        let selectedStartDate = $('#startdate3').val();
        let selectedEndDate = $('#enddate3').val();
        // ส่งค่า start date และ end date ไปยังฟังก์ชัน showGraphpie()
        showGraphpie2(selectedStartDate, selectedEndDate);
    });

    // ส่งค่าปีที่เริ่มต้นไปยังฟังก์ชัน showGraph()
    showGraphpie2(startDate, endDate);
});

function showGraphpie2(startDate, endDate) {
    console.log("Start date:", startDate, ", End date:", endDate);
    $('#debugInfoDess').html("Start date(dess):" + startDate + ", End date:" + endDate);

    destroyChartpie2();

    $.post('data/dataOrd-detailDess.php', { startDate: startDate, endDate: endDate })
        .done(function(data) {
            console.log("Load data form dataOrd-detailDess.php :",data); // แสดงข้อมูลที่ได้รับมาใน console
            if (data.length > 0) {
                createDessCanvas(data);
                
            } else {
                console.log('ไม่พบข้อมูลสำหรับช่วงวันที่ที่เลือก');
            }
        })
        .fail(function(xhr, status, error) {
            console.error(error);
        });
}

function createDessCanvas(data) {
    console.log("Data in createDessCanvas :",data);
    let dicOfProductName = {};
    let backgroundColors = [];
    // สุ่มสีแบบ RGB
    function getRandomColor() {
        let letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    

    if (data.length > 0) {
        

    // นับจำนวนสินค้าตามประเภท
    data.forEach(function(data) {
        console.log("Data in ForEach :",data);

        let productName = data.ord_productName;
        let quantity = data.ord_quantity;

        // ตรวจสอบว่าชื่อสินค้านี้มีอยู่ใน dictionary แล้วหรือยัง
        if (dicOfProductName.hasOwnProperty(productName)) {
            // หากมีอยู่แล้วให้เพิ่มจำนวนสินค้าเข้าไป
            dicOfProductName[productName] += quantity;
        } else {
            // ถ้ายังไม่มีให้เพิ่มสินค้าเข้าไปใน dictionary พร้อมกับจำนวนสินค้า
            dicOfProductName[productName] = quantity;
        }
    });
    // ดึงชื่อสินค้าทั้งหมดออกมาจาก dictionary ในรูปของ array
    let productNames = Object.keys(dicOfProductName);
    // ดึง value สินค้าทั้งหมดออกมาจาก dictionary ในรูปของ array
    let dataValues = Object.values(dicOfProductName);
    // สร้างสีเพิ่มเติมตามจำนวน key ของ productNames
    for (let i = 0; i < productNames.length; i++) {
        backgroundColors.push(getRandomColor());
    }
    
    console.log("Labels : ",productNames);
    console.log("Data : ",dataValues);
    console.log("Colors :",backgroundColors);


    let pieCanvas = document.getElementById('desspopcanvas').getContext('2d');

    let pieChart = new Chart(pieCanvas, {
        type: 'pie',
        data: {
            labels: productNames, // ใช้ชื่อสินค้าเป็น labels
            datasets: [{
                data: dataValues , // ใช้จำนวนสินค้าเป็นข้อมูล
                backgroundColor: backgroundColors
            }]
        }
    });
    

        return { chartData: pieChart };
    } else {
        console.log('ไม่พบข้อมูลสำหรับกราฟ');
        return { chartData: null };
    }
}


function destroyChartpie2() {
    let desspopcanvas = document.getElementById('desspopcanvas');
    if (desspopcanvas) {
        let chart = Chart.getChart(desspopcanvas);
        if (chart) {
            chart.destroy();
        }
    }
}
