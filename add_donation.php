<?php
include 'db.php';

// Fetch Donors, Blood Types, and Blood Storage units for dropdowns
$donors = sqlsrv_query($conn, "SELECT * FROM Donor");
$blood_types = sqlsrv_query($conn, "SELECT * FROM Blood_Type");
$blood_storage = sqlsrv_query($conn, "SELECT * FROM Blood_Storage");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values
    $donor_id = $_POST['donor_id'];
    $blood_type_id = $_POST['blood_type_id'];
    $donation_date = $_POST['donation_date'];
    $quantity = $_POST['quantity'];
    $expiration_date = $_POST['expiration_date'];
    $donation_location = $_POST['donation_location'];
    $donation_status = $_POST['donation_status'];
    $testing_results = $_POST['testing_results'];
    $storage_id = $_POST['storage_id'];

    // Insert new donation into the database
    $sql = "INSERT INTO Donation (Donor_ID, Blood_Type_ID, Donation_Date, Quantity, Expiration_Date, 
            Donation_Location, Donation_Status, Testing_Results, Storage_ID) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [
        $donor_id, $blood_type_id, $donation_date, $quantity, $expiration_date, 
        $donation_location, $donation_status, $testing_results, $storage_id
    ];

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Donation added successfully!";
    header("Location: view_donations.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Donation</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px; line-height: 1.6;">
    <h2 style="color: #333; text-align: center;">Add Donation</h2>
    <form method="POST" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <label style="display: block; margin-bottom: 8px;">Donor:</label>
        <select name="donor_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php while ($row = sqlsrv_fetch_array($donors, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Donor_ID'] ?>"><?= $row['Name'] ?></option>
            <?php endwhile; ?>
        </select>

        <label style="display: block; margin-bottom: 8px;">Blood Type:</label>
        <select name="blood_type_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php while ($row = sqlsrv_fetch_array($blood_types, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Blood_Type_ID'] ?>"><?= $row['Blood_Group'] ?> - <?= $row['Rh_Factor'] ?></option>
            <?php endwhile; ?>
        </select>

        <label style="display: block; margin-bottom: 8px;">Donation Date:</label>
        <input type="date" name="donation_date" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Quantity (ml):</label>
        <input type="number" name="quantity" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Expiration Date:</label>
        <input type="date" name="expiration_date" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Donation Location:</label>
        <input type="text" name="donation_location" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Donation Status:</label>
        <input type="text" name="donation_status" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Testing Results:</label>
        <input type="text" name="testing_results" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Blood Storage:</label>
        <select name="storage_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php while ($row = sqlsrv_fetch_array($blood_storage, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Storage_ID'] ?>"><?= $row['Storage_Location'] ?> (Capacity: <?= $row['Storage_Capacity'] ?>)</option>
            <?php endwhile; ?>
        </select>

        <button type="submit" style="width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
            Add Donation
        </button>
    </form>
</body>
</html>
