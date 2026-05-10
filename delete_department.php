<?php
include 'db.php';

if (isset($_GET['id'])) {
    $department_id = $_GET['id'];

    // Check if the department exists
    $check_sql = "SELECT * FROM Department WHERE Department_ID = ?";
    $check_stmt = sqlsrv_query($conn, $check_sql, [$department_id]);

    if ($check_stmt === false || sqlsrv_has_rows($check_stmt) === false) {
        die("Department not found.");
    }

    // Delete the department
    $delete_sql = "DELETE FROM Department WHERE Department_ID = ?";
    $delete_stmt = sqlsrv_query($conn, $delete_sql, [$department_id]);

    if ($delete_stmt === false) {
        echo "Error deleting department:";
        foreach (sqlsrv_errors() as $error) {
            echo "SQLSTATE: " . $error['SQLSTATE'] . " Message: " . $error['message'] . "<br>";
        }
    } else {
        echo "Department deleted successfully!";
        header("Location: view_department.php");
    }
} else {
    die("Invalid department ID.");
}
?>
