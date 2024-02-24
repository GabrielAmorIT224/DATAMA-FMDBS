<?php
include 'database_employee.php'; // Assuming this file contains the database connection details for employees

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start(); // Start the session to access session variables
    $reservationId = $_POST['reservationId'];
    $action = $_POST['action'];
    $loggedInEmployeeId = $_SESSION['employee_id']; // Assuming the employee_id is stored in the session

    // Update reservation status and employee_id based on the action
    $statusId = ($action == 'approve') ? 2 : 3; // Assuming 2 is 'Approved' and 3 is 'Declined'
    $updateReservationSql = "UPDATE tbl_reservation SET RESERVATION_STATUS_ID = $statusId, EMPLOYEE_ID = $loggedInEmployeeId WHERE RESERVATION_ID = $reservationId";

    if (mysqli_query($conn, $updateReservationSql)) {
        echo "Reservation $action successful.";

        // Additional logic to update facility status based on the action
        if ($action == 'approve') {
            // Update facility_status_id to 'Unavailable' when a reservation is approved
            $updateFacilitySql = "UPDATE tbl_facility SET FACILITY_STATUS_ID = 2 WHERE FACILITY_ID IN (
                SELECT FACILITY_ID FROM tbl_reservation WHERE RESERVATION_ID = $reservationId
            )";

            if (mysqli_query($conn, $updateFacilitySql)) {
                echo " Facility status updated to 'Unavailable' in tbl_facility.";
            } else {
                echo " Error updating facility status in tbl_facility: " . mysqli_error($conn);
            }

            // Update facility_status_id to 'Unavailable' in tbl_reservation
            $updateReservationFacilitySql = "UPDATE tbl_reservation SET FACILITY_STATUS_ID = 2 WHERE RESERVATION_ID = $reservationId";

            if (mysqli_query($conn, $updateReservationFacilitySql)) {
                echo " Facility status updated to 'Unavailable' in tbl_reservation.";
            } else {
                echo " Error updating facility status in tbl_reservation: " . mysqli_error($conn);
            }
        } else {
            // Update facility_status_id to 'Available' when a reservation is declined
            $updateFacilitySql = "UPDATE tbl_facility SET FACILITY_STATUS_ID = 1 WHERE FACILITY_ID IN (
                SELECT FACILITY_ID FROM tbl_reservation WHERE RESERVATION_ID = $reservationId
            )";

            if (mysqli_query($conn, $updateFacilitySql)) {
                echo " Facility status updated to 'Available' in tbl_facility.";
            } else {
                echo " Error updating facility status in tbl_facility: " . mysqli_error($conn);
            }

            // Update facility_status_id to 'Available' in tbl_reservation
            $updateReservationFacilitySql = "UPDATE tbl_reservation SET FACILITY_STATUS_ID = 1 WHERE RESERVATION_ID = $reservationId";

            if (mysqli_query($conn, $updateReservationFacilitySql)) {
                echo " Facility status updated to 'Available' in tbl_reservation.";
            } else {
                echo " Error updating facility status in tbl_reservation: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Error during reservation $action: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
