<?php
include 'db.php';

if (isset($_GET['id'])) {
    $transfusion_id = $_GET['id'];

    // Fetch the current transfusion details for editing
    $sql = "SELECT * FROM Transfusion WHERE Transfusion_ID = ?";
    $stmt = sqlsrv_query($conn, $sql, [$transfusion_id]);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $transfusion = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
}

// Fetch Recipients, Donations, and Medical Staff for dropdowns
$recipients = sqlsrv_query($conn, "SELECT * FROM Recipient");
$donations = sqlsrv_query($conn, "SELECT * FROM Donation");
$medical_staff = sqlsrv_query($conn, "SELECT * FROM Medical_Staff");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated values
    $recipient_id = $_POST['recipient_id'];
    $donation_id = $_POST['donation_id'];
    $transfusion_date = $_POST['transfusion_date'];
    $medical_staff_id = $_POST['medical_staff_id'];
    $quantity = $_POST['quantity'];
    $transfusion_location = $_POST['transfusion_location'];
    $reaction_status = $_POST['reaction_status'];
    $follow_up_date = $_POST['follow_up_date'];
    $success_status = $_POST['success_status'];

    // Update the transfusion details
    $sql = "UPDATE Transfusion SET 
                Recipient_ID = ?, Donation_ID = ?, Transfusion_Date = ?, Medical_Staff_ID = ?, 
                Quantity = ?, Transfusion_Location = ?, Reaction_Status = ?, Follow_Up_Date = ?, Success_Status = ? 
            WHERE Transfusion_ID = ?";
    $params = [
        $recipient_id, $donation_id, $transfusion_date, $medical_staff_id, $quantity, 
        $transfusion_location, $reaction_status, $follow_up_date, $success_status, 
        $transfusion_id
    ];

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Transfusion updated successfully!";
    header("Location: view_transfusions.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Transfusion</title>
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
        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>Edit Transfusion</h2>
    <form method="POST">
        <label for="recipient_id">Recipient:</label>
        <select name="recipient_id" id="recipient_id" required>
            <?php while ($row = sqlsrv_fetch_array($recipients, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Recipient_ID'] ?>" <?= $row['Recipient_ID'] == $transfusion['Recipient_ID'] ? 'selected' : '' ?>>
                    <?= $row['Name'] ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <label for="donation_id">Donation:</label>
        <select name="donation_id" id="donation_id" required>
            <?php while ($row = sqlsrv_fetch_array($donations, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Donation_ID'] ?>" <?= $row['Donation_ID'] == $transfusion['Donation_ID'] ? 'selected' : '' ?>>
                    <?= $row['Donation_ID'] ?> - <?= $row['Donation_Date']->format('Y-m-d') ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <label for="transfusion_date">Transfusion Date:</label>
        <input type="date" name="transfusion_date" id="transfusion_date" value="<?= $transfusion['Transfusion_Date']->format('Y-m-d') ?>" required><br>

        <label for="medical_staff_id">Medical Staff:</label>
        <select name="medical_staff_id" id="medical_staff_id" required>
            <?php while ($row = sqlsrv_fetch_array($medical_staff, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Medical_Staff_ID'] ?>" <?= $row['Medical_Staff_ID'] == $transfusion['Medical_Staff_ID'] ? 'selected' : '' ?>>
                    <?= $row['Name'] ?> (<?= $row['Position'] ?>)
                </option>
            <?php endwhile; ?>
        </select><br>

        <label for="quantity">Quantity (ml):</label>
        <input type="number" name="quantity" id="quantity" value="<?= $transfusion['Quantity'] ?>" required><br>

        <label for="transfusion_location">Transfusion Location:</label>
        <input type="text" name="transfusion_location" id="transfusion_location" value="<?= $transfusion['Transfusion_Location'] ?>" required><br>

        <label for="reaction_status">Reaction Status:</label>
        <input type="text" name="reaction_status" id="reaction_status" value="<?= $transfusion['Reaction_Status'] ?>" required><br>

        <label for="follow_up_date">Follow-Up Date:</label>
        <input type="date" name="follow_up_date" id="follow_up_date" value="<?= $transfusion['Follow_Up_Date']->format('Y-m-d') ?>" required><br>

        <label for="success_status">Success Status:</label>
        <input type="text" name="success_status" id="success_status" value="<?= $transfusion['Success_Status'] ?>" required><br>

        <button type="submit">Update Transfusion</button>
    </form>

</body>
</html>

