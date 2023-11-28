<?php
session_start();
    include("../login/connection.php");
    include("../login/functions.php");
    $user_data = check_login($con);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="Game" content="with=device-width,initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gamestore</title>
    <link rel="stylesheet" href="desprenoi.css?v=<?php echo time(); ?>"> 

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oleo+Script:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">

</head>

<body>

    <header>
        <input type="checkbox" id="nav-toggle">
        <label for="nav-toggle">Menu</label>
        <img src="../imagini/logo.png" alt="logo2" class="blended-image">
        <nav class="navbar">
            <ul>
                <li><a href="http://localhost/testing/main/index.php">Acasa</a></li>
                <li>
                    <a href="http://localhost/testing/jocuri/jocuri.php">Jocuri</a>
                </li>
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
   <section class="despre">
        <br><br><br><br><br><br><br>
        <h1> Cine suntem?</h1>

        <p>Membrii din Staff-ul nostru sunt cei mai experimentati oameni din Romania</p>
        <div class="row">
            <div class="course-col">
                <h3>Alexiuc Vlad</h3>
                <p>Alexiuc Vlad este un programator român. El este considerat unul dintre cei mai sofisticați experți români în programarea in C++. Printre meritele sale se numără munca sa în policy-based design și template metaprogramming. Ideile sale au fost descrise pe larg în cartea sa Modern C++ Design (Addison-Wesley, 2001, ISBN 0-201-70431-5) și au fost implementate în biblioteca de funcții C++ Loki.
                </p>
            </div>
            <div class="course-col">
                <h3>Dobre Paloti</h3>
                <p>Dobre Paloti (n. 30 decembrie 2003, Secusigiu, Romania) este creatorul limbajului de programare C++, cel care a scris primele sale definiții, a realizat prima implementare și a fost responsabil pentru procesarea propunerilor de extindere a limbajului C++ în cadrul comitetului de standardizare.
                </p>
            </div>
            <div class="course-col">
                <h3>iRaphahell</h3>
                <p>Rafael Georgian Stoica (născut: 4 februarie 1996 [vârsta 26]), mai cunoscut online sub numele de iRaphahell, este un jucător și youtuber român. Este unul dintre cei mai populari jucători din România.
                    Și-a creat canalul YouTube în mai 2013, încărcând primul videoclip intitulat corespunzător „Primul Video!” (Primul videoclip!) doar trei săptămâni mai târziu.
                </p>
            </div>
        </div> 

    </section>


-
 
    <!-----------Final-------------->
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




</body>

</html>
