<?php
    session_start();
    include 'database.php';

    $product_name = trim($_POST['product_name']);
    $price = $_POST['price'] ?: 0;
    $product_type = trim($_POST['product_type']);
    $image_name = $_FILES['profile_image']['name'];
    $temperature = $_POST['temperature'];

    $image_tmp = $_FILES['profile_image']['tmp_name'];
    $folder = '../image/menu/Water/';
    $image_location = $folder . $image_name;
    $recipe = $_POST['Recipe'];

    if(empty($_POST['id'])){
        $query = mysqli_query($conn,"INSERT INTO water_menu(w_menuName, w_waterType, w_HotColdBlended, w_price, w_picture) VALUES ('{$product_name}','{$product_type}','{$temperature}','{$price}', '{$image_name}')") or die('query failed');
        $query1 = mysqli_query($conn,"INSERT INTO recipe_of_water(rec_description) VALUES ('{$recipe}')") or die('query failed');
    }else{
        $query_product = mysqli_query($conn, "SELECT * FROM water_menu WHERE w_menuID = '{$_POST['id']}'");
        $result = mysqli_fetch_assoc($query_product);

        if (empty($image_name)) {
            $image_name = $result['w_picture'];
        }else{
            @unlink($folder . $result['w_picture']);
        }

        $query = mysqli_query($conn,"UPDATE water_menu SET w_menuName='{$product_name}', w_waterType='{$product_type}', w_HotColdBlended='{$temperature}', w_price='{$price}', w_picture='{$image_name}' WHERE w_menuID = '{$_POST['id']}'") or die('query failed');
        $query1 = mysqli_query($conn,"UPDATE recipe_of_water SET rec_description='{$recipe}' WHERE rec_menuID = '{$_POST['id']}'") or die('query failed');
    }
    mysqli_close($conn);
    if ($query) {
        move_uploaded_file($image_tmp,$image_location);
        
        $_SESSION['message'] = 'Product Saved successfully';
        header('location: ../Managerphp/index.php');
    }
    else {
        $_SESSION['message'] = 'Product could not be saved';
        header('location: ../Managerphp/index.php');
    }