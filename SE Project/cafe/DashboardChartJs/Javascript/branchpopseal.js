$(document).ready(function() {
    let startDate = "2024-01-01";
    let endDate = "2024-12-31";
    $('#startdate4').val(startDate);
    $('#enddate4').val(endDate);

    // เมื่อมีการเปลี่ยนแปลงใน input element ทั้งสอง
    $('#startdate4, #enddate4').change(function() {
        let selectedStartDate = $('#startdate4').val();
        let selectedEndDate = $('#enddate4').val();
        // ส่งค่า start date และ end date ไปยังฟังก์ชัน showGraphpie()
        showGraphbarpopbranch(selectedStartDate, selectedEndDate);
    });

    // ส่งค่าปีที่เริ่มต้นไปยังฟังก์ชัน showGraph()
    showGraphbarpopbranch(startDate, endDate);
});
//ระวังอย่าให้ชื่อ func เหมือนกันเพราะมันโหลดฟังชันไปยำรวมกันอยู่ในที่เดียว ไม่งั้น chart จะไม่ขึ้น
function showGraphbarpopbranch(startDate, endDate) {
    console.log("Start date(PopBranch):", startDate, ", End date:", endDate);
    $('#debugInfoPopBranch').html("Start date(PopBranch):" + startDate + ", End date:" + endDate);

    destroyChartPopBranch();

    $.post('data/dataMostSale.php', { startDate: startDate, endDate: endDate })
        .done(function(data) {
            if (data.length > 0) {
                createPopBranchCanvas(data);
                
            } else {
                console.log('ไม่พบข้อมูลสำหรับช่วงวันที่ที่เลือก');
            }
        })
        .fail(function(xhr, status, error) {
            console.error(error);
        });
}

function createPopBranchCanvas(data) {
    let branch = {};
    let backgroundColors1 = [];
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
        
       

        data.forEach(function(databranch) {
            let branchName = databranch.b_name;
            let totalSales =  parseInt(databranch.ord_total);
    
            // ตรวจสอบว่าสาขานี้มีอยู่ใน dictionary แล้วหรือไม่
            if (branch.hasOwnProperty(branchName)) {
                // ถ้ามีอยู่แล้วให้เพิ่มยอดขายเข้าไป
                branch[branchName] += totalSales;
            } else {
                // ถ้ายังไม่มีให้เพิ่มสาขาเข้าไปพร้อมกับยอดขาย
                branch[branchName] = totalSales;
            }
        });
    
        
        console.log("Top Sale in dic 'branch' before sort : ",branch);

        // เรียงลำดับ branch ตามค่า value จากมากไปน้อย
        let branchEntries = Object.entries(branch);
        branchEntries.sort(([, valueA], [, valueB]) => valueB - valueA);
        let sortedBranch = Object.fromEntries(branchEntries);

        console.log("Top Sale in dic 'branch' after sort : ",sortedBranch);
        let labelschart = Object.keys(sortedBranch)
        let dataValues = Object.values(sortedBranch)

        for (let i = 0; i < labelschart.length; i++) {
            backgroundColors1.push(getRandomColor());
        }

        let Canvas = document.getElementById('popbranchcanvas').getContext('2d');
        let barChart = new Chart(Canvas, {
            type: 'bar',
            data: {
                labels: labelschart,
                datasets: [{
                    axis: 'y',
                    label: 'Most Sale Branch',
                    data: dataValues,
                    backgroundColor: backgroundColors1
                }]
                
            },
            options: {
                indexAxis: 'y',
            }
            
            
        });

        return { chartData: barChart };
    } else {
        console.log('ไม่พบข้อมูลสำหรับกราฟ');
        return { chartData: null };
    }
}

function destroyChartPopBranch() {
    let Canvas = document.getElementById('popbranchcanvas');
    if (Canvas) {
        let chart = Chart.getChart(Canvas);
        if (chart) {
            chart.destroy();
        }
    }
}
