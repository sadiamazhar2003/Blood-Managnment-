<?php
include 'db.php';

if (isset($_GET['id'])) {
    $blood_type_id = $_GET['id'];

    $sql = "DELETE FROM Blood_Type WHERE Blood_Type_ID = ?";
    $stmt = sqlsrv_query($conn, $sql, [$blood_type_id]);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Blood Type deleted successfully!";
    header("Location: view_blood_types.php");
}
?>
