<?php
include 'db.php';

if (isset($_GET['id'])) {
    $recipient_id = $_GET['id'];

    // Delete the recipient record
    $sql = "DELETE FROM Recipient WHERE Recipient_ID = ?";
    $stmt = sqlsrv_query($conn, $sql, [$recipient_id]);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Recipient deleted successfully!";
    header("Location: view_recipients.php");
    exit;
}
?>
