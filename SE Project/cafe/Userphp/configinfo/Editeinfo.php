<?php
// Start the session
session_start();

require_once '../../condb/database.php';

if (!isset($_SESSION['cus_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
    header('Location:../signin_cs.php');
} else {
    $cus_username = $_SESSION['cus_login'];
    $sql_cus = "SELECT * FROM customer WHERE cus_username = '$cus_username' ";
    $result = mysqli_query($conn, $sql_cus);
    $row = mysqli_fetch_assoc($result);

    $cus_firstname = $row['cus_firstname'];
    $cus_lastname = $row['cus_lastname'];
    $cus_phone_number = $row['cus_phoneNumber'];
    $cus_gender = $row['cus_gender'];
    $cus_birthday = $row['cus_birthday'];
    $cus_email = $row['cus_email'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- อย่าลืมเปลี่ยน paht เวลาย้ายไฟล์ -->
    <link rel="stylesheet" href="../../css/add_styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- อย่าลืมเปลี่ยน paht เวลาย้ายไฟล์ -->
    <link rel="stylesheet" href="../../css/infor_styles.css"> <!-- Include your CSS file -->
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
            <a href="../Userinter.php">Menu</a>
            <a href="../Information.php">Information</a>
            <button id="LogoutBtn"><i class="bi bi-check2-circle"></i> Log Out</button>
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
                            <form action="../../condb/user_inforupdate.php" method="post">

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="text" name="firstName" class="form-control" value="<?php echo $cus_firstname ?>">
                                            <label class="form-label" for="firstName">First Name</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="text" name="lastName" class="form-control" value="<?php echo $cus_lastname ?>">
                                            <label class="form-label" for="lastName">Last Name</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline datepicker w-100">
                                            <input type="date" class="form-control" name="birthdayDate" id="birthdayDate" value="<?php echo $cus_birthday ?>" required>
                                            <label for="birthdayDate" class="form-label">Birthday</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <select class="form-select" name="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <h6 class="mb-2 pb-1">Gender: </h6>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="email" name="email" class="form-control" value="<?php echo $cus_email ?>">
                                            <label class="form-label" for="email">Email</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input type="text" class="form-control" name="phoneNumber" pattern="\d{3}-\d{3}-\d{4}" minlength="12" maxlength="12" oninput="formatPhoneNumber(this)" value="<?php echo $cus_phone_number ?>" required>
                                            <label class="form-label" for="phoneNumber">Phone Number</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="mt-4 pt-2 text-center">
                                    <input class="btn btn-success btn-lg" type="submit" value="Update">
                                    <input type="reset" class="btn btn-danger btn-lg" value="Clear Form">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Add an event listener to the Log In button
        document.getElementById('LogoutBtn').addEventListener('click', function() {
            // Redirect to the login page or any other page you want
            window.location.href = '../../condb/logout.php'; // Replace 'login.html' with the desired page
        });

        function formatPhoneNumber(input) {
            // Remove non-numeric characters from the input value
            var phoneNumber = input.value.replace(/\D/g, '');

            // Format the phone number as xxx-xxx-xxxx
            if (phoneNumber.length === 10) {
                var formattedNumber = phoneNumber.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
                input.value = formattedNumber;
            }
        }
    </script>
</body>

</html>