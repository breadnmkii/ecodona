<?php
    require 'helper/database.php';
    # require 'helper/logincheck.php;       # if page is login-guarded
    # require_once 'helper/<php_function_package>.php;      # for importing any php helper function files

    # If logged in already, send to dashboard
    session_start();
    if (isset($_SESSION['UserID'])) {
        header("Location: dashboard.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf8">
        <title>ecodona - Donate for Good</title>
    </head>
    <body>
        <nav>
            <a href="homepage.php">
                <img id="logo" src="TODO: logo.img">
            </a>
            <div class="navlinks">
                <a href="TODO: overview">Overview</a>
                <a href="TODO: howitworks">How It Works</a>
                <a href="TODO: taxdeduction">Tax Deduction</a>
            </div>
            <input type="button" id="signin-button" value="Sign In">
        </nav>
        <section>

        </section>
        <footer>

        </footer>
    </body>
</html>