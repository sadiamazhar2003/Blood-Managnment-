<?php
$serverName = "DESKTOP-B0M0RE8\SQLEXPRESS"; // Your server name
$connectionOptions = array(
    "Database" => "BMS database", // Your database name
    "Uid" => "", // Your username
    "PWD" => ""  // Your password
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn) {
    echo '<div style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin: 20px 0; font-family: Arial, sans-serif;">Connection successful!</div>';
} else {
    echo '<div style="padding: 10px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; margin: 20px 0; font-family: Arial, sans-serif;">Connection failed: ' . print_r(sqlsrv_errors(), true) . '</div>';
}
?>
