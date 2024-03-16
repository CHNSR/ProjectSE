<?php
session_start();
include '../condb/database.php';

if (!isset($_SESSION['manager_login'])) {
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/css_for_manager/manager_styles.css">
    <title>Menu</title>
</head>

<body>
    <div class="nav">
        <div class="logo-container">
            <a href="#"><img src="../image/coffee-cup.png" class="logo" /></a>
            <h2>P E R T</h2>
        </div>
        <div class="links">
            <a href="#">Menu</a>
            <a href="../Dashboard/index.php">Dashboard</a>
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
        <div class="container" style="margin-top: 30px;">
            <a href="water_config.php" class="btn btn-primary"><i class="bi bi-cup-hot-fill"></i> Add Water Menu</a> <!-- Add Water Menu Button -->
            <a href="dessert_config.php" class="btn btn-primary"><i class="bi bi-cake2"></i> Add Dessert Menu</a> <!-- Add Water Menu Button -->
            <a href="fruit_config.php" class="btn btn-primary"><i class="bi bi-apple"></i> Add Friut Menu</a> <!-- Add Water Menu Button -->
        </div>
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
                                <h5 class="card-title"><?php echo $water['w_menuName']; ?></h5>
                                <p class="card-text text-muted mb-0">Option : <?php echo $water['w_HotColdBlended']; ?></p>
                                <p class="card-text text-success fw-bold"><?php echo number_format($water['w_price'], 2); ?> Baht</p>
                                <div class="d-grid gap-2">
                                    <a role="button" href="water_config.php?id=<?php echo $water['w_menuID']; ?>" class="btn btn-outline-dark"><i class="bi bi-pencil"></i> Edit</a>
                                    <a onclick="return confirm('Are you sure you want to delete');" href="../condb/water_delete.php?id=<?php echo $water['w_menuID']; ?>" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Delete</a>
                                </div>
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
                                <h5 class="card-title"><?php echo $water['w_menuName']; ?></h5>
                                <p class="card-text text-muted mb-0">Option : <?php echo $water['w_HotColdBlended']; ?></p>
                                <p class="card-text text-success fw-bold"><?php echo number_format($water['w_price'], 2); ?> Baht</p>
                                <div class="d-grid gap-2">
                                    <a role="button" href="water_config.php?id=<?php echo $water['w_menuID']; ?>" class="btn btn-outline-dark"><i class="bi bi-pencil"></i> Edit</a>
                                    <a onclick="return confirm('Are you sure you want to delete');" href="../condb/water_delete.php?id=<?php echo $water['w_menuID']; ?>" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Delete</a>
                                </div>
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
                                <h5 class="card-title"><?php echo $water['w_menuName']; ?></h5>
                                <p class="card-text text-muted mb-0">Option : <?php echo $water['w_HotColdBlended']; ?></p>
                                <p class="card-text text-success fw-bold"><?php echo number_format($water['w_price'], 2); ?> Baht</p>
                                <div class="d-grid gap-2">
                                    <a role="button" href="water_config.php?id=<?php echo $water['w_menuID']; ?>" class="btn btn-outline-dark"><i class="bi bi-pencil"></i> Edit</a>
                                    <a onclick="return confirm('Are you sure you want to delete');" href="../condb/water_delete.php?id=<?php echo $water['w_menuID']; ?>" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Delete</a>
                                </div>
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
                                <h5 class="card-title"><?php echo $dessert['dess_menuName']; ?></h5>
                                <p class="card-text text-muted mb-0">Stock : <?php echo $dessert['dess_quantity']; ?></p>
                                <p class="card-text text-success fw-bold"><?php echo number_format($dessert['dess_price'], 2); ?> Baht</p>
                                <div class="d-grid gap-2">
                                    <a role="button" href="dessert_config.php?id=<?php echo $dessert['dess_menuID']; ?>" class="btn btn-outline-dark"><i class="bi bi-pencil"></i> Edit</a>
                                    <a onclick="return confirm('Are you sure you want to deleat');" role="button" href="../condb/dessert_delete.php?id=<?php echo $dessert['dess_menuID']; ?>" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Delete</a>
                                </div>
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
                                <h5 class="card-title"><?php echo $fruit['fruit_menuName']; ?></h5>
                                <p class="card-text text-muted mb-0">Stock : <?php echo $fruit['fruit_quantity']; ?></p>
                                <p class="card-text text-success fw-bold"><?php echo number_format($fruit['fruit_price'], 2); ?> Baht</p>
                                <div class="d-grid gap-2">
                                    <a role="button" href="fruit_config.php?id=<?php echo $fruit['fruit_menuID']; ?>" class="btn btn-outline-dark"><i class="bi bi-pencil"></i> Edit</a>
                                    <a onclick="return confirm('Are you sure you want to deleat');" role="button" href="../condb/fruit_delete.php?id=<?php echo $fruit['fruit_menuID']; ?>" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Delete</a>
                                </div>
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