<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $license = $_POST['license'];
    $experience = $_POST['experience'];
    $hospital_id = $_POST['hospital_id'];
    $specialization = $_POST['specialization'];
    $shift_timings = $_POST['shift_timings'];

    $sql = "INSERT INTO Medical_Staff (Name, Position, Phone_Number, Email, Department, License_Number, Years_of_Experience, Assigned_Hospital, Specialization, Shift_Timings) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [$name, $position, $phone, $email, $department, $license, $experience, $hospital_id, $specialization, $shift_timings];

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo "Error in adding Medical Staff:";
        foreach (sqlsrv_errors() as $error) {
            echo "SQLSTATE: " . $error['SQLSTATE'] . " Message: " . $error['message'] . "<br>";
        }
    } else {
        echo "Medical Staff added successfully!";
        header("Location: view_medical_staff.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Medical Staff</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px; line-height: 1.6;">
    <h2 style="color: #333; text-align: center;">Add Medical Staff</h2>
    <form method="POST" style="max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <label for="name" style="display: block; margin-bottom: 8px;">Name:</label>
        <input type="text" id="name" name="name" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="position" style="display: block; margin-bottom: 8px;">Position:</label>
        <input type="text" id="position" name="position" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="phone" style="display: block; margin-bottom: 8px;">Phone Number:</label>
        <input type="text" id="phone" name="phone" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="email" style="display: block; margin-bottom: 8px;">Email:</label>
        <input type="email" id="email" name="email" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="department" style="display: block; margin-bottom: 8px;">Department:</label>
        <input type="text" id="department" name="department" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="license" style="display: block; margin-bottom: 8px;">License Number:</label>
        <input type="text" id="license" name="license" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="experience" style="display: block; margin-bottom: 8px;">Years of Experience:</label>
        <input type="number" id="experience" name="experience" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="hospital_id" style="display: block; margin-bottom: 8px;">Assigned Hospital:</label>
        <select id="hospital_id" name="hospital_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            $sql = "SELECT Hospital_ID, Hospital_Name FROM Hospital";
            $stmt = sqlsrv_query($conn, $sql);
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo "<option value='" . $row['Hospital_ID'] . "'>" . $row['Hospital_Name'] . "</option>";
            }
            ?>
        </select>

        <label for="specialization" style="display: block; margin-bottom: 8px;">Specialization:</label>
        <input type="text" id="specialization" name="specialization" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="shift_timings" style="display: block; margin-bottom: 8px;">Shift Timings:</label>
        <input type="text" id="shift_timings" name="shift_timings" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <div style="text-align: center; margin-top: 20px;">
            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Add Medical Staff</button>
        </div>
    </form>
</body>
</html>
