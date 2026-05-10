<?php
include 'db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Delete hospital
    $sql = "DELETE FROM Hospital WHERE Hospital_ID = ?";
    $params = array($id);
    
    $stmt = sqlsrv_query($conn, $sql, $params);

    if($stmt === false) {
        echo "Error in deleting record.";
    } else {
        echo "Hospital deleted successfully!";
    }
}
?>
