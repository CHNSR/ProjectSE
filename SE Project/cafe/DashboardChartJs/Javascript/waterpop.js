$(document).ready(function() {
    let startDate = "2024-01-01";
    let endDate = "2024-12-31";
    $('#startdate').val(startDate);
    $('#enddate').val(endDate);

    // เมื่อมีการเปลี่ยนแปลงใน input element ทั้งสอง
    $('#startdate, #enddate').change(function() {
        let selectedStartDate = $('#startdate').val();
        let selectedEndDate = $('#enddate').val();
        // ส่งค่า start date และ end date ไปยังฟังก์ชัน showGraphpie()
        showGraphpie(selectedStartDate, selectedEndDate);
    });

    // ส่งค่าปีที่เริ่มต้นไปยังฟังก์ชัน showGraph()
    showGraphpie(startDate, endDate);
});

function showGraphpie(startDate, endDate) {
    console.log("Start date:", startDate, ", End date:", endDate);
    $('#debugInfoWater').html("Start date(watwe):" + startDate + ", End date:" + endDate);

    destroyChartpie();

    $.post('data/dataOrd-detail.php', { startDate: startDate, endDate: endDate })
        .done(function(data) {
            if (data.length > 0) {
                createWaterCanvas(data);
                
            } else {
                console.log('ไม่พบข้อมูลสำหรับช่วงวันที่ที่เลือก');
            }
        })
        .fail(function(xhr, status, error) {
            console.error(error);
        });
}

function createWaterCanvas(data) {
    if (data.length > 0) {
        let coffeeCount = 0;
        let milkCount = 0;
        let teaCount = 0;

        data.forEach(function(item) {
            if (item.ord_productType === "coffee") {
                coffeeCount += parseInt(item.ord_quantity);
            } else if (item.ord_productType === "milk") {
                milkCount += parseInt(item.ord_quantity);
            } else if (item.ord_productType === "tea") {
                teaCount += parseInt(item.ord_quantity);
            }
        });

        let labels = ["Coffee", "Milk", "Tea"];
        let dataValues = [coffeeCount, milkCount, teaCount];
        let backgroundColors = ["#FF6384", "#36A2EB", "#FFCE56"];

        let pieCanvas = document.getElementById('watercanvas').getContext('2d');
        let pieChart = new Chart(pieCanvas, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
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

function destroyChartpie() {
    let waterCanvas = document.getElementById('watercanvas');
    if (waterCanvas) {
        let chart = Chart.getChart(waterCanvas);
        if (chart) {
            chart.destroy();
        }
    }
}
