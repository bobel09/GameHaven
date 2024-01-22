<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{   //something was posted
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if(!empty($email) && !empty($password) && !empty($confirmPassword) && ($password == $confirmPassword))
    {   
        $verification_code = random_num(6);
        //save to database
        $user_id = random_num(10);
        $query = "insert into users (user_id,user_name,password,token) values ('$user_id','$email','$password', '$verification_code')";
        mysqli_query($con, $query);
    //Send verification email
    $subject = "Verificare cont";
    $body = "Buna ziua $email, \n\n Apasa pe link-ul de mai jos pentru a verifica contul:\n\n";
    $body .= "http://localhost/testing/login/verify.php?code=$verification_code";
    send_email($email, $subject, $body);
    header("Location: between.php");
    echo "After calling send_email. ";

        echo "An email has been sent to $email for account verification. Please check your inbox.";
    }
    else
    {
        echo "Please enter some valid information!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css?v=<?php echo time(); ?>">
    <script src="signup.js?v=<?php echo time(); ?>"></script>
    <title>Register</title>
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
            <form action="signup.php" method="POST">
                <h2>Register</h2>
                <div class="inputBox">
                    <input type="text" name="email" required="required" id="email">
                    <span>E-mail</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="password" name="password" required="required" id="password">
                    <span>Password</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="password" name="confirmPassword" required="required" id="confirmPassword">
                    <span>Rewrite password</span>
                    <i></i>
                    <span id="error" class="error-message"></span>
                </div>
                <div class="butons">
                    <input type="submit" value="Register" onclick="return checkForErrors(event)">
                </div>

            </form>
        </div>
    </section>
</body>
</html>
