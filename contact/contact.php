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
    <link rel="stylesheet" href="contact.css?v=<?php echo time(); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oleo+Script:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">

</head>

<body>
    <header>
        <input type="checkbox" id="nav-toggle">
        <label for="nav-toggle">Menu</label>
        <img src="/testing/imagini/logo.png" alt="logo2" class="blended-image">
        <nav class="navbar">
            <ul>
                <li><a href="http://localhost/testing/main/index.php">Acasa</a></li>
                <li>
                    <a href="http://localhost/testing/jocuri/jocuri.php">Jocuri</a>
                </li>
                <li><a href="http://localhost/testing/desprenoi/desprenoi.php">Despre</a></li>
                <?php if ($user_data) { ?>
                    <li><a href="http://localhost/testing/cos/cos.php"><img src="../imagini/cart.png" alt="cart" class = "cart-icon"></a></li>
                    <?php } ?>
                <li class="dropdown">
                    <a href="#"><img src="/testing/imagini/user.png" alt="login" class = "login-icon"></a>
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
<!-------------contact content-------------->
<section class="location">
    <br><br><br><br><br><br><br>  
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2849.1208509804114!2d26.05001571584028!3d44.43068317910232!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b201d02342fff3%3A0xe08b3cde2ed03b06!2sAFI%20Cotroceni!5e0!3m2!1sro!2sro!4v1652798972145!5m2!1sro!2sro" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    
    
    
    
    
</section>
<section class="contact-us">
    <div class="row">
        <div class="contact-col">
            <div>
         <span class="fa fa-home"></span>
                <span> 
                <h5> Romania</h5>
                <p>B-dul Unirii nr. 8, Bl. 7A, Sc. 2, Et. 1, Ap. 25, sector 1<br> Bucuresti (mai exact este pe partea stanga cum mergeti pe bulevardul cu fantani spre Casa Poporului, interfon 25)</p>
                </span>
                  </div>
            <div>
                <span class="fa fa-phone"></span>
                <span>
                   <h5>021-318.62.19</h5>
                    <p>PROGRAM: LUNI - VINERI, orele 9 - 18</p>
                </span>        
            </div>
              <div>
                <span class="fa fa-envelope-o"></span>
                <span>
                   <h5>office@gamestore.ro</h5>
                    <p>Primim si mail-uri</p>
                </span>
            </div>       
        </div>
          <div class="contact-col">
             <form action="">
              <input type="text" placeholder="Introdu numele" required>
              <input type="email" placeholder="Introdu adresa de mail" required> 
              <input type="text" placeholder="Introdu subiectul" required>
                 <textarea rows="8" placeholder="Mesaj" required></textarea>
               <button type="submit" class="hero-btn red-btn">Trimite mesaj</button>
             </form>
              
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
