<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    $pret = (float)str_replace('$', '', $pret);
    
    adauga_in_cos($con, $nume, $pret, $poza);
}

$steamApiKey = 'E6A66346AED74CC41D0F20EA139AE24B';

// List of App IDs without free games
$appIds = array(
    1675200, 1966720, 1086940, 2195250, 2495450, 359550, 39210, 2221920, 582010,
    1091500, 1950450, 460920, 582660, 2231380, 2138330, 2072450, 381210, 552520, 1063730,
    2252570, 2161700, 431960, 1172620, 1326470, 1245620, 1190970, 227300, 739630, 2186680,
    550, 413150, 1118010, 949230, 306130, 1227890, 1778820, 601430, 2399830, 1708010,
    1260320, 1551360, 108600, 284160, 686810, 648800, 1248130, 1250410, 2290180,
    1985820, 294100, 1286680, 1364780, 1868140, 1174180, 594650, 270880, 518790, 447040,
    1066890, 1466860, 2344520, 990080, 892970, 1696780, 2157560, 2140330, 2338770, 1151340,
    105600, 394360, 489830, 250900, 1129580, 281990
);

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
                    <li><a href="http://localhost/testing/cos/cos.php"><img src="../imagini/cart.png" alt="cart" class="cart-icon"></a></li>
                <?php } ?>
                <li class="dropdown">
                    <a href="#"><img src="../imagini/user.png" alt="login" class="login-icon"></a>
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
        foreach ($appIds as $appId) {
            $api_url = "https://store.steampowered.com/api/appdetails?appids={$appId}&cc=us";

            $ch = curl_init($api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
            } else {
                $data = json_decode($response, true);

                // Check if the request was successful
                if ($data[$appId]['success']) {
                    $appDetails = $data[$appId]['data'];

                    
                        echo '<div class="box">';
                        echo '<div class="name">';
                        echo '<p>' . $appDetails['name'] . '</p>';
                        echo '</div>';
                        echo '<div class="box-content">';
                        echo '<div class="pret">' . $appDetails['price_overview']['final_formatted'] . '</div>';
                        echo '<div class="img-container">';
                        echo '<img src="' . $appDetails['header_image'] . '" alt="nu merge poza" class="image-fit">';
                        echo '</div>';
                        echo '<form method="POST" action="">';
                        echo '<input type="hidden" name="nume" value="' . $appDetails['name'] . '">';
                        echo '<input type="hidden" name="pret" value="' . $appDetails['price_overview']['final_formatted'] . '">';
                        echo '<input type="hidden" name="poza" value="' . $appDetails['header_image'] . '">';
                        echo '<input type="submit" name="adauga" value="Adauga in cos" class="hero-btn">';    
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    
                } else {
                    echo 'Unable to retrieve app details for App ID ' . $appId . '<br>';
                }
            }

        

            curl_close($ch);

            // Add a separator between each game's details
            echo '<hr>';
        }
        ?>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <!-----------Final-------------->
    <footer>
        <section class="final">
            <h4>Despre noi</h4>
            <p>Suntem un lant de magazine de jocuri din Romania. Ar putea fi chiar cel mai bun gamestore, avem cel mai experimentat și politicos staff. Returul este gratuit pentru orice comandă. Puteți suna la numărul 0770708014 sau ne puteți contacta pe rețelele noastre de socializare pentru orice nelămurire.</p>
            <div class="icons">
                <a href="https://www.instagram.com/bobel09/"> <span class="fa fa-instagram"></span></a>
                <a href="https://www.facebook.com/alexiuc.vlad">   <span class="fa fa-facebook"></span></a>
                <a href="https://www.instagram.com/bobel09/"> <span class="fa fa-twitter"></span></a>
                <a href="https://www.tiktok.com/@bobix00?lang=ro-RO"> <span class="fa fa-linkedin"></span></a>
                <p>Facut cu <span class="fa fa-heart"></span> de Vlad Alexiuc</p>
            </div>
        </section>
    </footer>
</body>
</html>
