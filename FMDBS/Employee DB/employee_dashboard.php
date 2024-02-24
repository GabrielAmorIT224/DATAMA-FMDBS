<?php
include 'database_employee.php';
session_start(); // Start the session

if (!isset($_SESSION["employee_id"])) {
    // Redirect to the login page if the employee is not logged in
    header("Location: login_employee.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to Employee Dashboard</h1>
        <a href="logout_employee.php" class="btn btn-warning">Logout</a>

        <h2>Reservations</h2>

        <?php
            // Fetch and display reservations in chronological order
            $sql = "SELECT r.*, f.FACILITY_TYPE, CONCAT(u.FIRST_NAME, ' ', u.LAST_NAME) AS USER_NAME, rs.RESERVATION_DESC
                    FROM tbl_reservation r
                    INNER JOIN tbl_facility f ON r.FACILITY_ID = f.FACILITY_ID
                    INNER JOIN tbl_user u ON r.USER_ID = u.USER_ID
                    INNER JOIN tbl_reservation_status rs ON r.RESERVATION_STATUS_ID = rs.RESERVATION_STATUS_ID
                    ORDER BY r.RESERVATION_ID ASC"; // Added ORDER BY clause
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table'>";
                echo "<thead><tr><th>Reservation ID</th><th>Facility Type</th><th>User</th><th>Status</th><th>Action</th></tr></thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["RESERVATION_ID"] . "</td>";
                    echo "<td>" . $row["FACILITY_TYPE"] . "</td>";
                    echo "<td>" . $row["USER_NAME"] . "</td>";
                    echo "<td>" . $row["RESERVATION_DESC"] . "</td>";
                    echo "<td>
                            <button class='btn btn-success approve-btn' data-reservation-id='" . $row["RESERVATION_ID"] . "'>Approve</button>
                            <button class='btn btn-danger decline-btn' data-reservation-id='" . $row["RESERVATION_ID"] . "'>Decline</button>
                          </td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "No reservations found.";
            }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".approve-btn, .decline-btn").click(function(){
                var reservationId = $(this).data('reservation-id');
                var action = $(this).hasClass('approve-btn') ? 'approve' : 'decline';

                // Confirmation dialog
                var confirmationMessage = "Are you sure you want to " + (action === 'approve' ? 'approve' : 'decline') + " this reservation?";
                if (confirm(confirmationMessage)) {
                    // Send approval/decline request to the server using AJAX
                    $.ajax({
                        url: 'process_reservation.php',
                        type: 'POST',
                        data: { reservationId: reservationId, action: action },
                        success: function(response) {
                            alert(response);
                            // You may choose to refresh the reservation list or update the specific row in the table
                        },
                        error: function() {
                            alert("An error occurred during reservation processing.");
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>

<?php
    // Close the database connection (optional, as PHP automatically closes it at the end of the script)
    mysqli_close($conn);
?>

