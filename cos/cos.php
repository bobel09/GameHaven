<?php
session_start();
include("../login/connection.php");
include("../login/functions.php");
$user_data = check_login($con);

// Verificați dacă s-a apăsat butonul de ștergere din coș
if (isset($_POST['sterge'])) {
    // Obțineți cart_id din formularul de ștergere
    $cart_id = $_POST['cart_id'];

    // Ștergeți produsul din coșul utilizatorului
    $delete_query = "DELETE FROM cart WHERE cart_id = $cart_id AND user_id = {$_SESSION['user_id']}";
    $result = mysqli_query($con, $delete_query);
    if ($result) {
        // Ștergerea s-a realizat cu succes
        echo "Produsul a fost șters din coș.";
    } else {
        // A apărut o eroare la ștergere
        echo "Eroare la ștergerea produsului din coș.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="cos.css?v=<?php echo time(); ?>">    
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
                    <li><a href="http://localhost/testing/jocuri/jocuri.php">Jocuri</a></li>
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
    <h3 class="title">Shopping Cart</h3>
<div class="produse">
    <?php 
    $user_id = $_SESSION['user_id'];
    $select_cos = mysqli_query($con, "SELECT * FROM cart WHERE user_id = $user_id") or die('query failed');
    if (mysqli_num_rows($select_cos) > 0){
        while($fetch_cos = mysqli_fetch_assoc($select_cos)) {
    ?>
    <div class="box">
        <div class="name">
            <p><?php echo $fetch_cos['nume']; ?></p>
        </div>
        <div class="box-content">
            <div class="pret"><?php echo $fetch_cos['pret']; ?> lei</div>
            <div class="img-container">
                <img src="../imagini/<?php echo $fetch_cos['poza']?>" alt="nu merge poza" class = "image-fit">
            </div>
            <form method="POST" action="">
                <!-- Includeți aici toți ceilalți parametri necesari, cum ar fi cart_id -->
                <input type="hidden" name="cart_id" value="<?php echo $fetch_cos['cart_id']; ?>">
                <input type="submit" name="sterge" value="Șterge din coș" class="hero-btn">    
            </form>
        </div>
    </div>
    <?php } } ?>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>s
<?php
// Calculați totalul de plată
$select_total = mysqli_query($con, "SELECT SUM(pret) AS total FROM cart WHERE user_id = $user_id") or die('query failed');
if (mysqli_num_rows($select_total) > 0) {
    $fetch_total = mysqli_fetch_assoc($select_total);
    ?>
    <h3 class="title"><?php echo "Total de plata = " . $fetch_total['total']; ?> lei</h3>
    <?php
} else {
    ?>
    <h3 class="title">0 lei</h3>
    <?php
}
?>

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
