<?php
session_start();
include("../login/connection.php");
include("../login/functions.php");

// Verificăm autentificarea utilizatorului
$user_data = check_login($con);

// Verificăm dacă utilizatorul a apăsat butonul de adăugare în coș
if (isset($_POST['adauga'])) {
    $nume = $_POST['nume'];
    $pret = $_POST['pret'];
    $poza = $_POST['poza'];
    
    adauga_in_cos($con, $nume, $pret, $poza);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="jocuri.css?v=<?php echo time(); ?>">    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oleo+Script:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <header>
        <input type="checkbox" id="nav-toggle">
        <label for="nav-toggle">Menu</label>
        <img src="../imagini/logo.png" alt="logo2" class="blended-image">
        <nav class="navbar">
            <ul>
                <li>
                    <a href="http://localhost/testing/main/index.php">Acasa</a>
                </li>
                <li><a href="http://localhost/testing/desprenoi/desprenoi.php">Despre</a></li>
                <li><a href="http://localhost/testing/contact/contact.php">Contact</a></li>
                <?php if ($user_data) { ?>
                    <li><a href="http://localhost/testing/cos/cos.php"><img src="../imagini/cart.png" alt="cart" class = "cart-icon"></a></li>
                    <?php } ?>
                <li class="dropdown">
                    <a href="#"><img src="../imagini/user.png" alt="login" class = "login-icon"></a>
                    <ul class="dropdown-menu">
                    <?php if ($user_data) { ?>
                            <li><a href="http://localhost/testing/login/logout.php">Log Out</a></li>
                        <?php } else { ?>
                            <li><a href="http://localhost/testing/login/login.php">Log In</a></li>
                            <li><a href="http://localhost/testing/login/signup.php">Register</a></li>
                        <?php } ?>                    
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <h3 class="title">Jocuri</h3>
<div class="produse">
    <?php 
    $select_produs = mysqli_query($con, "SELECT * FROM stoc_gamestore ORDER BY id ASC") or die('query failed');
    if (mysqli_num_rows($select_produs) > 0){
        while($fetch_produs = mysqli_fetch_assoc($select_produs)) {
    ?>
    <div class="box">
        <div class="name">
            <p><?php echo $fetch_produs['nume']; ?></p>
        </div>
        <div class="box-content">
            <div class="pret"><?php echo $fetch_produs['pret']; ?> lei</div>
            <div class="img-container">
                <img src="../imagini/<?php echo $fetch_produs['image_data']?>" alt="nu merge poza" class = "image-fit">
            </div>
            <form method="POST" action="">
                <input type="hidden" name="nume" value="<?php echo $fetch_produs['nume']; ?>">
                <input type="hidden" name="pret" value="<?php echo $fetch_produs['pret']; ?>">
                <input type="hidden" name="poza" value="<?php echo $fetch_produs['image_data']; ?>">
                <input type="submit" name="adauga" value="Adauga in cos" class="hero-btn">    
            </form>
        </div>
    </div>
    <?php } } ?>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>
    <!-----------Final-------------->
    <footer>
    <section class="final">
        <h4>Despre noi</h4>
        <p>Suntem un lant de magazine de jocuri din Romania. ar putea fi chiar cel mai bun gamestore,avem cel mai experimentat si politicos staff.<br>returul este gratuit , pentru orice comanda .puteti suna la numarul 0770708014 sau ne puteti contacta pe retelele noastre de socializare pentru orice nelamurire.</p>
        <div class="icons">
            <a href="https://www.instagram.com/bobel09/"> <span class="fa fa-instagram"></span></a>
             
          <a href="https://www.facebook.com/alexiuc.vlad">   <span class="fa fa-facebook"></span></a>
            <a href="https://www.instagram.com/bobel09/"> <span class="fa fa-twitter"></span></a>
            <a href="https://www.tiktok.com/@bobix00?lang=ro-RO"> <span class="fa fa-linkedin"></span></a>
            <p>facut cu <span class="fa fa-heart"></span> de Vlad Alexiuc</p>
        </div>
    </section>
    </footer>
</body>
</html>
