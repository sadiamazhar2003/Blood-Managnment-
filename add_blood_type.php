<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blood_group = $_POST['blood_group'];
    $rh_factor = $_POST['rh_factor'];
    $description = $_POST['description'];
    $compatible_blood_types = $_POST['compatible_blood_types'];
    $storage_requirements = $_POST['storage_requirements'];
    $maximum_storage_duration = $_POST['maximum_storage_duration'];
    $average_donation_volume = $_POST['average_donation_volume'];
    $plasma_compatibility = $_POST['plasma_compatibility'];
    $platelet_compatibility = $_POST['platelet_compatibility'];

    $sql = "INSERT INTO Blood_Type (Blood_Group, Rh_Factor, Description, Compatible_Blood_Types, Storage_Requirements, 
                                     Maximum_Storage_Duration, Average_Donation_Volume, Plasma_Compatibility, Platelet_Compatibility)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [$blood_group, $rh_factor, $description, $compatible_blood_types, $storage_requirements, 
               $maximum_storage_duration, $average_donation_volume, $plasma_compatibility, $platelet_compatibility];
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Blood Type added successfully!";
    header("Location: view_blood_types.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Blood Type</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f9f9f9;">
    <h2 style="color: #333;">Add Blood Type</h2>
    <form method="POST" style="max-width: 500px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Blood Group:</label>
        <input type="text" name="blood_group" required style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Rh Factor:</label>
        <input type="text" name="rh_factor" required style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Description:</label>
        <textarea name="description" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;"></textarea>

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Compatible Blood Types:</label>
        <textarea name="compatible_blood_types" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;"></textarea>

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Storage Requirements:</label>
        <textarea name="storage_requirements" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;"></textarea>

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Maximum Storage Duration (days):</label>
        <input type="number" name="maximum_storage_duration" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Average Donation Volume (ml):</label>
        <input type="number" step="0.1" name="average_donation_volume" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Plasma Compatibility:</label>
        <textarea name="plasma_compatibility" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;"></textarea>

        <label style="display: block; margin-bottom: 8px; font-weight: bold;">Platelet Compatibility:</label>
        <textarea name="platelet_compatibility" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;"></textarea>

        <button type="submit" style="background-color: #f44336; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">Add Blood Type</button>
    </form>
</body>
</html>
