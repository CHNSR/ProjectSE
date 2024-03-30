<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
include '../condb/database.php';

if (!isset($_SESSION['cus_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
    header('Location:../signin_cs.php');
}

$name = $_POST['product_name'];
$point_use = $_POST['point_use'];

$water_query = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_menuName = ('$name')");
$water_row = mysqli_num_rows($water_query);
if ($water_row >= 1) {
    $table = 'water_menu';
    $option = $_POST['product_hcb'];
    $where = 'w_menuName';
}

$dess_query = mysqli_query($conn, "SELECT * FROM dessert_menu WHERE dess_menuName = ('$name')");
$dess_row = mysqli_num_rows($dess_query);
if ($dess_row >= 1) {
    $table = 'dessert_menu';
    $where = 'dess_menuName';
}

$fruit_query = mysqli_query($conn, "SELECT * FROM fruit_menu WHERE fruit_menuName = ('$name')");
$fruit_row = mysqli_num_rows($fruit_query);
if ($fruit_row >= 1) {
    $table = 'fruit_menu';
    $where = 'fruit_menuName';
}

$cus_username = $_SESSION['cus_login'];
$point_query = "SELECT * FROM points WHERE p_customerName = '$cus_username' ";
$point_row = mysqli_query($conn, $point_query);
$point = mysqli_fetch_assoc($point_row);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/css_for_user/add_styles_for_user.css">
    <title>Point Use</title>
</head>

<body>
    <div class="nav">
        <div class="logo-container">
            <a href="#"><img src="../image/coffee-cup.png" class="logo" /></a>
            <h2>P E R T</h2>
        </div>
        <div class="links">
            <a href="Userinter.php">Menu</a>
            <a href="#"><i class="bi bi-coin"></i> <?php echo $point['p_pointTotal'] ?> Point</a>
            <a href="Information.php">Information</a>
            <button id="LogoutBtn"><i class="bi bi-check2-circle"></i> Log Out</button>
        </div>
    </div>
    <div class="container" style="margin-top: 30px;">
        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['message']); ?>
        <?php if ($table == 'water_menu') : ?>
            <div class="card mb-3 mx-auto" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="card-body">
                        <img src="../image/coffee-cup.png" alt="Logo" class="mx-auto d-block mb-4" style="max-width: 100px;">
                        <h5 class="card-title text-center"><?php echo $name ?></h5>
                        <hr>
                        <p class="card-text">Option : <?php echo $option ?></p>
                        <form action="../condb/exchange.php" method="post">
                            <input type="hidden" name="option" value="<?php echo $option ?>">
                            <input type="hidden" name="product_name" value="<?php echo $name ?>">
                            <div class="mb-4">
                                Point Use:
                                <input type="number" name="point_use" class="form form-control" value="<?php echo $point_use ?>" readonly>
                            </div>
                            <div class="mb-4">
                                Point Have:
                                <input type="number" name="point_have" class="form form-control" value="<?php echo $point['p_pointTotal'] ?>" readonly>
                                <small>*After redemption You can use your rights within 7 days.</small>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning"><i class="bi bi-check-circle-fill"></i> Confirm</button>
                                <a href="Userinter.php" class="btn btn-dark"><i class="bi bi-x-circle-fill"></i> Cancle</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($table == 'dessert_menu') : ?>
            <div class="card mb-3 mx-auto" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="card-body">
                        <img src="../image/coffee-cup.png" alt="Logo" class="mx-auto d-block mb-4" style="max-width: 100px;">
                        <h5 class="card-title text-center"><?php echo $name ?></h5>
                        <hr>
                        <form action="../condb/exchange.php" method="post">
                            <input type="hidden" name="product_name" value="<?php echo $name ?>">
                            <div class="mb-4">
                                Point Use:
                                <input type="number" name="point_use" class="form form-control" value="<?php echo $point_use ?>" readonly>
                            </div>
                            <div class="mb-4">
                                Point Have:
                                <input type="number" name="point_have" class="form form-control" value="<?php echo $point['p_pointTotal'] ?>" readonly>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning"><i class="bi bi-check-circle-fill"></i> Confirm</button>
                                <a href="Userinter.php" class="btn btn-dark"><i class="bi bi-x-circle-fill"></i> Cancle</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($table == 'fruit_menu') : ?>
            <div class="card mb-3 mx-auto" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="card-body">
                        <img src="../image/coffee-cup.png" alt="Logo" class="mx-auto d-block mb-4" style="max-width: 100px;">
                        <h5 class="card-title text-center"><?php echo $name ?></h5>
                        <hr>
                        <form action="../condb/exchange.php" method="post">
                            <input type="hidden" name="product_name" value="<?php echo $name ?>">
                            <div class="mb-4">
                                Point Use:
                                <input type="number" name="point_use" class="form form-control" value="<?php echo $point_use ?>" readonly>
                            </div>
                            <div class="mb-4">
                                Point Have:
                                <input type="number" name="point_have" class="form form-control" value="<?php echo $point['p_pointTotal'] ?>" readonly>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning"><i class="bi bi-check-circle-fill"></i> Confirm</button>
                                <a href="Userinter.php" class="btn btn-dark"><i class="bi bi-x-circle-fill"></i> Cancle</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script>
        // Add an event listener to the Log In button
        document.getElementById('LogoutBtn').addEventListener('click', function() {
            // Redirect to the login page or any other page you want
            window.location.href = '../condb/logout.php'; // Replace 'login.html' with the desired page
        });
    </script>
</body>

</html>