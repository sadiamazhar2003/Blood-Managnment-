<?php
include 'db.php';

// Fetch all recipients with their blood type and hospital
$sql = "SELECT Recipient.*, Blood_Type.Blood_Group, Hospital.Hospital_Name
        FROM Recipient
        JOIN Blood_Type ON Recipient.Blood_Type_ID = Blood_Type.Blood_Type_ID
        JOIN Hospital ON Recipient.Hospital_ID = Hospital.Hospital_ID";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Recipients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f1f1f1;
        }
        td {
            background-color: #fff;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
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
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .add-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<h2>View Recipients</h2>

<!-- Add Recipient Button -->
<a href="add_recipient.php" class="add-button">Add New Recipient</a>

<table>
    <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Blood Type</th>
        <th>Hospital</th>
        <th>Number of Transfusions</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
    <tr>
        <td><?= htmlspecialchars($row['Name']) ?></td>
        <td><?= htmlspecialchars($row['Age']) ?></td>
        <td><?= htmlspecialchars($row['Gender']) ?></td>
        <td><?= htmlspecialchars($row['Blood_Group']) ?></td>
        <td><?= htmlspecialchars($row['Hospital_Name']) ?></td>
        <td><?= htmlspecialchars($row['Number_of_Transfusions']) ?></td>
        <td>
            <a href="edit_recipient.php?id=<?= $row['Recipient_ID'] ?>">Edit</a> |
            <a href="delete_recipient.php?id=<?= $row['Recipient_ID'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
