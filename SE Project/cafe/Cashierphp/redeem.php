<?php
session_start();
if (!isset($_SESSION['cashier_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
    header('Location:../signin_ep.php');
}
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
            </div>
            <h4 class="mb-3">Redeem</h4>
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Your cart</span>
                        <span class="badge bg-primary rounded-pill">0</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                            <div class="text-success">
                                <h6 class="my-0">Grand total</h6>
                                <small>amount</small>
                            </div>
                            <span class="text-success"><strong>฿0.00</strong></span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-7 col-lg-8">
                    <form action="redeem_2.php" class="needs-validation" novalidate method="post">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="" value="" required>
                            </div>
                        </div>
                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to redeem</button>
                    </form>
                </div>
            </div>
        </main>
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