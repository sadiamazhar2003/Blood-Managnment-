<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_name = $_POST['department_name'];
    $head_of_department = $_POST['head_of_department'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $hospital_id = $_POST['hospital_id'];
    $number_of_staff = $_POST['number_of_staff'];
    $number_of_patients = $_POST['number_of_patients'];
    $services_offered = $_POST['services_offered'];
    $operation_hours = $_POST['operation_hours'];

    $sql = "INSERT INTO Department (Department_Name, Head_of_Department, Phone_Number, Email, Hospital_ID, Number_of_Staff, Number_of_Patients, Services_Offered, Operation_Hours) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [$department_name, $head_of_department, $phone_number, $email, $hospital_id, $number_of_staff, $number_of_patients, $services_offered, $operation_hours];

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo "Error adding Department:";
        foreach (sqlsrv_errors() as $error) {
            echo "SQLSTATE: " . $error['SQLSTATE'] . " Message: " . $error['message'] . "<br>";
        }
    } else {
        echo "Department added successfully!";
        header("Location: view_department.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Department</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px; line-height: 1.6;">
    <h2 style="color: #333; text-align: center;">Add Department</h2>
    <form method="POST" style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <label for="department_name" style="display: block; margin-bottom: 8px;">Department Name:</label>
        <input type="text" id="department_name" name="department_name" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="head_of_department" style="display: block; margin-bottom: 8px;">Head of Department:</label>
        <select id="head_of_department" name="head_of_department" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <option value="">None</option>
            <?php
            $staff_sql = "SELECT Medical_Staff_ID, Name FROM Medical_Staff";
            $staff_stmt = sqlsrv_query($conn, $staff_sql);
            while ($staff = sqlsrv_fetch_array($staff_stmt, SQLSRV_FETCH_ASSOC)) {
                echo "<option value='" . $staff['Medical_Staff_ID'] . "'>" . $staff['Name'] . "</option>";
            }
            ?>
        </select>

        <label for="phone_number" style="display: block; margin-bottom: 8px;">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="email" style="display: block; margin-bottom: 8px;">Email:</label>
        <input type="email" id="email" name="email" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="hospital_id" style="display: block; margin-bottom: 8px;">Hospital:</label>
        <select id="hospital_id" name="hospital_id" required style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            $hospital_sql = "SELECT Hospital_ID, Hospital_Name FROM Hospital";
            $hospital_stmt = sqlsrv_query($conn, $hospital_sql);
            while ($hospital = sqlsrv_fetch_array($hospital_stmt, SQLSRV_FETCH_ASSOC)) {
                echo "<option value='" . $hospital['Hospital_ID'] . "'>" . $hospital['Hospital_Name'] . "</option>";
            }
            ?>
        </select>

        <label for="number_of_staff" style="display: block; margin-bottom: 8px;">Number of Staff:</label>
        <input type="number" id="number_of_staff" name="number_of_staff" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="number_of_patients" style="display: block; margin-bottom: 8px;">Number of Patients:</label>
        <input type="number" id="number_of_patients" name="number_of_patients" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="services_offered" style="display: block; margin-bottom: 8px;">Services Offered:</label>
        <textarea id="services_offered" name="services_offered" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;"></textarea>

        <label for="operation_hours" style="display: block; margin-bottom: 8px;">Operation Hours:</label>
        <input type="text" id="operation_hours" name="operation_hours" style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 5px;">

        <div style="text-align: center; margin-top: 20px;">
            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Add Department</button>
        </div>
    </form>
</body>
</html>

