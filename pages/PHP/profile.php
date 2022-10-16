<?php
require 'database.php';
session_start(); //starts the user session
$user_id = htmlentities($_SESSION['user_id']); //get the userid

//i wanna kill myself
//arrays to store the information -- charity-name, total-charity-sum, 
$stmt = $mysqli->prepare("UserId, Firstname, Lastname, Email, Phone, Country, State, City, Street, Postal, DonutBalance FROM UserInfo WHERE UserId=?"); //recheck the users database

// Bind the parameter
$stmt->bind_param('s', $user_id);
$stmt->execute();

// Bind the results
$stmt->bind_result($user_id_data, $firstname, $lastname, $email, $phone, $country, $state, $city, $street, $postal, $donut_balance);
$stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <!-- style sheet -->
</head>

<body> 
    <!-- eveything needs to be flexed -->
    <section class="side-nav">

    </section>
    <section id="profile-settings">

    </section>
    <section class="profile-info">

        <p class="profile-double-field">
            First Name: <?php echo htmlentities($firstname) ?>
            Last Name: <?php echo htmlentities($lastname) ?>
        </p>
        <div class="profile-single-field">
            <p>
            Phone Number: <?php echo htmlentities($phone) ?>
            </p>
            <p>
            Email: <?php echo htmlentities($email) ?>
            </p>
            <p>
            Address: <?php echo htmlentities($address) ?>
            </p>
        </div>

    </section>
</body>

</html>