<?php
session_start();
include '../condb/database.php';

$result = [
    'w_menuID' => '',
    'w_name' => '',
    'w_watertype' => '',
    'w_hcm' => '',
    'w_price' => '',
    'w_pic' => '',
];

if (!empty($_GET['id'])) {
    $query_product = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_menuID = '{$_GET['id']}'");
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
    <link rel="stylesheet" href="../css/add_styles.css">
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
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                <div class="form-container">
                    <h4 class="text-center mb-4">Water - Manage Product</h4>
                    <form action="../condb/water-configdb.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $result['w_menuID'] ?>">
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control" value="<?php echo $result['w_name']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Product Type</label>
                                <select name="product_type" class="form-select">
                                    <option value="coffee" <?php echo ($result['w_watertype'] == 'coffee') ? 'selected' : ''; ?>>Coffee</option>
                                    <option value="milk" <?php echo ($result['w_watertype'] == 'milk') ? 'selected' : ''; ?>>Milk</option>
                                    <option value="tea" <?php echo ($result['w_watertype'] == 'tea') ? 'selected' : ''; ?>>Tea</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Option</label>
                                <?php
                                $temperature = explode(',', $result['w_hcm']);
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="temperature[]" value="hot" id="hot" <?php echo (in_array('hot', $temperature)) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="hot">Hot</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="temperature[]" value="cold" id="cold" <?php echo (in_array('cold', $temperature)) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="cold">Cold</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="temperature[]" value="blended" id="blended" <?php echo (in_array('blended', $temperature)) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="blended">Blended</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" value="<?php echo $result['w_price']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <?php if (!empty($result['w_pic'])) : ?>
                                        <img src="../image/menu/water/<?php echo $result['w_pic']; ?>" width="100" alt="Product Image">
                                    <?php endif; ?>
                                </div>
                                <label for="formfile" class="form-label">image</label>
                                <input type="file" name="profile_image" class="form-control" accept="image/png, image/jpg, image/jpeg">
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
</body>

</html>