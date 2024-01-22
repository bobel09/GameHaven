<?php
session_start();
    include("connection.php");
    include("functions.php");
    

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {   //something was posted
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        if(!empty($email) && !empty($password))
        {
            //read from database
            $query = "select * from users where user_name = '$email' limit 1";
            $result = mysqli_query($con, $query);
            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] === $password && $user_data['isEmailVerified'] == 1)
                    {
                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("Location:../main/index.php");
                        die;
                    }
                }
            }
            echo "Please enter some valid information!";
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
    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
    
    <title>Login</title>
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
            <form action="login.php" method="POST">
                <h2>Log In</h2>
                <div class="inputBox">
                    <input type="text" name = "email" required="required" id = "email">
                    <span>E-mail</span>
                <i></i>
                </div>
                <div class="inputBox">
                    <input type="password" name = "password" required="required" id = "password">
                    <span>Password</span>    
                <i></i>
                </div>
                <div class="links">
                    <a href="#">Forgot Password</a>
                </div>
                <div class="butons">
                <input type="submit" value ="Log in">
                <input type="submit" value ="Register" onclick = "window.location.href = 'signup.php';">
                
                </div>     
            </form>
        </div>
    </section>

</body>
</html>
