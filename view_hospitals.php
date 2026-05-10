<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Hospitals</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        td {
            background-color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        .add-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
        }
        .add-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Hospital List</h2>

<!-- Add Hospital Button -->
<a href="add_hospital.php" class="add-button">Add New Hospital</a>

<table>
    <tr>
        <th>Hospital Name</th>
        <th>Location</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

<?php
include 'db.php';

$sql = "SELECT * FROM Hospital";
$stmt = sqlsrv_query($conn, $sql);

while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['Hospital_Name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Location']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Phone_Number']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
    echo "<td>
            <a href='edit_hospital.php?id=" . $row['Hospital_ID'] . "'>Edit</a> | 
            <a href='delete_hospital.php?id=" . $row['Hospital_ID'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
          </td>";
    echo "</tr>";
}
?>

</table>

</body>
</html>
