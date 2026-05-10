<?php
include 'db.php';

if (isset($_GET['id'])) {
    $equipment_id = $_GET['id'];

    // Delete the equipment record
    $sql = "DELETE FROM Equipment WHERE Equipment_ID = ?";
    $stmt = sqlsrv_query($conn, $sql, [$equipment_id]);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Equipment deleted successfully!";
    header("Location: view_equipment.php");
    exit;
}
?>
