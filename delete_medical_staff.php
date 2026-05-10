<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the medical staff
    $sql = "DELETE FROM Medical_Staff WHERE Medical_Staff_ID = ?";
    $stmt = sqlsrv_query($conn, $sql, [$id]);

    if ($stmt === false) {
        echo "Error deleting Medical Staff:";
        foreach (sqlsrv_errors() as $error) {
            echo "SQLSTATE: " . $error['SQLSTATE'] . " Message: " . $error['message'] . "<br>";
        }
    } else {
        echo "Medical Staff deleted successfully!";
        header("Location: view_medical_staff.php");
    }
} else {
    echo "Invalid request.";
    exit;
}
?>
