<?php
include 'db.php';

// Fetch departments and medical staff for dropdowns
$departments = sqlsrv_query($conn, "SELECT * FROM Department");
$staff = sqlsrv_query($conn, "SELECT * FROM Medical_Staff");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values
    $equipment_name = $_POST['equipment_name'];
    $equipment_type = $_POST['equipment_type'];
    $maintenance_schedule = $_POST['maintenance_schedule'];
    $installation_date = $_POST['installation_date'];
    $warranty_period = $_POST['warranty_period'];
    $manufacturer_details = $_POST['manufacturer_details'];
    $department_id = $_POST['department_id'];
    $assigned_staff_id = $_POST['assigned_staff_id'];
    $status = $_POST['status'];

    // Insert new equipment into the database
    $sql = "INSERT INTO Equipment (Equipment_Name, Equipment_Type, Maintenance_Schedule, Installation_Date, Warranty_Period, Manufacturer_Details, Department_ID, Assigned_Staff_ID, Status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [
        $equipment_name, $equipment_type, $maintenance_schedule, $installation_date, $warranty_period,
        $manufacturer_details, $department_id, $assigned_staff_id, $status
    ];

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Equipment added successfully!";
    header("Location: view_equipment.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Equipment</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px; line-height: 1.6;">
    <h2 style="color: #333; text-align: center;">Add Equipment</h2>
    <form method="POST" style="max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <label style="display: block; margin-bottom: 8px;">Equipment Name:</label>
        <input type="text" name="equipment_name" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Equipment Type:</label>
        <input type="text" name="equipment_type" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Maintenance Schedule:</label>
        <input type="text" name="maintenance_schedule" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Installation Date:</label>
        <input type="date" name="installation_date" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Warranty Period (months):</label>
        <input type="number" name="warranty_period" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Manufacturer Details:</label>
        <textarea name="manufacturer_details" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;"></textarea>

        <label style="display: block; margin-bottom: 8px;">Department:</label>
        <select name="department_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php while ($row = sqlsrv_fetch_array($departments, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Department_ID'] ?>"><?= $row['Department_Name'] ?></option>
            <?php endwhile; ?>
        </select>

        <label style="display: block; margin-bottom: 8px;">Assigned Medical Staff:</label>
        <select name="assigned_staff_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php while ($row = sqlsrv_fetch_array($staff, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Medical_Staff_ID'] ?>"><?= $row['Name'] ?></option>
            <?php endwhile; ?>
        </select>

        <label style="display: block; margin-bottom: 8px;">Status:</label>
        <input type="text" name="status" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <div style="text-align: center; margin-top: 20px;">
            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Add Equipment</button>
        </div>
    </form>
</body>
</html>

