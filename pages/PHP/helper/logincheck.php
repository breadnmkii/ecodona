<?php

    session_start();

    // login path
    $login_redirect = '../../login.html';

    if (!isset($_SESSION['user_id'])) {
        header("Location: $login_redirect");
        exit;
    }

?>