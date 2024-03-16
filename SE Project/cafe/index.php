<php?
session_start();
>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/css_for_index/index_styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>P E R T</title>
</head>

<body>
    <div class="nav">
        <div class="logo-container">
            <a href="#"><img src="image/coffee-cup.png" class="logo" /></a>
            <h2>P E R T</h2>
        </div>
        <div class="links">
            <a href="#">coming soon</a>
            <a href="#">coming soon</a>
            <a href="#">coming soon</a>
            <button id="RegisBtn"><i class="bi bi-check2-circle"></i> Registeration</button>
        </div>
    </div>
    <div class="container">
    <div class="hero">
        <div class="content">
            <h1>Brewing Happiness</h1>
            <p>in Every Cup</p>
            <div class="buttons">
                <button id="CusLogBT"><i class="bi bi-bag-check-fill" ></i> Customer Login</button>
                <button id = "EmpLogBT" ><i class="bi bi-briefcase-fill"></i> Employee Login</button>
            </div>
        </div>
        <div class="hero-image"></div> <!-- จากตรงนี้ -->
    </div>
</div>


    <script>
        // Add an event listener to the Log In button
        document.getElementById('EmpLogBT').addEventListener('click', function () {
            // Redirect to the login page or any other page you want
            window.location.href = 'signin_ep.php'; // Replace 'login.html' with the desired page
        });

        document.getElementById('CusLogBT').addEventListener('click', function () {
            // Redirect to the login page or any other page you want
            window.location.href = 'signin_cs.php'; // Replace 'login.html' with the desired page
        });
        document.getElementById('RegisBtn').addEventListener('click', function () {
            // Redirect to the login page or any other page you want
            window.location.href = 'Regiscus.php'; // Replace 'login.html' with the desired page
        });
    </script>

    
</body>

</html>