<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blood Types</title>
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
    <h2>Blood Types</h2>
    <a href="add_blood_type.php" class="add-link">Add Blood Type</a>
    <table>
        <thead>
            <tr>
                <th>Blood Group</th>
                <th>Rh Factor</th>
                <th>Description</th>
                <th>Compatible Blood Types</th>
                <th>Storage Requirements</th>
                <th>Maximum Storage Duration</th>
                <th>Average Donation Volume</th>
                <th>Plasma Compatibility</th>
                <th>Platelet Compatibility</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM Blood_Type";
            $stmt = sqlsrv_query($conn, $sql);

            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['Blood_Group'] . "</td>";
                echo "<td>" . $row['Rh_Factor'] . "</td>";
                echo "<td>" . $row['Description'] . "</td>";
                echo "<td>" . $row['Compatible_Blood_Types'] . "</td>";
                echo "<td>" . $row['Storage_Requirements'] . "</td>";
                echo "<td>" . $row['Maximum_Storage_Duration'] . "</td>";
                echo "<td>" . $row['Average_Donation_Volume'] . "</td>";
                echo "<td>" . $row['Plasma_Compatibility'] . "</td>";
                echo "<td>" . $row['Platelet_Compatibility'] . "</td>";
                echo "<td class='actions'>
                        <a href='edit_blood_type.php?id=" . $row['Blood_Type_ID'] . "'>Edit</a> | 
                        <a href='delete_blood_type.php?id=" . $row['Blood_Type_ID'] . "'>Delete</a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

