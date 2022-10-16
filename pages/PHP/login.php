<?php
require 'database.php';
session_start(); //starts the user session

//$user = "";

if (isset($_POST['username']) and isset($_POST['password'])) { //checks if the username is not null
    // $user = $_POST['user'];
    // $pass = $_POST['pass'];
    // Use a prepared statement
    $stmt = $mysqli->prepare("SELECT COUNT(*), userid, hashpass FROM users WHERE userid=?");

    // Bind the parameter
    $user = $_POST['username'];
    $stmt->bind_param('s', $user);
    $stmt->execute();

    // Bind the results
    $stmt->bind_result($cnt, $user_name, $pwd_hash);
    $stmt->fetch();

    $pwd_guess = $_POST['password'];
    // Compare the submitted password to the actual password hash

    if ($cnt == 1 && password_verify($pwd_guess, $pwd_hash)) {
        // Login succeeded!
        $_SESSION['user'] = $user_name;
        $_SESSION['token'] = bin2hex(random_bytes(32));
        // Redirect to your target page

        header("Location: dashboard.html");
    } else {
        // Login failed; redirect back to the login screen
    }
}

?>