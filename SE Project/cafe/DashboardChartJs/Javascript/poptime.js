$(document).ready(function() {
    let startDate = "2024-01-01";
    let endDate = "2024-12-31";
    $('#startdate2').val(startDate);
    $('#enddate2').val(endDate);

    // เมื่อมีการเปลี่ยนแปลงใน input element ทั้งสอง
    $('#startdate2, #enddate2').change(function() {
        let selectedStartDate = $('#startdate2').val();
        let selectedEndDate = $('#enddate2').val();
        // ส่งค่า start date และ end date ไปยังฟังก์ชัน showGraphpie()
        showGraphbartimes(selectedStartDate, selectedEndDate);
    });

    // ส่งค่าปีที่เริ่มต้นไปยังฟังก์ชัน showGraph()
    showGraphbartimes(startDate, endDate);
});
//ระวังอย่าให้ชื่อ func เหมือนกันเพราะมันโหลดฟังชันไปยำรวมกันอยู่ในที่เดียว ไม่งั้น chart จะไม่ขึ้น
function showGraphbartimes(startDate, endDate) {
    console.log("Start date(PopTimes):", startDate, ", End date:", endDate);
    $('#debugInfoPopTimes').html("Start date(PopTimes):" + startDate + ", End date:" + endDate);

    destroyChartbar();

    $.post('data/datapopTime.php', { startDate: startDate, endDate: endDate })
        .done(function(data) {
            if (data.length > 0) {
                createPopTimesCanvas(data);
                
            } else {
                console.log('ไม่พบข้อมูลสำหรับช่วงวันที่ที่เลือก');
            }
        })
        .fail(function(xhr, status, error) {
            console.error(error);
        });
}

function createPopTimesCanvas(data) {
    if (data.length > 0) {
        let times = { "09.00":0,"10.00":0,"11.00":0,
        "12.00":0,"13.00":0,"14.00":0,
        "15.00":0,"16.00":0,"17.00":0 };
        

        data.forEach(function(order) {
            let orderDate = new Date(order.ord_orderDate);
            let hours = orderDate.getHours();
            let timeKey;
            
            if (hours < 10) {
                timeKey = "0" + hours + ".00";
            } else {
                timeKey = hours + ".00";
            }
        
            if (times.hasOwnProperty(timeKey)) {
                times[timeKey] += 1;
            }
        });
        
        console.log("Most time in dic 'times' : ",times);
        

        let labelschart = Object.keys(times)
        let dataValues = Object.values(times)
        let backgroundColors = ["#fce4ec", "#f8bbd0", "#f48fb1", "#f06292", "#ec407a","#e91e63", "#d81b60", "#c2185b", "#ad1457"];

        let Canvas = document.getElementById('poptimescanvas').getContext('2d');
        let barChart = new Chart(Canvas, {
            type: 'bar',
            data: {
                labels: labelschart,
                datasets: [{
                    data: dataValues,
                    backgroundColor: backgroundColors
                }]
            }
        });

        return { chartData: barChart };
    } else {
        console.log('ไม่พบข้อมูลสำหรับกราฟ');
        return { chartData: null };
    }
}

function destroyChartbar() {
    let Canvas = document.getElementById('poptimescanvas');
    if (Canvas) {
        let chart = Chart.getChart(Canvas);
        if (chart) {
            chart.destroy();
        }
    }
}
