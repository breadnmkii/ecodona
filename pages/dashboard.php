<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php
        session_start();
        require 'connectdatabase.php';
        $username = $_SESSION['user_id'];
    ?>
   


<?php

//display user's stories in DonationData database 
//Use prepare statement to get donation attributes
$stmt = $mysqli->prepare('SELECT DonationID, ReceiptID, UserID, CharityID, Date, ValueUSD FROM DonationData WHERE UserID = $username');

if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

//Bind the parameter
$stmt->bind_result($donation_id, $receipt_id, $user_id, $charity_id, $date, $value_usd);
$stmt->execute();

while ($stmt->fetch()) {

}
$stmt->close();
?>
    
</body>
</html>