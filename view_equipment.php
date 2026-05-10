<?php
include 'db.php';

// Fetch all equipment records
$sql = "SELECT * FROM Equipment";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Equipment</title>
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
    <h2>View Equipment</h2>
    <a href="add_equipment.php" class="add-link">Add New Equipment</a>
    <table>
        <thead>
            <tr>
                <th>Equipment Name</th>
                <th>Equipment Type</th>
                <th>Department</th>
                <th>Assigned Staff</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td><?= htmlspecialchars($row['Equipment_Name']) ?></td>
                <td><?= htmlspecialchars($row['Equipment_Type']) ?></td>
                <td><?= htmlspecialchars($row['Department_Name'] ?? 'N/A') ?></td> <!-- Fetch department name if needed -->
                <td><?= htmlspecialchars($row['Assigned_Staff_Name'] ?? 'N/A') ?></td> <!-- Fetch assigned staff name if needed -->
                <td><?= htmlspecialchars($row['Status']) ?></td>
                <td class="actions">
                    <a href="edit_equipment.php?id=<?= $row['Equipment_ID'] ?>">Edit</a> |
                    <a href="delete_equipment.php?id=<?= $row['Equipment_ID'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

