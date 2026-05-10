<?php
include 'db.php';

if (isset($_GET['id'])) {
    $storage_id = $_GET['id'];

    // Delete the blood storage entry
    $sql = "DELETE FROM Blood_Storage WHERE Storage_ID = ?";
    $stmt = sqlsrv_query($conn, $sql, [$storage_id]);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Blood Storage deleted successfully!";
    header("Location: view_blood_storage.php");
    exit;
}
?>
