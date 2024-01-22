<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;   

function check_login($con)
{   
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
 
}
function random_num($length)
{
    $text = "";
    if($length < 5)
    {
        $length = 5;
    }
    $len = rand(4,$length);
    for ($i=0; $i < $len; $i++) { 
        $text .= rand(0,9);
    }
    return $text;
}

function adauga_in_cos($con, $nume, $pret, $poza) {
    // Verificăm dacă utilizatorul este autentificat
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Verificăm dacă produsul există deja în coșul utilizatorului
        $query = "SELECT * FROM cart WHERE user_id = $user_id AND nume = '$nume'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            // Produsul există deja în coș, actualizăm doar cantitatea
            $row = mysqli_fetch_assoc($result);
            $cart_id = $row['cart_id'];
            $quantity = $row['quantity'] + 1;

            $update_query = "UPDATE cart SET quantity = $quantity WHERE cart_id = $cart_id";
            mysqli_query($con, $update_query);
        } else {
            // Produsul nu există în coș, îl adăugăm
            $insert_query = "INSERT INTO cart (user_id, nume, pret, poza, quantity) VALUES (?, ?, ?, ?, 1)";
            $stmt = mysqli_prepare($con, $insert_query);
            mysqli_stmt_bind_param($stmt, "isss", $user_id, $nume, $pret, $poza);
            mysqli_stmt_execute($stmt);
        }

        // Afisăm un mesaj de succes
        echo "Produsul a fost adăugat în coș!";
    } else {
        echo "Trebuie să fii autentificat pentru a adăuga produse în coș!";
    }
}

function send_email($to, $subject, $body) {
    require __DIR__ . '/vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'alexiuc.vlad999@gmail.com';
        $mail->Password = 'cxuk cvsm xxyl zkpl';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;


        //Recipients
        $mail->setFrom('alexiuc.vlad999@gmail.com', 'GameHaven');
        $mail->addAddress($to);

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
    } catch (Exception $e) {
        echo "Exception caught: {$e->getMessage()}";
    }
}

?>






