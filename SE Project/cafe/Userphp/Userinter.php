<?php
session_start();
include '../condb/database.php';

if (!isset($_SESSION['cus_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
    header('Location:../signin_cs.php');
}

$cof_query = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_watertype = 'coffee'");
$cof_row = mysqli_num_rows($cof_query);

$mil_query = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_watertype = 'milk'");
$mil_row = mysqli_num_rows($mil_query);

$tea_query = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_watertype = 'tea'");
$tea_row = mysqli_num_rows($tea_query);

$dess_query = mysqli_query($conn, "SELECT * FROM dessert_menu");
$dess_row = mysqli_num_rows($dess_query);

$fruit_query = mysqli_query($conn, "SELECT * FROM fruit_menu");
$fruit_row = mysqli_num_rows($fruit_query);

$cus_username = $_SESSION['cus_login'];
$point_query = "SELECT * FROM points WHERE p_customerName = '$cus_username' ";
$point_row = mysqli_query($conn, $point_query);
$point = mysqli_fetch_assoc($point_row);
$point_total = $point['p_pointTotal'];
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
            <a href="#"><i class="bi bi-coin"></i> <?php echo $point_total ?> Point</a>
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
        <br>
        <div class="row">
            <h4>Coffee</h4>
            <?php if ($cof_row > 0) : ?>
                <?php while ($water = mysqli_fetch_assoc($cof_query)) : ?>
                    <div class="col-3 mb-3">
                        <div class="card" style="width: 16rem;">
                            <?php if (!empty($water['w_picture'])) : ?>
                                <img src="../image/menu/Water/<?php echo $water['w_picture']; ?>" class="card-img-top" width="100" alt="Product Image">
                            <?php else : ?>
                                <img src="../image/error.png" class="card-img-top" width="100" alt="Product Image">
                            <?php endif; ?>
                            <div class="card-body">
                                <form action="redeem.php" method="post">
                                    <?php $rate = number_format($water['w_price'], 2) * 5 ?>
                                    <h5 class="card-title"><?php echo $water['w_menuName']; ?></h5>
                                    <p class="card-text text-muted mb-0">Option : <?php echo $water['w_HotColdBlended']; ?></p>
                                    <p class="card-text text-success fw-bold"><?php echo $rate; ?> Point</p>
                                    <input type="hidden" name="product_name" value="<?php echo $water['w_menuName']; ?>">
                                    <input type="hidden" name="product_hcb" value="<?php echo $water['w_HotColdBlended']; ?>">
                                    <input type="hidden" name="point_use" value="<?php echo $rate; ?>">
                                    <?php if($point_total < $rate): ?>
                                        <button type="submit" class="btn btn-dark w-100" disabled><i class="bi bi-credit-card-2-front"></i> Redeem</button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-dark w-100"><i class="bi bi-credit-card-2-front"></i> Redeem</button>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <diiv class="col-12">
                    <h4 class="text-danger">No product data</h4>
                </diiv>
            <?php endif; ?>
        </div>
        <div class="row">
            <h4>Milk</h4>
            <?php if ($mil_row > 0) : ?>
                <?php while ($water = mysqli_fetch_assoc($mil_query)) : ?>
                    <div class="col-3 mb-3">
                        <div class="card" style="width: 16rem;">
                            <?php if (!empty($water['w_picture'])) : ?>
                                <img src="../image/menu/water/<?php echo $water['w_picture']; ?>" class="card-img-top" width="100" alt="Product Image">
                            <?php else : ?>
                                <img src="../image/error.png" class="card-img-top" width="100" alt="Product Image">
                            <?php endif; ?>
                            <div class="card-body">
                                <form action="redeem.php" method="post">
                                    <?php $rate = number_format($water['w_price'], 2) * 5 ?>
                                    <h5 class="card-title"><?php echo $water['w_menuName']; ?></h5>
                                    <p class="card-text text-muted mb-0">Option : <?php echo $water['w_HotColdBlended']; ?></p>
                                    <p class="card-text text-success fw-bold"><?php echo $rate; ?> Point</p>
                                    <input type="hidden" name="product_name" value="<?php echo $water['w_menuName']; ?>">
                                    <input type="hidden" name="product_hcb" value="<?php echo $water['w_HotColdBlended']; ?>">
                                    <input type="hidden" name="point_use" value="<?php echo $rate; ?>">
                                    <?php if($point_total < $rate): ?>
                                        <button type="submit" class="btn btn-dark w-100" disabled><i class="bi bi-credit-card-2-front"></i> Redeem</button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-dark w-100"><i class="bi bi-credit-card-2-front"></i> Redeem</button>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <diiv class="col-12">
                    <h4 class="text-danger">No product data</h4>
                </diiv>
            <?php endif; ?>
        </div>
        <div class="row">
            <h4>Tea</h4>
            <?php if ($tea_row > 0) : ?>
                <?php while ($water = mysqli_fetch_assoc($tea_query)) : ?>
                    <div class="col-3 mb-3">
                        <div class="card" style="width: 16rem;">
                            <?php if (!empty($water['w_picture'])) : ?>
                                <img src="../image/menu/water/<?php echo $water['w_picture']; ?>" class="card-img-top" width="100" alt="Product Image">
                            <?php else : ?>
                                <img src="../image/error.png" class="card-img-top" width="100" alt="Product Image">
                            <?php endif; ?>
                            <div class="card-body">
                                <form action="redeem.php" method="post">
                                    <?php $rate = number_format($water['w_price'], 2) * 5 ?>
                                    <h5 class="card-title"><?php echo $water['w_menuName']; ?></h5>
                                    <p class="card-text text-muted mb-0">Option : <?php echo $water['w_HotColdBlended']; ?></p>
                                    <p class="card-text text-success fw-bold"><?php echo $rate; ?> Point</p>
                                    <input type="hidden" name="product_name" value="<?php echo $water['w_menuName']; ?>">
                                    <input type="hidden" name="product_hcb" value="<?php echo $water['w_HotColdBlended']; ?>">
                                    <input type="hidden" name="point_use" value="<?php echo $rate; ?>">
                                    <?php if($point_total < $rate): ?>
                                        <button type="submit" class="btn btn-dark w-100" disabled><i class="bi bi-credit-card-2-front"></i> Redeem</button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-dark w-100"><i class="bi bi-credit-card-2-front"></i> Redeem</button>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <diiv class="col-12">
                    <h4 class="text-danger">No product data</h4>
                </diiv>
            <?php endif; ?>
        </div>
        <div class="row">
            <h4>Dessert</h4>
            <?php if ($dess_row > 0) : ?>
                <?php while ($dessert = mysqli_fetch_assoc($dess_query)) : ?>
                    <div class="col-3 mb-3">
                        <div class="card" style="width: 16rem;">
                            <?php if (!empty($dessert['dess_picture'])) : ?>
                                <img src="../image/menu/Dessert/<?php echo $dessert['dess_picture']; ?>" class="card-img-top" width="100" alt="Product Image">
                            <?php else : ?>
                                <img src="../image/error.png" class="card-img-top" width="100" alt="Product Image">
                            <?php endif; ?>
                            <div class="card-body">
                                <form action="redeem.php" method="post">
                                    <?php $rate = number_format($dessert['dess_price'], 2) * 5 ?>
                                    <h5 class="card-title"><?php echo $dessert['dess_menuName']; ?></h5>
                                    <p class="card-text text-muted mb-0">Stock : <?php echo $dessert['dess_quantity']; ?></p>
                                    <p class="card-text text-success fw-bold"><?php echo $rate; ?> Point</p>
                                    <input type="hidden" name="product_name" value="<?php echo $dessert['dess_menuName']; ?>">
                                    <input type="hidden" name="point_use" value="<?php echo $rate; ?>">
                                    <?php if($point_total < $rate or $dessert['dess_quantity'] == 0): ?>
                                        <button type="submit" class="btn btn-dark w-100" disabled><i class="bi bi-credit-card-2-front"></i> Redeem</button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-dark w-100"><i class="bi bi-credit-card-2-front"></i> Redeem</button>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <diiv class="col-12">
                    <h4 class="text-danger">No product data</h4>
                </diiv>
            <?php endif; ?>
        </div>
        <div class="row">
            <h4>Fruit</h4>
            <?php if ($fruit_row > 0) : ?>
                <?php while ($fruit = mysqli_fetch_assoc($fruit_query)) : ?>
                    <div class="col-3 mb-3">
                        <div class="card" style="width: 16rem;">
                            <?php if (!empty($fruit['fruit_picture'])) : ?>
                                <img src="../image/menu/Fruit/<?php echo $fruit['fruit_picture']; ?>" class="card-img-top" width="100" alt="Product Image">
                            <?php else : ?>
                                <img src="../image/error.png" class="card-img-top" width="100" alt="Product Image">
                            <?php endif; ?>
                            <div class="card-body">
                                <form action="redeem.php" method="post">
                                    <?php $rate = number_format($fruit['fruit_price'], 2) * 5 ?>
                                    <h5 class="card-title"><?php echo $fruit['fruit_menuName']; ?></h5>
                                    <p class="card-text text-muted mb-0">Stock : <?php echo $fruit['fruit_quantity']; ?></p>
                                    <p class="card-text text-success fw-bold"><?php echo $rate; ?> Point</p>
                                    <input type="hidden" name="product_name" value="<?php echo $fruit['fruit_menuName']; ?>">
                                    <input type="hidden" name="point_use" value="<?php echo $rate; ?>">
                                    <?php if($point_total < $rate or $fruit['fruit_quantity'] == 0): ?>
                                        <button type="submit" class="btn btn-dark w-100" disabled><i class="bi bi-credit-card-2-front"></i> Redeem</button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-dark w-100"><i class="bi bi-credit-card-2-front"></i> Redeem</button>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <diiv class="col-12">
                    <h4 class="text-danger">No product data</h4>
                </diiv>
            <?php endif; ?>
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