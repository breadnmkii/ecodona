<?php

    session_start();

    // The login page
    $login_redirect = 'login_register.php';

    if (!(isset($_SESSION['UserID']) && $_SESSION['UserID'] == true)) {
        header("Location: $login_redirect");
        exit;
    }

?>