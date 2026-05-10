<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $blood_type_id = $_POST['blood_type_id'];
    $last_donation_date = $_POST['last_donation_date'];
    $health_status = $_POST['health_status'];
    $number_of_donations = $_POST['number_of_donations'];

    $sql = "INSERT INTO Donor (Name, Age, Gender, Address, Phone_Number, Email, Blood_Type_ID, 
            Last_Donation_Date, Health_Status, Number_of_Donations) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [$name, $age, $gender, $address, $phone_number, $email, $blood_type_id, $last_donation_date, 
               $health_status, $number_of_donations];
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die("<p>Error adding donor: " . print_r(sqlsrv_errors(), true) . "</p>");
    }

    header("Location: view_donors.php");
    exit;
}

// Fetch blood types for the dropdown
$sql = "SELECT * FROM Blood_Type";
$blood_types = sqlsrv_query($conn, $sql);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Donor</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px; line-height: 1.6;">
    <h2 style="color: #333; text-align: center;">Add Donor</h2>
    <form method="POST" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <label style="display: block; margin-bottom: 8px;">Name:</label>
        <input type="text" name="name" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Age:</label>
        <input type="number" name="age" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Gender:</label>
        <select name="gender" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label style="display: block; margin-bottom: 8px;">Address:</label>
        <textarea name="address" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;"></textarea>

        <label style="display: block; margin-bottom: 8px;">Phone Number:</label>
        <input type="text" name="phone_number" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Email:</label>
        <input type="email" name="email" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Blood Type:</label>
        <select name="blood_type_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php while ($row = sqlsrv_fetch_array($blood_types, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Blood_Type_ID'] ?>"><?= $row['Blood_Group'] . " " . $row['Rh_Factor'] ?></option>
            <?php endwhile; ?>
        </select>

        <label style="display: block; margin-bottom: 8px;">Last Donation Date:</label>
        <input type="date" name="last_donation_date" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Health Status:</label>
        <input type="text" name="health_status" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Number of Donations:</label>
        <input type="number" name="number_of_donations" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <div style="text-align: center; margin-top: 20px;">
            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Add Donor</button>
            <a href="view_donors.php" style="padding: 10px 20px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 5px; font-size: 16px; margin-left: 10px;">Cancel</a>
        </div>
    </form>
</body>
</html>

