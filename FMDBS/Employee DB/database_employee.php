<?php

    $hostName = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "facility_management_system_db";
    $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
    if (!$conn) {
        die("Something went wrong!");
    }

?>