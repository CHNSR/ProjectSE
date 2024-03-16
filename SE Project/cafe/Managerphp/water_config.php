<?php
session_start();
include '../condb/database.php';

if (!isset($_SESSION['manager_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !';
    header('Location:../signin_ep.php');
}

$result = [
    'w_menuID' => '',
    'w_menuName' => '',
    'w_waterType' => '',
    'w_HotColdBlended' => '',
    'w_price' => '',
    'w_picture' => '',
];

if (!empty($_GET['id'])) {
    $query_product = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_menuID = '{$_GET['id']}'");
    $row_product = mysqli_num_rows($query_product);

    if ($row_product == 0) {
        header('Location: index.php');
    }

    $result = mysqli_fetch_assoc($query_product);
    $recipe_query = mysqli_query($conn, "SELECT * FROM recipe_of_water WHERE rec_menuID = '{$_GET['id']}'");
    $recipe = mysqli_fetch_assoc($recipe_query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/css_for_manager/manager_styles.css">
    <title>Manage Product</title>
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
            <a href="#">Dashboard</a>
            <button id="LogoutBtn"><i class="bi bi-check2-circle"></i> Log Out</button>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                <div class="form-container">
                    <h4 class="text-center mb-4">Water - Manage Product</h4>
                    <form action="../condb/water-configdb.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $result['w_menuID'] ?>">
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control" value="<?php echo $result['w_menuName']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Product Type</label>
                                <select name="product_type" class="form-select">
                                    <option value="coffee" <?php echo ($result['w_waterType'] == 'coffee') ? 'selected' : ''; ?>>Coffee</option>
                                    <option value="milk" <?php echo ($result['w_waterType'] == 'milk') ? 'selected' : ''; ?>>Milk</option>
                                    <option value="tea" <?php echo ($result['w_waterType'] == 'tea') ? 'selected' : ''; ?>>Tea</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Option</label>
                                <div class="form-check">
                                    <input type="radio" id="hot" name="temperature" value="Hot" <?php echo ($result['w_HotColdBlended'] == 'Hot') ? 'checked' : ''; ?>>
                                    <label for="hot">Hot</label><br>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="cold" name="temperature" value="Cold" <?php echo ($result['w_HotColdBlended'] == 'Cold') ? 'checked' : ''; ?>>
                                    <label for="cold">Cold</label><br>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="blended" name="temperature" value="Blen" <?php echo ($result['w_HotColdBlended'] == 'Blen') ? 'checked' : ''; ?>>
                                    <label for="blended">Blended</label><br>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" value="<?php echo $result['w_price']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <?php if (!empty($result['w_picture'])) : ?>
                                        <img src="../image/menu/Water/<?php echo $result['w_picture']; ?>" width="100" alt="Product Image">
                                    <?php endif; ?>
                                </div>
                                <label for="formfile" class="form-label">image</label>
                                <input type="file" name="profile_image" class="form-control" accept="image/png, image/jpg, image/jpeg">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Product Recipe</label>
                                <?php if(!empty($_GET['id'])): ?>
                                    <textarea name="Recipe" class="form-control" cols="30" rows="5"><?php echo $recipe['rec_description']; ?></textarea>
                                <?php else: ?>
                                    <textarea name="Recipe" class="form-control" cols="30" rows="5"></textarea>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if (empty($result['w_menuID'])) : ?>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Create</button>
                        <?php else : ?>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Update</button>
                        <?php endif; ?>
                        <a role="button" class="btn btn-secondary" href="index.php"><i class="bi bi-x-circle"></i> Cancle </a>
                        <hr class="my-4">
                    </form>
                </div>
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