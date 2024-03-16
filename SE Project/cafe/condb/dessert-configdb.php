<?php
    session_start();
    include 'database.php';

    $product_name = trim($_POST['product_name']);
    $price = $_POST['price'] ?: 0;
    $quantity = trim($_POST['product_quantity']);
    $image_name = $_FILES['profile_image']['name'];

    $image_tmp = $_FILES['profile_image']['tmp_name'];
    $folder = '../image/menu/Dessert/';
    $image_location = $folder . $image_name;

    if(empty($_POST['id'])){
        $query = mysqli_query($conn,"INSERT INTO dessert_menu(dess_menuName, dess_quantity, dess_price, dess_picture) VALUES ('{$product_name}','{$quantity}', '{$price}', '{$image_name}')") or die('query failed');
    }else{
        $query_product = mysqli_query($conn, "SELECT * FROM dessert_menu WHERE dess_menuID = '{$_POST['id']}'");
        $result = mysqli_fetch_assoc($query_product);

        if (empty($image_name)) {
            $image_name = $result['dess_picture'];
        }else{
            @unlink($folder . $result['dess_picture']);
        }

        $query = mysqli_query($conn,"UPDATE dessert_menu SET dess_menuName='{$product_name}', dess_quantity='{$quantity}', dess_price='{$price}', dess_picture='{$image_name}' WHERE dess_menuID = '{$_POST['id']}'") or die('query failed');
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