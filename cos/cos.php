<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../login/connection.php");
include("../login/functions.php");
$user_data = check_login($con);

// Check for product deletion
if (isset($_POST['sterge'])) {
    $cart_id = $_POST['cart_id'];

    $delete_query = "DELETE FROM cart WHERE cart_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, "ii", $cart_id, $_SESSION['user_id']);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Produsul a fost șters din coș.";
    } else {
        echo "Eroare la ștergerea produsului din coș.";
    }

    mysqli_stmt_close($stmt);
}

// Check for order placement
if (isset($_POST['place_order'])) {
    
    $tara = mysqli_real_escape_string($con, $_POST['tara']);
    $judet = mysqli_real_escape_string($con, $_POST['judet']);
    $localitate = mysqli_real_escape_string($con, $_POST['localitate']);
    $strada = mysqli_real_escape_string($con, $_POST['strada']);
    $cod_postal = mysqli_real_escape_string($con, $_POST['cod_postal']);
    $nr_casa = mysqli_real_escape_string($con, $_POST['numar']);

    $token_comanda = random_num(6);
    $user_id = $_SESSION['user_id'];
    $query = "INSERT INTO orders (user_id, tara, judet, localitate, strada, cod_postal, nr_casa, token_comanda) VALUES ($user_id, '$tara', '$judet', '$localitate', '$strada', '$cod_postal', '$nr_casa', '$token_comanda')";
    mysqli_query($con, $query);
    
    // Send email
    $subject = "Comanda dumneavoastra";
    $body = "Hello ,\n\nClick the link below to verify your account:\n\n";
    $body .= "http://localhost/testing/cos/verify_order.php?code=$token_comanda\n\n";
    $body .= "Detalii comanda:\n\n";
    $body .= "Tara: $tara\n";
    $body .= "Judet: $judet\n";
    $body .= "Localitate: $localitate\n";
    $body .= "Strada: $strada\n";
    $body .= "Cod Postal: $cod_postal\n";
    $body .= "Numar: $nr_casa\n";
    $body .= "Token Comanda: $token_comanda\n";
    $body .= "\n\nVa multumim pentru comanda dumneavoastra!";
    send_email($user_data['user_name'], $subject, $body);
    header("Location: confirmare_comanda.php");

    // Empty the cart

    $delete_query = "DELETE FROM cart WHERE user_id = $user_data[user_id]";
    mysqli_query($con, $delete_query);


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
            <div class="pret"><?php echo $fetch_cos['pret']; ?> $</div>
            <div class="img-container">
                <img src="<?php echo $fetch_cos['poza']?>" alt="nu merge poza" class = "image-fit">
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
    <h3 class="title"><?php echo "Total de plata = " . $fetch_total['total']; ?> $</h3>
    <?php
} else {
    ?>
    <h3 class="title">0 $</h3>
    <?php
    
}
?>
<h3 class="title">Finalizare Comandă</h3>

<form method="POST" action="">
    <!-- Adresa de livrare --><div class="buton">
    <label for="tara">Țară:</label>
    <input type="text" id="tara" name="tara" required>

    <label for="judet">Județ:</label>
    <input type="text" id="judet" name="judet" required>

    <label for="localitate">Localitate:</label>
    <input type="text" id="localitate" name="localitate" required>

    <label for="strada">Stradă:</label>
    <input type="text" id="strada" name="strada" required>

    <label for="cod_postal">Cod Poștal:</label>
    <input type="text" id="cod_postal" name="cod_postal" required>

    <label for="numar">Numar:</label>
    <input type="text" id="numar" name="numar" required>
    <!-- Alte detalii sau produse pot fi adăugate aici -->
    
    <input type="submit" name="place_order" value="Plasează comanda">
    </div>
</form>


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
