<?php
  session_start();
  require_once '../condb/database.php';
  if (!isset($_SESSION['cus_login'])) {
      $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
      header('Location:signin_ep.php');
  }


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/css_for_user/Dashbord.css">
    <title>P E R T</title>
  <title>Menu & Order</title>
  


    
</head>
<body>
    
    
    <nav class="navbar navbar-light" style="background-color: #34f6b5;">
        <div class="logo-container">
            <a href="#"><img src="image/coffee-cup.png" class="logo" /></a>
            <h2>P E R T</h2>
      </div>
      <div class="links">
            <a href="Userinter.php">Menu</a>
            <a href="Userphp/Information.php">Information</a>
            <a href="feedback.php">Feedback</a>
            <button id="logoutBt"><i class="bi bi-arrow-left-circle-fill"></i> Logout</button>
      </div>
      
    </nav>

    <main>
   


        
    
    
    

    </main>
    <aside>

    </aside>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    $(document).ready(function(){
        // เมื่อคลิกที่ปุ่ม "Logout"
        $("#logoutBt").click(function(){
            // สร้าง AJAX request
            $.ajax({
                url: "../condb/logout.php", // กำหนด URL ของไฟล์ PHP ที่ใช้ในการล็อกเอาท์
                type: "GET", // กำหนดเป็นเมธอด GET
                success: function(data){
                    // หากการ request สำเร็จ
                    alert("Logout successful"); // แสดงข้อความแจ้งเตือน
                    window.location.href = "../index.php"; // redirect ไปยังหน้า index.php
                },
                error: function(){
                    // หากการ request ไม่สำเร็จ
                    alert("Logout failed"); // แสดงข้อความแจ้งเตือน
                }
            });
        });
    });




    
    
import { BFormRating } from 'bootstrap-vue'

export default {
  components: {
    BFormRating
  },
  data() {
    return {
      value: null
    }
  }
}
</script>




</body>
</html>
