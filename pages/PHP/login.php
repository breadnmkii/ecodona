<?php
require 'database.php';
session_start(); //starts the user session
$dashboard_redirect = "../dashboard.html";
$login_redirect = "../login.html";

//$user = "";

if (isset($_POST['email']) and isset($_POST['password'])) { //checks if the username is not null
    // Use a prepared statement
    $stmt = $mysqli->prepare("SELECT COUNT(*), UserId, Passhash, Email FROM UserInfo WHERE Email=?"); //recheck the users database

    // Bind the parameter
    $email = $_POST['email'];
    $stmt->bind_param('s', $email);
    $stmt->execute();

    // Bind the results
    $stmt->bind_result($cnt, $user_id, $pwd_hash, $email_data);
    $stmt->fetch();

    $pwd_guess = $_POST['password'];
    // Compare the submitted password to the actual password hash

    $_SESSION['user_id'] = $user_id;
        // $_SESSION['username'] = $username;
        $_SESSION['email'] = $email_data;

        // $_SESSION['token'] = bin2hex(random_bytes(32));
        // Redirect to your target page
        //send the session variables to the js file
        echo json_encode(array(
            "success" => true,
            "user_id" => $_SESSION['user_id']
        ));

        header("Location: $dashboard_redirect");
    }

    

//     if ($cnt == 1 && password_verify($pwd_guess, $pwd_hash)) {
//         // Login succeeded!
//         $_SESSION['user_id'] = $user_id;
//         // $_SESSION['username'] = $username;
//         $_SESSION['email'] = $email_data;

//         // $_SESSION['token'] = bin2hex(random_bytes(32));
//         // Redirect to your target page
//         //send the session variables to the js file
//         echo json_encode(array(
//             "success" => true,
//             "user_id" => $_SESSION['user_id']
//         ));

//         header("Location: $dashboard_redirect");

//     } else {
//         // Login failed; redirect back to the login screen
//         echo json_encode(array(
//             "success" => false,
//             "user_id" => ''
//         ));

//         header("Location: $login_redirect");

//     }
// }
