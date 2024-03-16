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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/css_for_cashier/cashier_styles.css">
    <title>Cart</title>
</head>

<body>
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
        <br>
        <form action="../condb/cart-update.php" method="post">
            <div>
                <tr>
                    <td colspan="7" class="text-end">
                        <button type="submit" class="btn btn-lg btn-success"><i class="bi bi-arrow-down-up"></i> Update cart</button>
                        <a href="checkout.php" class="btn btn-lg btn-primary"><i class="bi bi-box-arrow-right"></i> Checkout Order</a>
                    </td>
                </tr>
            </div>
            <br>
            <div class="row">
                <h4>Coffee</h4>
                <div class="col-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Image</th>
                                <th>Product Name</th>
                                <th style="width: 200px;">Option</th>
                                <th style="width: 100px;">Price</th>
                                <th style="width: 100px;">Quantity</th>
                                <th style="width: 200px;">Total</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($cof_row > 0) : ?>
                                <?php while ($water = mysqli_fetch_assoc($cof_query)) : ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($water['w_picture'])) : ?>
                                                <img src="../image/menu/Water/<?php echo $water['w_picture']; ?>" width="100" alt="Product Image">
                                            <?php else : ?>
                                                <img src="../image/error.png" width="100" alt="Product Image">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $water['w_menuName']; ?> </td>
                                        <td>
                                            <?php echo $water['w_HotColdBlended']; ?> </td>
                                        </td>
                                        <td><?php echo number_format($water['w_price'], 2); ?> </td>
                                        <td><input type="number" name="product[<?php echo $water['w_menuName']; ?>][quantity]]" value="<?php echo $_SESSION['cart'][$water['w_menuName']]; ?>" class="form-control"></td>
                                        <td><?php echo number_format($water['w_price'] * $_SESSION['cart'][$water['w_menuName']], 2) ?></td>
                                        <td>
                                            <a onclick="return confirm('Are you sure you want to deleat');" role="button" href="../condb/cart_delete.php?id=<?php echo $water['w_menuName']; ?>" class="btn btn-outline-danger"><i class="bi bi-cart-dash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>

                            <?php else : ?>
                                <td colspan="7">
                                    <h4 class="text-center text-danger">No Product Data in cart</h4>
                                </td>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="row">
                <h4>Milk</h4>
                <div class="col-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Image</th>
                                <th>Product Name</th>
                                <th style="width: 200px;">Option</th>
                                <th style="width: 100px;">Price</th>
                                <th style="width: 100px;">Quantity</th>
                                <th style="width: 200px;">Total</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($mil_row > 0) : ?>
                                <?php while ($water = mysqli_fetch_assoc($mil_query)) : ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($water['w_picture'])) : ?>
                                                <img src="../image/menu/Water/<?php echo $water['w_picture']; ?>" width="100" alt="Product Image">
                                            <?php else : ?>
                                                <img src="../image/error.png" width="100" alt="Product Image">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $water['w_menuName']; ?> </td>
                                        <td>
                                            <?php echo $water['w_HotColdBlended']; ?> </td>
                                        </td>
                                        <td><?php echo number_format($water['w_price'], 2); ?> </td>
                                        <td><input type="number" name="product[<?php echo $water['w_menuName']; ?>][quantity]]" value="<?php echo $_SESSION['cart'][$water['w_menuName']]; ?>" class="form-control"></td>
                                        <td><?php echo number_format($water['w_price'] * $_SESSION['cart'][$water['w_menuName']], 2) ?></td>
                                        <td>
                                            <a onclick="return confirm('Are you sure you want to deleat');" role="button" href="../condb/cart_delete.php?id=<?php echo $water['w_menuName']; ?>" class="btn btn-outline-danger"><i class="bi bi-cart-dash"></i></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <td colspan="7">
                                    <h4 class="text-center text-danger">No Product Data</h4>
                                </td>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <h4>Tea</h4>
                <div class="col-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Image</th>
                                <th>Product Name</th>
                                <th style="width: 200px;">Option</th>
                                <th style="width: 100px;">Price</th>
                                <th style="width: 100px;">Quantity</th>
                                <th style="width: 200px;">Total</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($tea_row > 0) : ?>
                                <?php while ($water = mysqli_fetch_assoc($tea_query)) : ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($water['w_picture'])) : ?>
                                                <img src="../image/menu/Water/<?php echo $water['w_picture']; ?>" width="100" alt="Product Image">
                                            <?php else : ?>
                                                <img src="../image/error.png" width="100" alt="Product Image">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $water['w_menuName']; ?> </td>
                                        <td>
                                            <?php echo $water['w_HotColdBlended']; ?> </td>
                                        </td>
                                        <td><?php echo number_format($water['w_price'], 2); ?> </td>
                                        <td><input type="number" name="product[<?php echo $water['w_menuName']; ?>][quantity]]" value="<?php echo $_SESSION['cart'][$water['w_menuName']]; ?>" class="form-control"></td>
                                        <td><?php echo number_format($water['w_price'] * $_SESSION['cart'][$water['w_menuName']], 2) ?></td>
                                        <td>
                                            <a onclick="return confirm('Are you sure you want to deleat');" role="button" href="../condb/cart_delete.php?id=<?php echo $water['w_menuName']; ?>" class="btn btn-outline-danger"><i class="bi bi-cart-dash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <td colspan="7">
                                    <h4 class="text-center text-danger">No Product Data</h4>
                                </td>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <h4>Dessert</h4>
                <div class="col-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Image</th>
                                <th>Product Name</th>
                                <th style="width: 100px;">Price</th>
                                <th style="width: 200px;">Quantity</th>
                                <th style="width: 200px;">Total</th>
                                <th style="width: 200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($dess_row > 0) : ?>
                                <?php while ($dessert = mysqli_fetch_assoc($dess_query)) : ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($dessert['dess_picture'])) : ?>
                                                <img src="../image/menu/Dessert/<?php echo $dessert['dess_picture']; ?>" width="100" alt="Product Image">
                                            <?php else : ?>
                                                <img src="../image/error.png" width="100" alt="Product Image">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $dessert['dess_menuName']; ?> </td>
                                        <td><?php echo number_format($dessert['dess_price'], 2); ?> </td>
                                        <td><input type="number" name="product[<?php echo $dessert['dess_menuName']; ?>][quantity]]" value="<?php echo $_SESSION['cart'][$dessert['dess_menuName']]; ?>" class="form-control"></td>
                                        <td><?php echo number_format($dessert['dess_price'] * $_SESSION['cart'][$dessert['dess_menuName']], 2) ?></td>
                                        <td>
                                            <a onclick="return confirm('Are you sure you want to deleat');" role="button" href="../condb/cart_delete.php?id=<?php echo $dessert['dess_menuName']; ?>" class="btn btn-outline-danger"><i class="bi bi-cart-dash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <td colspan="6">
                                    <h4 class="text-center text-danger">No Product Data</h4>
                                </td>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <h4>Fruit</h4>
                <div class="col-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Image</th>
                                <th>Product Name</th>
                                <th style="width: 100px;">Price</th>
                                <th style="width: 200px;">Quantity</th>
                                <th style="width: 200px;">Total</th>
                                <th style="width: 200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($fruit_row > 0) : ?>
                                <?php while ($fruit = mysqli_fetch_assoc($fruit_query)) : ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($fruit['fruit_picture'])) : ?>
                                                <img src="../image/menu/Fruit/<?php echo $fruit['fruit_picture']; ?>" width="100" alt="Product Image">
                                            <?php else : ?>
                                                <img src="../image/error.png" width="100" alt="Product Image">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $fruit['fruit_menuName']; ?> </td>
                                        <td><?php echo number_format($fruit['fruit_price'], 2); ?> </td>
                                        <td><input type="number" name="product[<?php echo $fruit['fruit_menuName']; ?>][quantity]]" value="<?php echo $_SESSION['cart'][$fruit['fruit_menuName']]; ?>" class="form-control"></td>
                                        <td><?php echo number_format($fruit['fruit_price'] * $_SESSION['cart'][$fruit['fruit_menuName']], 2) ?></td>
                                        <td>
                                            <a onclick="return confirm('Are you sure you want to deleat');" role="button" href="../condb/cart_delete.php?id=<?php echo $fruit['fruit_menuName']; ?>" class="btn btn-outline-danger"><i class="bi bi-cart-dash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <td colspan="6">
                                    <h4 class="text-center text-danger">No Product Data</h4>
                                </td>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
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