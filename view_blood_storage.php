<?php
include 'db.php';

// Fetch all blood storage units with their associated blood type and equipment
$sql = "SELECT Blood_Storage.*, Blood_Type.Blood_Group, Equipment.Equipment_Name
        FROM Blood_Storage
        JOIN Blood_Type ON Blood_Storage.Blood_Type_ID = Blood_Type.Blood_Type_ID
        JOIN Equipment ON Blood_Storage.Equipment_ID = Equipment.Equipment_ID";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Blood Storage</title>
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
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .actions {
            text-align: center;
        }
        .add-link {
            display: block;
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
    <h2>View Blood Storage</h2>
    <table>
        <thead>
            <tr>
                <th>Blood Type</th>
                <th>Storage Location</th>
                <th>Storage Capacity</th>
                <th>Current Stock</th>
                <th>Storage Temperature</th>
                <th>Storage Facility Type</th>
                <th>Maintenance Date</th>
                <th>Shelf Life (Days)</th>
                <th>Equipment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td><?= $row['Blood_Group'] ?></td>
                <td><?= $row['Storage_Location'] ?></td>
                <td><?= $row['Storage_Capacity'] ?></td>
                <td><?= $row['Current_Stock'] ?></td>
                <td><?= $row['Storage_Temperature'] ?></td>
                <td><?= $row['Storage_Facility_Type'] ?></td>
                <td><?= $row['Maintenance_Date']->format('Y-m-d') ?></td>
                <td><?= $row['Shelf_Life_Days'] ?></td>
                <td><?= $row['Equipment_Name'] ?></td>
                <td class="actions">
                    <a href="edit_blood_storage.php?id=<?= $row['Storage_ID'] ?>">Edit</a> |
                    <a href="delete_blood_storage.php?id=<?= $row['Storage_ID'] ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="add_blood_storage.php" class="add-link">Add New Blood Storage</a>
</body>
</html>

