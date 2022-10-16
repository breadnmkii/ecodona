<?php
    require 'helper/database.php';
    session_start(); //starts the user session

    header("Content-Type: application/json");

    $user_id = htmlentities($_SESSION['user_id']);

    // Arrays of data to return
    $charityNames = [];         # The name of the organization
    $charityDescs = [];          # The descriptions of the organizations
    $charityDonuts = [];    # The running sum of donuts donated to org
    
    // Prepare MySQL statement for array data
    $stmt = $mysqli->prepare("select CharityInfo.CharityName, CharityInfo.CharityDesc, DonationData.ValueUSD from DonationData join CharityInfo on (CharityInfo.CharityID=DonationData.CharityID) where DonationData.UserID = ?");
    if (!$stmt) {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        echo json_encode(array(
            "success" => false,
            "message" => "Query Prep Failed"
        ));
        exit;
    }

    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $stmt->bind_result($db_charityName, $db_charityDesc, $db_donutsDonated);

    while ($stmt->fetch()) {
        array_push($charityNames, htmlentities($db_charityName));
        array_push($charityDescs, htmlentities($db_charityDesc));
        array_push($charityDonuts, htmlentities($db_donutsDonated));
    }
    
    // Prepare MySQL statement for singular user data
    $stmt = $mysqli->prepare("select DonutBalance from UserInfo where UserID = ?");

    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $stmt->bind_result($db_donutBalance);
    $stmt->fetch();

    echo json_encode(array(
        "success" => true,
        "message" => "Donations fetched",
        "charityNames" => $charityNames,
        "charityDescs" => $charityDescs,
        "charityDonuts" => $charityDonuts,
        "donutBalance" => htmlentities($db_donutBalance)
    ));
    exit;



?>