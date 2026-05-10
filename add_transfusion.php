<?php
include 'db.php';

// Fetch Recipients, Donations, and Medical Staff for dropdowns
$recipients = sqlsrv_query($conn, "SELECT * FROM Recipient");
$donations = sqlsrv_query($conn, "SELECT * FROM Donation");
$medical_staff = sqlsrv_query($conn, "SELECT * FROM Medical_Staff");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values
    $recipient_id = $_POST['recipient_id'];
    $donation_id = $_POST['donation_id'];
    $transfusion_date = $_POST['transfusion_date'];
    $medical_staff_id = $_POST['medical_staff_id'];
    $quantity = $_POST['quantity'];
    $transfusion_location = $_POST['transfusion_location'];
    $reaction_status = $_POST['reaction_status'];
    $follow_up_date = $_POST['follow_up_date'];
    $success_status = $_POST['success_status'];

    // Insert new transfusion into the database
    $sql = "INSERT INTO Transfusion (Recipient_ID, Donation_ID, Transfusion_Date, Medical_Staff_ID, 
            Quantity, Transfusion_Location, Reaction_Status, Follow_Up_Date, Success_Status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [
        $recipient_id, $donation_id, $transfusion_date, $medical_staff_id, $quantity, 
        $transfusion_location, $reaction_status, $follow_up_date, $success_status
    ];

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Transfusion added successfully!";
    header("Location: view_transfusions.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Transfusion</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px; line-height: 1.6;">
    <h2 style="color: #333; text-align: center;">Add Transfusion</h2>
    <form method="POST" style="max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <label style="display: block; margin-bottom: 8px;">Recipient:</label>
        <select name="recipient_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php while ($row = sqlsrv_fetch_array($recipients, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Recipient_ID'] ?>"><?= $row['Name'] ?></option>
            <?php endwhile; ?>
        </select>

        <label style="display: block; margin-bottom: 8px;">Donation:</label>
        <select name="donation_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php while ($row = sqlsrv_fetch_array($donations, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Donation_ID'] ?>"><?= $row['Donation_ID'] ?> - <?= $row['Donation_Date']->format('Y-m-d') ?></option>
            <?php endwhile; ?>
        </select>

        <label style="display: block; margin-bottom: 8px;">Transfusion Date:</label>
        <input type="date" name="transfusion_date" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Medical Staff:</label>
        <select name="medical_staff_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php while ($row = sqlsrv_fetch_array($medical_staff, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Medical_Staff_ID'] ?>"><?= $row['Name'] ?> (<?= $row['Position'] ?>)</option>
            <?php endwhile; ?>
        </select>

        <label style="display: block; margin-bottom: 8px;">Quantity (ml):</label>
        <input type="number" name="quantity" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Transfusion Location:</label>
        <input type="text" name="transfusion_location" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Reaction Status:</label>
        <input type="text" name="reaction_status" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Follow-Up Date:</label>
        <input type="date" name="follow_up_date" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Success Status:</label>
        <input type="text" name="success_status" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <div style="text-align: center; margin-top: 20px;">
            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Add Transfusion</button>
        </div>
    </form>
</body>
</html>

