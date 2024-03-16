<?php
session_start();
include '../condb/database.php';
if (!isset($_SESSION['barista_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
    header('Location:../signin_ep.php');
}

$cof_query = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_waterType = 'coffee'");
$cof_row = mysqli_num_rows($cof_query);

$mil_query = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_waterType = 'milk'");
$mil_row = mysqli_num_rows($mil_query);

$tea_query = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_waterType = 'tea'");
$tea_row = mysqli_num_rows($tea_query);

$dess_query = mysqli_query($conn, "SELECT * FROM dessert_menu");
$dess_row = mysqli_num_rows($dess_query);

$fruit_query = mysqli_query($conn, "SELECT * FROM fruit_menu");
$fruit_row = mysqli_num_rows($fruit_query);

$order_query = mysqli_query($conn, "SELECT * FROM order_detail WHERE ord_status = 'wait'");
$order_row = mysqli_num_rows($order_query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/css_for_baristar/barista_styles.css">
    <title>Menu</title>
</head>

<body>
    <div class="nav">
        <div class="logo-container">
            <a href="#"><img src="../image/coffee-cup.png" class="logo" /></a>
            <h2>P E R T</h2>
        </div>
        <div class="links">
            <a href="#">coming soon</a>
            <a href="#">coming soon</a>
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
    </div>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if ($order_row > 0) : ?>
                    <?php while ($order = mysqli_fetch_assoc($order_query)) : ?>
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $order['ord_productName'] ?> - <?php echo $order['ord_option'] ?></h5>
                                        <?php $name = $order['ord_productName'] ?>
                                        <?php $option = $order['ord_option'] ?>
                                        <?php $query = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_menuName = '{$name}' AND w_HotColdBlended = '{$option}'"); ?>
                                        <?php $water_row = mysqli_num_rows($query); ?>
                                        <?php if ($water_row > 0) : ?>
                                            <?php while ($water = mysqli_fetch_assoc($query)) : ?>
                                                <?php $ID = $water['w_menuID']; ?>
                                                <?php $recipe_query = mysqli_query($conn, "SELECT * FROM recipe_of_water WHERE rec_menuID = '{$ID}'") ?>
                                                <?php while ($recipe = mysqli_fetch_assoc($recipe_query)) : ?>
                                                    <p class="card-text"><?php echo $recipe['rec_description'] ?></p>
                                                <?php endwhile; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                        <div class="text-end"> <!-- Added wrapper div with text-start class -->
                                            <a href="../condb/order_cancle.php?id=<?php echo $order['ord_detailID']; ?>" class="btn btn-dark"><i class="bi bi-trash3"></i></a>
                                            <a href="../condb/order_success.php?id=<?php echo $order['ord_detailID']; ?>" class="btn btn-success"><i class="bi bi-check-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
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