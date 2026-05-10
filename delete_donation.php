<?php
include 'db.php';

if (isset($_GET['id'])) {
    $donation_id = $_GET['id'];

    // Delete the donation entry
    $sql = "DELETE FROM Donation WHERE Donation_ID = ?";
    $stmt = sqlsrv_query($conn, $sql, [$donation_id]);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Donation deleted successfully!";
    header("Location: view_donations.php");
    exit;
}
?>
