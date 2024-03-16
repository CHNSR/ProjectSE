<?php
// Start the session
session_start();

require_once '../../condb/database.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- อย่าลืมเปลี่ยน paht เวลาย้ายไฟล์ -->
    <link rel="stylesheet" href="../../css/css_for_user/add_styles_for_user.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>P E R T</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- อย่าลืมเปลี่ยน paht เวลาย้ายไฟล์ -->
    <link rel="stylesheet" href="../../css/css_for_user/infor_styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    
    
</head>


<body>
    
    <div class="nav">
        <div class="logo-container">
            <!-- อย่าลืมเปลี่ยน paht เวลาย้ายไฟล์ -->
            <a href="#"><img src="../../image/coffee-cup.png" class="logo" /></a>
            <h2>P E R T</h2>
        </div>
        <div class="links">
            <a href="../../Userinter.php">Menu</a>
            <a href="../Information.php">Information</a>
            <a href="../Point.php">point</a>
            
            <button type="button" name="logoutBT" id="logoutBT">Logout</button>

        </div>
    </div>


    <!-- Form Edite info -->
    <section class="vh-100 gradient-custom">
        <div class="container py-15 h-100">
            <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Edite information</h3>
                    <form>

                    <div class="row">
                        <div class="col-md-6 mb-4">

                        <div class="form-outline">
                            <input type="text" id="firstName" class="form-control form-control-lg" />
                            <label class="form-label" for="firstName">First Name</label>
                        </div>

                        </div>
                        <div class="col-md-6 mb-4">

                        <div class="form-outline">
                            <input type="text" id="lastName" class="form-control form-control-lg" />
                            <label class="form-label" for="lastName">Last Name</label>
                        </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4 d-flex align-items-center">

                        <div class="form-outline datepicker w-100">
                            <input type="text" class="form-control form-control-lg" id="birthdayDate" />
                            <label for="birthdayDate" class="form-label">Birthday</label>
                        </div>

                        </div>
                        <div class="col-md-6 mb-4">

                        <h6 class="mb-2 pb-1">Gender: </h6>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender"
                            value="option1" checked />
                            <label class="form-check-label" for="femaleGender">Female</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender"
                            value="option2" />
                            <label class="form-check-label" for="maleGender">Male</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="otherGender"
                            value="option3" />
                            <label class="form-check-label" for="otherGender">Other</label>
                        </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4 pb-2">

                        <div class="form-outline">
                            <input type="email" id="emailAddress" class="form-control form-control-lg" />
                            <label class="form-label" for="emailAddress">Email</label>
                        </div>

                        </div>
                        <div class="col-md-6 mb-4 pb-2">

                        <div class="form-outline">
                            <input type="tel" id="phoneNumber" class="form-control form-control-lg" />
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                        </div>

                        </div>
                    </div>



                    <div class="mt-4 pt-2">
                        <input class="btn btn-success btn-lg" type="submit" value="Update" />
                        <input class="btn btn-danger btn-lg" type="reset" value="Clear Form" />

                        
                    </div>

                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
</section>
        

<!-- human error form -->$_COOKIE<script>
    function validateForm() {
        var firstName = document.getElementById("firstName").value;
        var lastName = document.getElementById("lastName").value;
        var emailAddress = document.getElementById("emailAddress").value;
        var phoneNumber = document.getElementById("phoneNumber").value;
        if (firstName.trim() == "" || lastName.trim() == "" || emailAddress.trim() == "" || phoneNumber.trim() == "") {
            alert("Please fill in all fields");
            return false;
        }
        if (firstName.trim() == "") {
            alert("Please enter your first name");
            return false;
        }

        if (lastName.trim() == "") {
            alert("Please enter your last name");
            return false;
        }

        if (emailAddress.trim() == "") {
            alert("Please enter your email address");
            return false;
        }

        // ตรวจสอบรูปแบบของอีเมล
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailAddress)) {
            alert("Please enter a valid email address");
            return false;
        }

        if (phoneNumber.trim() == "") {
            alert("Please enter your phone number");
            return false;
        }

        // ตรวจสอบรูปแบบของหมายเลขโทรศัพท์
        var phonePattern = /^\d{10}$/;
        if (!phonePattern.test(phoneNumber)) {
            alert("Please enter a valid 10-digit phone number");
            return false;
        }

        // ตรวจสอบข้อมูลที่ไม่ถูกต้อง และแสดงข้อความแจ้งเตือน
        // ...
        
        return true;
    }

        

       
    
</script>

<form onsubmit="return validateForm()">
    <!-- รายละเอียดของฟอร์ม -->
</form>






        




    











<!-- เพิ่มไลบรารี jQuery ถ้ายังไม่ได้ใช้งาน -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
    // เมื่อคลิกที่ปุ่ม "Logout"
    $("#logoutBT").click(function(){
        // สร้าง AJAX request
        $.ajax({
            url: "../../condb/logout.php", // แก้ไข URL เพื่อให้ชี้ไปที่ไฟล์ logout.php ให้ถูกต้อง
            type: "GET", // กำหนดเป็นเมธอด GET
            success: function(data){
                // หากการ request สำเร็จ
                alert("Logout successful"); // แสดงข้อความแจ้งเตือน
                window.location.href = "../../index.php"; // redirect ไปยังหน้า index.php
            },
            error: function(){
                // หากการ request ไม่สำเร็จ
                alert("Logout failed"); // แสดงข้อความแจ้งเตือน
            }
        });
    });
});
</script>



</body>
</html>