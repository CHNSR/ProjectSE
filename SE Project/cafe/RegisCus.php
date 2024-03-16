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
    <!-- JavaScript for handling duplicate username popup -->
    <script>
        <?php
        // Check if there is a session variable for the duplicate username
        if (isset($_SESSION['duplicate_username'])) {
            echo "alert('ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว กรูณากรอกข้อมูลใหม่');";
            unset($_SESSION['duplicate_username']); // Clear the session variable
        }
        ?>
        <?php
        // Check if there is a session variable for the duplicate username
        if (isset($_SESSION['duplicate_email'])) {
            echo "alert('อีเมลนี้ถูกใช้ไปแล้ว กรูณากรอกข้อมูลใหม่');";
            unset($_SESSION['duplicate_email']); // Clear the session variable
        }
        ?>

        function formatPhoneNumber(input) {
            // Remove non-numeric characters from the input value
            var phoneNumber = input.value.replace(/\D/g, '');

            // Format the phone number as xxx-xxx-xxxx
            if (phoneNumber.length === 10) {
                var formattedNumber = phoneNumber.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
                input.value = formattedNumber;
            }
        }
    </script>
</head>

<body>
    <div class="container text-center">
        <!-- Add your logo here -->
        <img src="image/coffee-cup.png" alt="Logo" class="mx-auto d-block mb-4" style="max-width: 100px;">
        <h3 class="mt-4">Welcome</h3>
        <p class="pink-text">Customer Registration</p>
        <hr>
        <form action="condb/RegisCusDB.php" method="post">
            <div class="mb-3 form-label-left">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3 form-label-left">
                <label for="surname" class="form-label">Surname</label>
                <input type="text" class="form-control" name="surname" required>
            </div>
            <div class="mb-3 form-label-left">
                <label for="birthdate" class="form-label">Birth Date</label>
                <input type="date" class="form-control" name="birthdate" required>
            </div>
            <div class="mb-3 form-label-left">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3 form-label-left">
                <label for="phone_num" class="form-label">Phone number</label>
                <input type="text" class="form-control" name="phone_num" pattern="\d{3}-\d{3}-\d{4}" minlength="12" maxlength="12" oninput="formatPhoneNumber(this)" required>
            </div>
            <div class="mb-3 form-label-left">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-3 form-label-left">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3 form-label-left">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" minlength="5" maxlength="20" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" name="register" class="btn btn-warning" mx-auto">Register</button>
            </div>
        </form>
    </div>

</body>

</html>