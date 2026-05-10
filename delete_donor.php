<?php
include 'db.php';

if (isset($_GET['id'])) {
    $donor_id = $_GET['id'];
    $sql = "DELETE FROM Donor WHERE Donor_ID = ?";
    $stmt = sqlsrv_query($conn, $sql, [$donor_id]);

    if ($stmt === false) {
        die("<p>Error deleting donor: " . print_r(sqlsrv_errors(), true) . "</p>");
    }

    header("Location: view_donors.php");
    exit;
}
?>
