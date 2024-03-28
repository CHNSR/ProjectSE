<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css_for_index/signin_styles.css"> <!-- Include your CSS file -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <title>Log In</title>
    <script>
        <?php
        // Check if there is a session variable for the duplicate username
        if (isset($_SESSION['duplicate_username'])) {
            echo "alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');";
            unset($_SESSION['duplicate_username']); // Clear the session variable
        }
        ?>
    </script>
</head>

<body>
    <div class="container text-center">
        <!-- Add your logo here -->
        <img src="image/coffee-cup.png" alt="Logo" class="mx-auto d-block mb-4" style="max-width: 100px;">

        <h3 class="mt-4">Welcome</h3>
        <p class="pink-text">Pert Customer</p>
        <hr>
        <form action="condb/logincs_condb.php" method="post" onsubmit="return showAlert();">
            <div class="mb-3 form-label-left">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" aria-describedby="username" required>
            </div>
            <div class="mb-3 form-label-left">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" minlength="5" maxlength="20" required>
            </div>
            <div class="d-grid gap-2 ">
                <button type="submit" name="signin" id="signin" class="btn btn-outline-info">Sign In</button>
            </div>
        </form>
    </div>
</body>

</html>