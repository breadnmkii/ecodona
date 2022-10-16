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
        <!-- style sheet -->
    </head>

    <body>
        <!-- eveything needs to be flexed -->
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
            </div>
            <p class="profile-double-field">
                City: <?php echo htmlentities($city) ?>
                State: <?php echo htmlentities($state) ?>
            </p>
            <p class="profile-double-field">
                Zip Code: <?php echo htmlentities($city) ?>
                Country: <?php echo htmlentities($state) ?>
            </p>

        </section>
    </body>

</html>