<?php
include 'db.php';

// Fetch blood types and hospitals for dropdowns
$blood_types = sqlsrv_query($conn, "SELECT * FROM Blood_Type");
$hospitals = sqlsrv_query($conn, "SELECT * FROM Hospital");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $blood_type_id = $_POST['blood_type_id'];
    $medical_condition = $_POST['medical_condition'];
    $hospital_id = $_POST['hospital_id'];
    $number_of_transfusions = $_POST['number_of_transfusions'];

    // Insert new recipient into the database
    $sql = "INSERT INTO Recipient (Name, Age, Gender, Address, Phone_Number, Email, Blood_Type_ID, Medical_Condition, Hospital_ID, Number_of_Transfusions)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [
        $name, $age, $gender, $address, $phone_number, $email, 
        $blood_type_id, $medical_condition, $hospital_id, $number_of_transfusions
    ];

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "Recipient added successfully!";
    header("Location: view_recipients.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Recipient</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px; line-height: 1.6;">
    <h2 style="color: #333; text-align: center;">Add Recipient</h2>
    <form method="POST" style="max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <label style="display: block; margin-bottom: 8px;">Name:</label>
        <input type="text" name="name" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Age:</label>
        <input type="number" name="age" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Gender:</label>
        <input type="text" name="gender" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Address:</label>
        <textarea name="address" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;"></textarea>

        <label style="display: block; margin-bottom: 8px;">Phone Number:</label>
        <input type="text" name="phone_number" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Email:</label>
        <input type="email" name="email" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label style="display: block; margin-bottom: 8px;">Blood Type:</label>
        <select name="blood_type_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php while ($row = sqlsrv_fetch_array($blood_types, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Blood_Type_ID'] ?>"><?= $row['Blood_Group'] ?> - <?= $row['Rh_Factor'] ?></option>
            <?php endwhile; ?>
        </select>

        <label style="display: block; margin-bottom: 8px;">Medical Condition:</label>
        <textarea name="medical_condition" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;"></textarea>

        <label style="display: block; margin-bottom: 8px;">Hospital:</label>
        <select name="hospital_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php while ($row = sqlsrv_fetch_array($hospitals, SQLSRV_FETCH_ASSOC)): ?>
                <option value="<?= $row['Hospital_ID'] ?>"><?= $row['Hospital_Name'] ?></option>
            <?php endwhile; ?>
        </select>

        <label style="display: block; margin-bottom: 8px;">Number of Transfusions:</label>
        <input type="number" name="number_of_transfusions" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <div style="text-align: center; margin-top: 20px;">
            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Add Recipient</button>
        </div>
    </form>
</body>
</html>
