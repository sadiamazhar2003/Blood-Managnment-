<?php
include 'db.php';

$sql = "SELECT MS.Medical_Staff_ID, MS.Name, MS.Position, MS.Phone_Number, MS.Email, MS.Department, 
        MS.License_Number, MS.Years_of_Experience, H.Hospital_Name, MS.Specialization, MS.Shift_Timings 
        FROM Medical_Staff MS
        JOIN Hospital H ON MS.Assigned_Hospital = H.Hospital_ID";

$stmt = sqlsrv_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Medical Staff</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
        }
        h2 {
            text-align: center;
            color: #343a40;
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
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f1f1f1;
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
    </style>
</head>
<body>

<h2>Medical Staff List</h2>

<!-- Add Medical Staff Button -->
<a href="add_medical_staff.php" style="display: inline-block; padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; margin: 10px 0;">Add New Medical Staff</a>

<table>
    <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Department</th>
        <th>Hospital</th>
        <th>Specialization</th>
        <th>Shift Timings</th>
        <th>Actions</th>
    </tr>

<?php
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Position']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Phone_Number']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Department']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Hospital_Name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Specialization']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Shift_Timings']) . "</td>";
    echo "<td>
            <a href='edit_medical_staff.php?id=" . $row['Medical_Staff_ID'] . "'>Edit</a> | 
            <a href='delete_medical_staff.php?id=" . $row['Medical_Staff_ID'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
          </td>";
    echo "</tr>";
}
?>

</table>

</body>
</html>
