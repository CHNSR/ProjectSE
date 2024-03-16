<?php
session_start();
include '../condb/database.php';

if (!isset($_SESSION['cashier_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
    header('Location:../signin_ep.php');
}

$productNames = [];
foreach (($_SESSION['cart'] ?? []) as $cartName => $cartQty) {
    $productNames[] = mysqli_real_escape_string($conn, $cartName);
}
$names = "'" . implode("','", $productNames) . "'";

$cof_query = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_waterType = 'coffee' AND w_menuName IN ($names)");
$cof_row = mysqli_num_rows($cof_query);

$mil_query = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_waterType = 'milk' AND w_menuName IN ($names)");
$mil_row = mysqli_num_rows($mil_query);

$tea_query = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_waterType = 'tea' AND w_menuName IN ($names)");
$tea_row = mysqli_num_rows($tea_query);

$dess_query = mysqli_query($conn, "SELECT * FROM dessert_menu WHERE dess_menuName IN ($names)");
$dess_row = mysqli_num_rows($dess_query);

$fruit_query = mysqli_query($conn, "SELECT * FROM fruit_menu WHERE fruit_menuName IN ($names)");
$fruit_row = mysqli_num_rows($fruit_query);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/css_for_cashier/cashier_styles.css">
    <title>Order Checkout</title>
</head>

<body class="bg-light">

    <div class="container">
        <main>
            <div class="nav">
                <div class="logo-container">
                    <a href="#"><img src="../image/coffee-cup.png" class="logo" /></a>
                    <h2>P E R T</h2>
                </div>
                <div class="links">
                    <a href="index.php">Menu</a>
                    <a href="redeem.php">Redeem</a>
                    <a href="cart.php">Cart (<?php echo count($_SESSION['cart'] ?? []) ?>) </a>
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

                <h4 class="mb-3">Check out</h4>
                <form action="../condb/checkout-form.php" method="post">
                    <div class="row g-5">
                        <div class="col-md-5 col-lg-4 order-md-last">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary">Your cart</span>
                                <span class="badge bg-primary rounded-pill"><?php echo ($cof_row + $mil_row + $tea_row + $dess_row + $fruit_row); ?></span>
                            </h4>
                            <?php $grand_total = 0; ?>
                            <?php if ($cof_row > 0) : ?>
                                <h4>Coffee</h4>
                                <ul class="list-group mb-3">
                                    <?php while ($water = mysqli_fetch_assoc($cof_query)) : ?>
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0"><?php echo $water['w_menuName']; ?>(<?php echo $_SESSION['cart'][$water['w_menuName']]; ?>) - <?php echo $water['w_HotColdBlended']; ?></h6>
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][id]" value="<?php echo $water['w_menuID']; ?>">
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][price]" value="<?php echo $water['w_price']; ?>">
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][name]" value="<?php echo $water['w_menuName']; ?>">
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][hcb]" value="<?php echo $water['w_HotColdBlended']; ?>">
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][type]" value="<?php echo $water['w_waterType']; ?>">
                                            </div>
                                            <span class="text-body-secondary">฿<?php echo number_format($_SESSION['cart'][$water['w_menuName']] * $water['w_price'], 2); ?></span>
                                        </li>
                                        <?php $grand_total += $_SESSION['cart'][$water['w_menuName']] * $water['w_price']; ?>
                                    <?php endwhile; ?>
                                </ul>

                            <?php endif; ?>
                            <?php if ($mil_row > 0) : ?>
                                <h4>Milk</h4>
                                <ul class="list-group mb-3">
                                    <?php while ($water = mysqli_fetch_assoc($mil_query)) : ?>
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0"><?php echo $water['w_menuName']; ?>(<?php echo $_SESSION['cart'][$water['w_menuName']]; ?>) - <?php echo $water['w_HotColdBlended']; ?></h6>
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][id]" value="<?php echo $water['w_menuID']; ?>">
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][price]" value="<?php echo $water['w_price']; ?>">
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][name]" value="<?php echo $water['w_menuName']; ?>">
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][hcb]" value="<?php echo $water['w_HotColdBlended']; ?>">
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][type]" value="<?php echo $water['w_waterType']; ?>">
                                            </div>
                                            <span class="text-body-secondary">฿<?php echo number_format($_SESSION['cart'][$water['w_menuName']] * $water['w_price'], 2); ?></span>
                                        </li>
                                        <?php $grand_total += $_SESSION['cart'][$water['w_menuName']] * $water['w_price']; ?>
                                    <?php endwhile; ?>
                                </ul>

                            <?php endif; ?>
                            <?php if ($tea_row > 0) : ?>
                                <h4>Tea</h4>
                                <ul class="list-group mb-3">
                                    <?php while ($water = mysqli_fetch_assoc($tea_query)) : ?>
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0"><?php echo $water['w_menuName']; ?>(<?php echo $_SESSION['cart'][$water['w_menuName']]; ?>) - <?php echo $water['w_HotColdBlended']; ?></h6>
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][id]" value="<?php echo $water['w_menuID']; ?>">
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][price]" value="<?php echo $water['w_price']; ?>">
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][name]" value="<?php echo $water['w_menuName']; ?>">
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][hcb]" value="<?php echo $water['w_HotColdBlended']; ?>">
                                                <input type="hidden" name="product[<?php echo $water['w_menuName']; ?>][type]" value="<?php echo $water['w_waterType']; ?>">
                                            </div>
                                            <span class="text-body-secondary">฿<?php echo number_format($_SESSION['cart'][$water['w_menuName']] * $water['w_price'], 2); ?></span>
                                        </li>
                                        <?php $grand_total += $_SESSION['cart'][$water['w_menuName']] * $water['w_price']; ?>
                                    <?php endwhile; ?>
                                </ul>

                            <?php endif; ?>
                            <?php if ($dess_row > 0) : ?>
                                <h4>Dessert</h4>
                                <ul class="list-group mb-3">
                                    <?php while ($dessert = mysqli_fetch_assoc($dess_query)) : ?>
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0"><?php echo $dessert['dess_menuName']; ?>(<?php echo $_SESSION['cart'][$dessert['dess_menuName']]; ?>)</h6>
                                                <input type="hidden" name="product[<?php echo $dessert['dess_menuName']; ?>][id]" value="<?php echo $dessert['dess_menuID']; ?>">
                                                <input type="hidden" name="product[<?php echo $dessert['dess_menuName']; ?>][price]" value="<?php echo $dessert['dess_price']; ?>">
                                                <input type="hidden" name="product[<?php echo $dessert['dess_menuName']; ?>][name]" value="<?php echo $dessert['dess_menuName']; ?>">
                                                <input type="hidden" name="product[<?php echo $dessert['dess_menuName']; ?>][quantity]" value="<?php echo $_SESSION['cart'][$dessert['dess_menuName']];?>">
                                                <input type="hidden" name="product[<?php echo $dessert['dess_menuName']; ?>][type]" value="dessert">
                                            </div>
                                            <span class="text-body-secondary">฿<?php echo number_format($_SESSION['cart'][$dessert['dess_menuName']] * $dessert['dess_price'], 2); ?></span>
                                        </li>
                                        <?php $grand_total += $_SESSION['cart'][$dessert['dess_menuName']] * $dessert['dess_price']; ?>
                                    <?php endwhile; ?>
                                </ul>

                            <?php endif; ?>
                            <?php if ($fruit_row > 0) : ?>
                                <h4>Fruit</h4>
                                <ul class="list-group mb-3">
                                    <?php while ($fruit = mysqli_fetch_assoc($fruit_query)) : ?>
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0"><?php echo $fruit['fruit_menuName']; ?>(<?php echo $_SESSION['cart'][$fruit['fruit_menuName']]; ?>)</h6>
                                                <input type="hidden" name="product[<?php echo $fruit['fruit_menuName']; ?>][id]" value="<?php echo $fruit['fruit_menuID']; ?>">
                                                <input type="hidden" name="product[<?php echo $fruit['fruit_menuName']; ?>][price]" value="<?php echo $fruit['fruit_price']; ?>">
                                                <input type="hidden" name="product[<?php echo $fruit['fruit_menuName']; ?>][name]" value="<?php echo $fruit['fruit_menuName']; ?>">
                                                <input type="hidden" name="product[<?php echo $fruit['fruit_menuName']; ?>][quantity]" value="<?php echo $_SESSION['cart'][$fruit['fruit_menuName']];?>">
                                                <input type="hidden" name="product[<?php echo $fruit['fruit_menuName']; ?>][type]" value="fruit">
                                            </div>
                                            <span class="text-body-secondary">฿<?php echo number_format($_SESSION['cart'][$fruit['fruit_menuName']] * $fruit['fruit_price'], 2); ?></span>
                                        </li>
                                        <?php $grand_total += $_SESSION['cart'][$fruit['fruit_menuName']] * $fruit['fruit_price']; ?>
                                    <?php endwhile; ?>
                                </ul>

                            <?php endif; ?>
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                                    <div class="text-success">
                                        <h6 class="my-0">Grand total</h6>
                                        <small>amount</small>
                                    </div>
                                    <span class="text-success"><strong>฿<?php echo number_format($grand_total, 2); ?></strong></span>
                                </li>
                            </ul>
                            <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">
                        </div>
                        <div class="col-md-7 col-lg-8">
                            <form action="../condb/checkout-form.php" class="needs-validation" novalidate method="post">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="">
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                    <hr class="my-4">

                                    <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                            </form>
                        </div>
                    </div>
                </form>
        </main>
    </div>


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="form-validation.js"></script>
    <script>
        // Add an event listener to the Log In button
        document.getElementById('LogoutBtn').addEventListener('click', function() {
            // Redirect to the login page or any other page you want
            window.location.href = '../condb/logout.php'; // Replace 'login.html' with the desired page
        });
    </script>
</body>

</html>