<?php
include 'db.php';

// Fetch blood types and equipment for dropdowns
$blood_types = sqlsrv_query($conn, "SELECT * FROM Blood_Type");
$equipment = sqlsrv_query($conn, "SELECT * FROM Equipment");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values
    $blood_type_id = $_POST['blood_type_id'];
    $storage_location = $_POST['storage_location'];
    $storage_capacity = $_POST['storage_capacity'];
    $current_stock = $_POST['current_stock'];
    $storage_temperature = $_POST['storage_temperature'];
    $storage_facility_type = $_POST['storage_facility_type'];
    $maintenance_date = $_POST['maintenance_date'];
    $shelf_life_days = $_POST['shelf_life_days'];
    $equipment_id = $_POST['equipment_id'];

    // Insert new blood storage into the database
    $sql = "INSERT INTO Blood_Storage (Blood_Type_ID, Storage_Location, Storage_Capacity, Current_Stock, Storage_Temperature, 
            Storage_Facility_Type, Maintenance_Date, Shelf_Life_Days, Equipment_ID) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [
        $blood_type_id, $storage_location, $storage_capacity, $current_stock, 
        $storage_temperature, $storage_facility_type, $maintenance_date, 
        $shelf_life_days, $equipment_id
    ];

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Blood Storage added successfully!";
    header("Location: view_blood_storage.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Blood Storage</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f9f9f9;">
    <h2 style="color: #333;">Add Blood Storage</h2>
    <form method="POST" style="max-width: 500px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Blood Type:</label>
        <select name="blood_type_id" required style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">
            <?php while ($row = sqlsrv_fetch_array($blood_types, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Blood_Type_ID'] ?>"><?= $row['Blood_Group'] ?> - <?= $row['Rh_Factor'] ?></option>
            <?php endwhile; ?>
        </select>

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Storage Location:</label>
        <input type="text" name="storage_location" required style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Storage Capacity:</label>
        <input type="number" name="storage_capacity" required style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Current Stock:</label>
        <input type="number" name="current_stock" required style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Storage Temperature:</label>
        <input type="text" name="storage_temperature" required style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Storage Facility Type:</label>
        <input type="text" name="storage_facility_type" required style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Maintenance Date:</label>
        <input type="date" name="maintenance_date" required style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Shelf Life (Days):</label>
        <input type="number" name="shelf_life_days" required style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Equipment:</label>
        <select name="equipment_id" required style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">
            <?php while ($row = sqlsrv_fetch_array($equipment, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Equipment_ID'] ?>"><?= $row['Equipment_Name'] ?> (<?= $row['Equipment_Type'] ?>)</option>
            <?php endwhile; ?>
        </select>

        <button type="submit" style="background-color: #f44336; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">Add Blood Storage</button>
    </form>
</body>
</html>
