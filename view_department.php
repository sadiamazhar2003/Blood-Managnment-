<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Departments</title>
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
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
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
    <h2>Department List</h2>
    <a href="create_department.php" class="add-link">Add Department</a><br><br>
    <table>
        <thead>
            <tr>
                <th>Department Name</th>
                <th>Head of Department</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Hospital</th>
                <th>Number of Staff</th>
                <th>Number of Patients</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT D.*, H.Hospital_Name, M.Name AS Head_Name 
                    FROM Department D 
                    LEFT JOIN Hospital H ON D.Hospital_ID = H.Hospital_ID
                    LEFT JOIN Medical_Staff M ON D.Head_of_Department = M.Medical_Staff_ID";
            $stmt = sqlsrv_query($conn, $sql);

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['Department_Name'] . "</td>";
                echo "<td>" . ($row['Head_Name'] ?? 'None') . "</td>";
                echo "<td>" . $row['Phone_Number'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . $row['Hospital_Name'] . "</td>";
                echo "<td>" . $row['Number_of_Staff'] . "</td>";
                echo "<td>" . $row['Number_of_Patients'] . "</td>";
                echo "<td class='actions'>
                        <a href='edit_department.php?id=" . $row['Department_ID'] . "'>Edit</a> | 
                        <a href='delete_department.php?id=" . $row['Department_ID'] . "'>Delete</a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

