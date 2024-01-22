<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // Retrieve the verification code from the URL
    $verification_code = $_GET['code'];
    $verification_code = trim($verification_code);


    // Debug: Output the received verification code
    echo "Received verification code: $verification_code<br>";

    // Check if the verification code exists in the database
    $query = "SELECT * FROM orders WHERE TRIM(token_comanda) = '$verification_code';";

    // Debug: Output the SQL query
    echo "SQL Query: $query<br>";
    header("Location: succes.php");

    $result = mysqli_query($con, $query);
    die("Error in SQL query: " . mysqli_error($con));
    if (!$result) {
        // Display an error message and exit if the query fails
        die("Error in SQL query: " . mysqli_error($con));
    }
    echo "Rows returned: " . mysqli_num_rows($result) . "<br>";
    if ($result) {
        // Debug: Output the number of rows returned
        echo "Rows returned: " . mysqli_num_rows($result) . "<br>";

        if (mysqli_num_rows($result) > 0) {
            // Debug: Output a success message
            echo "Verification successful!<br>";

            // Update the user's verification status
            $update_query = "UPDATE orders SET isComandaVerified = 1 WHERE token_comanda = '$verification_code'";
            mysqli_query($con, $update_query);

            header("Location: cos.php");
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

