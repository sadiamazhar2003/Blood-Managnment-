<?php
include 'db.php';

// Fetch all transfusions with associated recipient, donation, and medical staff
$sql = "SELECT Transfusion.*, Recipient.Name AS Recipient_Name, Donation.Donation_ID, Medical_Staff.Name AS Medical_Staff_Name
        FROM Transfusion
        JOIN Recipient ON Transfusion.Recipient_ID = Recipient.Recipient_ID
        JOIN Donation ON Transfusion.Donation_ID = Donation.Donation_ID
        JOIN Medical_Staff ON Transfusion.Medical_Staff_ID = Medical_Staff.Medical_Staff_ID";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Transfusions</title>
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

<h2>View Transfusions</h2>

<!-- Add Transfusion Button -->
<a href="add_transfusion.php" class="add-button">Add New Transfusion</a>

<table>
    <tr>
        <th>Recipient</th>
        <th>Donation ID</th>
        <th>Transfusion Date</th>
        <th>Medical Staff</th>
        <th>Quantity</th>
        <th>Transfusion Location</th>
        <th>Reaction Status</th>
        <th>Follow-Up Date</th>
        <th>Success Status</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
    <tr>
        <td><?= htmlspecialchars($row['Recipient_Name']) ?></td>
        <td><?= htmlspecialchars($row['Donation_ID']) ?></td>
        <td><?= $row['Transfusion_Date']->format('Y-m-d') ?></td>
        <td><?= htmlspecialchars($row['Medical_Staff_Name']) ?></td>
        <td><?= htmlspecialchars($row['Quantity']) ?></td>
        <td><?= htmlspecialchars($row['Transfusion_Location']) ?></td>
        <td><?= htmlspecialchars($row['Reaction_Status']) ?></td>
        <td><?= $row['Follow_Up_Date']->format('Y-m-d') ?></td>
        <td><?= htmlspecialchars($row['Success_Status']) ?></td>
        <td>
            <a href="edit_transfusion.php?id=<?= $row['Transfusion_ID'] ?>">Edit</a> |
            <a href="delete_transfusion.php?id=<?= $row['Transfusion_ID'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
