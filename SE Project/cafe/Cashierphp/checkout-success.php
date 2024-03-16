<?php
session_start();
include '../condb/database.php';

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
    <title>Result Order</title>
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