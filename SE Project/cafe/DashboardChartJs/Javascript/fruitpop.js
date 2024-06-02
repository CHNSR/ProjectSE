$(document).ready(function() {
    let startDate = "2024-01-01";
    let endDate = "2024-12-31";
    $('#startdate5').val(startDate);
    $('#enddate5').val(endDate);

    // เมื่อมีการเปลี่ยนแปลงใน input element ทั้งสอง
    $('#startdate5, #enddate5').change(function() {
        let selectedStartDate = $('#startdate5').val();
        let selectedEndDate = $('#enddate5').val();
        // ส่งค่า start date และ end date ไปยังฟังก์ชัน showGraphpie()
        showGraphpie5(selectedStartDate, selectedEndDate);
    });

    // ส่งค่าปีที่เริ่มต้นไปยังฟังก์ชัน showGraph()
    showGraphpie5(startDate, endDate);
});

function showGraphpie5(startDate, endDate) {
    console.log("Start date(Fruit):", startDate, ", End date:", endDate);
    $('#debugInfoFruit').html("Start date(fruit):" + startDate + ", End date:" + endDate);

    destroyChartpie5();

    $.post('data/dataOrd-detailFruit.php', { startDate: startDate, endDate: endDate })
        .done(function(data) {
            console.log("Load data form dataOrd-detailFruit.php :",data); // แสดงข้อมูลที่ได้รับมาใน console
            if (data.length > 0) {
                createFruitCanvas(data);
                
            } else {
                console.log('ไม่พบข้อมูลสำหรับช่วงวันที่ที่เลือก');
            }
        })
        .fail(function(xhr, status, error) {
            console.error(error);
        });
}

function createFruitCanvas(data) {
    console.log("Data in createFruitCanvas :",data);
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


    let pieCanvas = document.getElementById('fruitpopcanvas').getContext('2d');

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


function destroyChartpie5() {
    let canvas = document.getElementById('fruitpopcanvas');
    if (canvas) {
        let chart = Chart.getChart(canvas);
        if (chart) {
            chart.destroy();
        }
    }
}
