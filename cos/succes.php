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
    <link rel="stylesheet" href="confirmare_comanda.css?v=<?php echo time(); ?>">
    <title>Welcome </title>
</head>
<body>
    <header>
        <input type="checkbox" id="nav-toggle">
        <label for="nav-toggle">Menu</label>
        <img src="../imagini/logo.png" alt="logo2" class="blended-image">
        <nav class="navbar">
            <ul>
                <li><a href="http://localhost/testing/cos/cos.php">Inapoi</a></li>
            </ul>
        </nav>
    </header>
    <br><br><br><br><br><br><br><br><br>
    <section class="container">
        <div class="box">
            <div class ="mini-box">
                <h2>Comanda a fost plasata cu succes<br>
</h2>
            
            </div>
        </div>
    </section>
</body>
</html>
