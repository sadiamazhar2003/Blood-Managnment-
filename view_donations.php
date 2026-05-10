<?php
include 'db.php';

// Fetch all donations with their associated donor, blood type, and storage unit
$sql = "SELECT Donation.*, Donor.Name AS Donor_Name, Blood_Type.Blood_Group, Blood_Storage.Storage_Location
        FROM Donation
        JOIN Donor ON Donation.Donor_ID = Donor.Donor_ID
        JOIN Blood_Type ON Donation.Blood_Type_ID = Blood_Type.Blood_Type_ID
        JOIN Blood_Storage ON Donation.Storage_ID = Blood_Storage.Storage_ID";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Donations</title>
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
        .actions {
            text-align: center;
        }
        .add-link {
            display: inline-block;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .add-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>View Donations</h2>
    <table>
        <thead>
            <tr>
                <th>Donor</th>
                <th>Blood Type</th>
                <th>Donation Date</th>
                <th>Quantity</th>
                <th>Expiration Date</th>
                <th>Donation Location</th>
                <th>Donation Status</th>
                <th>Testing Results</th>
                <th>Storage Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td><?= htmlspecialchars($row['Donor_Name']) ?></td>
                <td><?= htmlspecialchars($row['Blood_Group']) ?></td>
                <td><?= $row['Donation_Date']->format('Y-m-d') ?></td>
                <td><?= $row['Quantity'] ?></td>
                <td><?= $row['Expiration_Date']->format('Y-m-d') ?></td>
                <td><?= htmlspecialchars($row['Donation_Location']) ?></td>
                <td><?= htmlspecialchars($row['Donation_Status']) ?></td>
                <td><?= htmlspecialchars($row['Testing_Results']) ?></td>
                <td><?= htmlspecialchars($row['Storage_Location']) ?></td>
                <td class="actions">
                    <a href="edit_donation.php?id=<?= $row['Donation_ID'] ?>">Edit</a> | 
                    <a href="delete_donation.php?id=<?= $row['Donation_ID'] ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <a href="add_donation.php" class="add-link">Add New Donation</a>
</body>
</html>

