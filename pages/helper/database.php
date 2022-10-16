<?php

    $mysqli = new mysqli('localhost', 'ecodona', 'ecodona_pass', 'ecodonadb');

    if ($mysqli->connect_errno) {
        printf("Connection failed: $s\n", $mysqli->connect_error);
        exit;
    }

?>