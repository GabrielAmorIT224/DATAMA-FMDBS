<?php
include 'database_user.php';
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION["user_id"];
    $facilityId = $_POST['facilityId'];

    // Assuming 1 is the status for a new reservation
    $statusId = 1;

    // Update the reservation status based on the action
    $insertReservationSql = "INSERT INTO tbl_reservation (USER_ID, FACILITY_ID, RESERVATION_STATUS_ID, RESERVATION_DATE, RESERVATION_TIME) 
                             VALUES ($userId, $facilityId, $statusId, CURRENT_DATE(), CURRENT_TIME())";

    if (mysqli_query($conn, $insertReservationSql)) {
        echo "Reservation successful.";
    } else {
        echo "Error during reservation: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
