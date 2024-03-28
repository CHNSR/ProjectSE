<?php
// Start the session
session_start();

require_once '../condb/database.php';



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

$point_query = "SELECT * FROM points WHERE p_customerName = '$cus_username' ";
$point_row = mysqli_query($conn, $point_query);
$point = mysqli_fetch_assoc($point_row);
$point_total = $point['p_pointTotal'];

// เมื่อมีการส่งข้อมูลลบผ่านฟอร์ม
if (isset($_POST['delete'])) {
    // ดำเนินการลบข้อมูลที่เกี่ยวข้องออกจากฐานข้อมูล
    // ตัวอย่างเช่น
    $sql_delete = "DELETE FROM customer WHERE cus_username='$cus_username'";

    if (mysqli_query($conn, $sql_delete)) {
        echo "Records were deleted successfully.";
        // หลังจากลบข้อมูลแล้ว สามารถทำการ redirect หน้าไปยังหน้าที่ต้องการได้
    } else {
        echo "ERROR: Could not able to execute $sql_delete. " . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css_for_user/add_styles_for_user.css">
    <link rel="stylesheet" href="../css/css_for_user/infor_styles.css"> <!-- Include your CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #f6d365;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }
    </style>

</head>


<body>

    <div class="nav">
        <div class="logo-container">
            <a href="#"><img src="../image/coffee-cup.png" class="logo" /></a>
            <h2>P E R T</h2>
        </div>
        <div class="links">
            <a href="Userinter.php">Menu</a>
            <a href="#"><i class="bi bi-coin"></i> <?php echo $point_total ?> Point</a>
            <a href="Information.php">Information</a>
            <button id="LogoutBtn"><i class="bi bi-check2-circle"></i> Log Out</button>
        </div>
    </div>
    <section class="vh-100" style="background-color: #f4f5f7;">
        <div class="container py-5 h-100">
            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php unset($_SESSION['message']); ?>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-8 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="../image/user.png" alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                                <h5><?php echo $cus_firstname . '&nbsp;' . $cus_lastname; ?></h5>
                                <p>P E R T Customer</p>
                                <i class="far fa-edit mb-5"></i>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h5>Information</h5>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Username</h6>
                                            <p class="text-muted"><?php echo $cus_username; ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Phone</h6>
                                            <p class="text-muted"><?php echo $cus_phone_number ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Gender</h6>
                                            <p class="text-muted"><?php echo $cus_gender ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Birthday</h6>
                                            <p class="text-muted"><?php echo $cus_birthday ?></p>
                                        </div>
                                        <div class="col-8 mb-3">
                                            <h6>E-mail</h6>
                                            <p class="text-muted"><?php echo $cus_email ?></p>
                                        </div>
                                    </div>
                                    <h5>Point</h5>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            
                                            <h6>total point</h6>
                                            <p class="text-muted"><?php echo $point_total ?></p>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-start">

                                        <button type="button" class="btn btn-warning" data-mdb-ripple-init id="ConfigInfo">Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Edite info Button Script-->
    <script>
        document.getElementById('ConfigInfo').addEventListener('click', function() {
            // Redirect to the login page or any other page you want
            window.location.href = 'configinfo/Editeinfo.php'; // Replace 'login.html' with the desired page
        });

        // Add an event listener to the Log In button
        document.getElementById('LogoutBtn').addEventListener('click', function() {
            // Redirect to the login page or any other page you want
            window.location.href = '../condb/logout.php'; // Replace 'login.html' with the desired page
        });
    </script>

    <!-- เพิ่มไลบรารี jQuery ถ้ายังไม่ได้ใช้งาน -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</body>

</html>