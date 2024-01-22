<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // Retrieve the verification code from the URL
    $verification_code = $_GET['code'];

    // Debug: Output the received verification code
    echo "Received verification code: $verification_code<br>";

    // Check if the verification code exists in the database
    $query = "SELECT * FROM users WHERE token = '$verification_code' AND isEmailVerified = 0 LIMIT 1";

    // Debug: Output the SQL query
    echo "SQL Query: $query<br>";

    $result = mysqli_query($con, $query);

    if ($result) {
        // Debug: Output the number of rows returned
        echo "Rows returned: " . mysqli_num_rows($result) . "<br>";

        if (mysqli_num_rows($result) > 0) {
            // Debug: Output a success message
            echo "Verification successful!<br>";

            // Update the user's verification status
            $update_query = "UPDATE users SET isEmailVerified = 1 WHERE token = '$verification_code'";
            mysqli_query($con, $update_query);

            // Log in the user
            $user_data = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $user_data['user_id'];

            // Debug: Output the user ID
            echo "User ID: {$_SESSION['user_id']}<br>";

            header("Location: aftersignup.php");
            die;
        } else {
            // Debug: Output a message if no rows are returned
            echo "No rows returned. Invalid verification code or account is already verified.<br>";
        }
    } else {
        // Debug: Output an error message if the query fails
        echo "Query failed: " . mysqli_error($con) . "<br>";
    }
}
?>
