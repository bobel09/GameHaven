<?php
session_start();
    include("connection.php");
    include("functions.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="aftersignup.css?v=<?php echo time(); ?>">
    <title>Welcome </title>
</head>
<body>
    <header>
        <input type="checkbox" id="nav-toggle">
        <label for="nav-toggle">Menu</label>
        <img src="../imagini/logo.png" alt="logo2" class="blended-image">
        <nav class="navbar">
            <ul>
                <li><a href="http://localhost/testing/main/index.php">Inapoi</a></li>
            </ul>
        </nav>
    </header>
    <br><br><br><br><br><br><br><br><br>
    <section class="container">
        <div class="box">
            <div class ="mini-box">
                <h2>Bine ai venit! <br>
                Contul tau a fost inregistrat.</h2>
                <div class="butons">
                <input type="submit" value = "Login" onclick="redirectToMainIndex()">
                </div>     
            </div>
        </div>
    </section>
</body>
</html>
<script>
    function redirectToMainIndex()
    {
        window.location.href = 'http://localhost/testing/main/index.php';
    }
</script>
