<?php
include 'db.php';

$sql = "SELECT d.*, bt.Blood_Group, bt.Rh_Factor FROM Donor d
        JOIN Blood_Type bt ON d.Blood_Type_ID = bt.Blood_Type_ID";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die("<p>Error fetching donors: " . print_r(sqlsrv_errors(), true) . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Donors</title>
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
    <h2>Donor List</h2>
    <a href="add_donor.php" class="add-link">Add Donor</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Blood Type</th>
                <th>Last Donation Date</th>
                <th>Health Status</th>
                <th>Number of Donations</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td><?= htmlspecialchars($row['Name']) ?></td>
                <td><?= htmlspecialchars($row['Age']) ?></td>
                <td><?= htmlspecialchars($row['Gender']) ?></td>
                <td><?= htmlspecialchars($row['Address']) ?></td>
                <td><?= htmlspecialchars($row['Phone_Number']) ?></td>
                <td><?= htmlspecialchars($row['Email']) ?></td>
                <td><?= htmlspecialchars($row['Blood_Group'] . " " . $row['Rh_Factor']) ?></td>
                <td><?= $row['Last_Donation_Date'] ? $row['Last_Donation_Date']->format('Y-m-d') : 'N/A' ?></td>
                <td><?= htmlspecialchars($row['Health_Status']) ?></td>
                <td><?= htmlspecialchars($row['Number_of_Donations']) ?></td>
                <td class="actions">
                    <a href="edit_donor.php?id=<?= $row['Donor_ID'] ?>">Edit</a> |
                    <a href="delete_donor.php?id=<?= $row['Donor_ID'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
