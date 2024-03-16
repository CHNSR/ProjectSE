<?php
session_start();
include '../condb/database.php';

$result = [
    'dess_menuID' => '',
    'dess_menu_name' => '',
    'dess_quantity' => '',
    'dess_price' => '',
    'dess_pic' => '',
];

if (!empty($_GET['id'])) {
    $query_product = mysqli_query($conn, "SELECT * FROM dessert_menu WHERE dess_menuID = '{$_GET['id']}'");
    $row_product = mysqli_num_rows($query_product);

    if ($row_product == 0) {
        header('Location: index.php');
    }

    $result = mysqli_fetch_assoc($query_product);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/css_for_cashier/cashier_styles.css">
    <title>Product List</title>
    <style>
        .form-container {
            background-color: white;
            /* Changed background color to white */
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            margin-top: 30px;
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
            <a href="index.php">Menu</a>
            <a href="#">Bartander Site</a>
            <a href="#">Dashboard</a>
            <button id="RegisBtn"><i class="bi bi-check2-circle"></i> Log Out</button>
        </div>
    </div>
    <div class="container">
        <div class="ter">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-container">
                        <h4 class="text-center mb-4">Dessert - Manage Product</h4>
                        <form action="../condb/dessert-configdb.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $result['dess_menuID'] ?>">
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" value="<?php echo $result['dess_menu_name']; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Product quantity</label>
                                    <input type="number" name="product_quantity" class="form-control" value="<?php echo $result['dess_quantity']; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Price</label>
                                    <input type="text" name="price" class="form-control" value="<?php echo $result['dess_price']; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <div>
                                        <?php if (!empty($result['dess_pic'])) : ?>
                                            <img src="../image/menu/dessert/<?php echo $result['dess_pic']; ?>" width="100" alt="Product Image">
                                        <?php endif; ?>
                                    </div>
                                    <label for="formfile" class="form-label">image</label>
                                    <input type="file" name="profile_image" class="form-control" accept="image/png, image/jpg, image/jpeg">
                                </div>
                            </div>
                            <?php if (empty($result['dess_menuID'])) : ?>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Create</button>
                            <?php else : ?>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Update</button>
                            <?php endif; ?>
                            <a role="button" class="btn btn-secondary" href="index.php"><i class="bi bi-x-circle"></i> Cancel </a>
                            <hr class="my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
