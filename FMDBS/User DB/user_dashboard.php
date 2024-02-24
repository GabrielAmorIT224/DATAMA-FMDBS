<?php
include 'database_user.php';
session_start(); // Start the session

if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login_user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".reserve-btn").click(function(){
                var facilityId = $(this).data('facility-id');
                var confirmReservation = confirm("Do you want to reserve this facility?");
                
                if(confirmReservation) {
                    // Send reservation request to the server using AJAX
                    $.ajax({
                        url: 'reserve_facility.php',
                        type: 'POST',
                        data: { facilityId: facilityId },
                        success: function(response) {
                            alert(response);
                        },
                        error: function() {
                            alert("An error occurred during reservation.");
                        }
                    });
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Welcome to User Dashboard</h1>
        <a href="logout_user.php" class="btn btn-warning">Logout</a>

        <h2>Facilities</h2>

        <?php
            // Fetch and display facilities with reserve button
            $sql = "SELECT f.*, fs.FACILITY_STATUS
                    FROM tbl_facility f
                    INNER JOIN tbl_facility_status fs ON f.FACILITY_STATUS_ID = fs.FACILITY_STATUS_ID";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $facilityType = $row["FACILITY_TYPE"];
                    $facilityStatus = $row["FACILITY_STATUS"];
                    $facilityId = $row["FACILITY_ID"];

                    // Output facility information and button if available
                    echo "<li>" . $facilityType . " - Status: " . $facilityStatus;

                    // Check if the facility is available and display the button accordingly
                    if (strtolower($facilityStatus) == 'available') {
                        echo " <button class='btn btn-primary reserve-btn' data-facility-id='" . $facilityId . "'>Reserve</button>";
                    }
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "No facilities found.";
            }
        ?>

        <hr>

        <h2>Ongoing Reservations</h2>

        <?php
            // Fetch and display ongoing reservations for the user
            $userId = $_SESSION["user_id"];
            $reservationSql = "SELECT r.*, f.FACILITY_TYPE, rs.RESERVATION_DESC, r.RESERVATION_DATE, r.RESERVATION_TIME
                                FROM tbl_reservation r
                                INNER JOIN tbl_facility f ON r.FACILITY_ID = f.FACILITY_ID
                                INNER JOIN tbl_reservation_status rs ON r.RESERVATION_STATUS_ID = rs.RESERVATION_STATUS_ID
                                WHERE r.USER_ID = $userId
                                AND r.RESERVATION_STATUS_ID IN (1, 2, 3)";

            $reservationResult = mysqli_query($conn, $reservationSql);

            if (mysqli_num_rows($reservationResult) > 0) {
                echo "<ul>";
                while ($reservationRow = mysqli_fetch_assoc($reservationResult)) {
                    echo "<li>" . $reservationRow["FACILITY_TYPE"] . " - Status: " . $reservationRow["RESERVATION_DESC"] . " - Date: " . $reservationRow["RESERVATION_DATE"] . " - Time: " . $reservationRow["RESERVATION_TIME"] . "</li>";
                }
                echo "</ul>";
            } else {
                echo "No ongoing reservations found.";
            }
        ?>
    </div>
</body>
</html>

<?php
    // Close the database connection (optional, as PHP automatically closes it at the end of the script)
    mysqli_close($conn);
?>

