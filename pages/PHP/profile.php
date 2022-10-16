<?php
require 'helper/database.php';
session_start(); //starts the user session
$user_id = htmlentities($_SESSION['user_id']); //get the userid

//i wanna kill myself
//arrays to store the information -- charity-name, total-charity-sum, 
$stmt = $mysqli->prepare("SELECT UserID, Firstname, Lastname, Email, Phone, Country, State, City, Street, Postal, DonutBalance FROM UserInfo WHERE UserID=?"); //recheck the users database

// Bind the parameter
$stmt->bind_param('i', $user_id);
if (!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->execute();

// Bind the results
$stmt->bind_result($user_id_data, $firstname, $lastname, $email, $phone, $country, $state, $city, $street, $postal, $donut_balance);
$stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/user.css">

</head>

<body>
    <!-- eveything needs to be flexed -->
    <div class="content-body">
        <section class="side">
            <div class="side-nav">
                <ul>
                    <li>
                        <a href="../dashboard.html">
                            <h5>Dashboard</h5>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h5>Upload Receipts</h5>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h5>Donate Donuts</h5>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h5>My Rewards</h5>
                        </a>
                    </li>
                    <li>
                        <a href="profile.php">
                            <h5>Profile</h5>
                        </a>
                    </li>
                </ul>
            </div>

        </section>
        <div class="content">
            <section id="profile-settings">
                <div class="profile-card">
                    <h4>
                        Account Setting
                    </h4>
                    <p>
                        Personalize your account
                    </p>
                </div>
                <div class="profile-card">
                    <h4>
                        Password and Security
                    </h4>
                    <p>
                        Details about your personal information
                    </p>
                </div>
                <div class="profile-card">
                    <h4>
                        Invite a Friend
                    </h4>
                    <p>
                        Recruit friends to raise more
                    </p>
                </div>
                <div class="profile-card">
                    <h4>
                        Help Center
                    </h4>
                    <p>
                        View tutorials, Guides, FAQ
                    </p>
                </div>

            </section>
            <section class="profile-info">

                <div class="profile-double-field">
                    <p>
                        First Name: <?php echo htmlentities($firstname) ?>
                    </p>
                    <p>
                        Last Name: <?php echo htmlentities($lastname) ?>
                    </p>
                </div>
                <div class="profile-single-field">
                    <p>
                        Phone Number: <?php echo htmlentities($phone) ?>
                    </p>
                    <p>
                        Email: <?php echo htmlentities($email) ?>
                    </p>
                </div>
                <div class="profile-double-field">
                    <p>
                        City: <?php echo htmlentities($city) ?>
                    </p>
                    <p>
                        State: <?php echo htmlentities($state) ?>
                    </p>
                </div>
                <div class="profile-double-field">
                    <p>
                        Zip Code: <?php echo htmlentities($city) ?>
                    </p>
                    <p>
                        Country: <?php echo htmlentities($state) ?>
                    </p>

                </div>

            </section>
        </div>
    </div>
</body>

</html>