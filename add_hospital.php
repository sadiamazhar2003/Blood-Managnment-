<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hospital</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px; background-color: #f4f7f6;">

<h2 style="text-align: center; color: #333;">Add New Hospital</h2>

<form action="add_hospital.php" method="POST" style="max-width: 600px; margin: auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <label for="Hospital_Name" style="display: block; margin-bottom: 5px; font-weight: bold;">Hospital Name:</label>
    <input type="text" name="Hospital_Name" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

    <label for="Location" style="display: block; margin-bottom: 5px; font-weight: bold;">Location:</label>
    <input type="text" name="Location" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

    <label for="Phone_Number" style="display: block; margin-bottom: 5px; font-weight: bold;">Phone Number:</label>
    <input type="text" name="Phone_Number" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

    <label for="Email" style="display: block; margin-bottom: 5px; font-weight: bold;">Email:</label>
    <input type="email" name="Email" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

    <label for="Number_of_Beds" style="display: block; margin-bottom: 5px; font-weight: bold;">Number of Beds:</label>
    <input type="number" name="Number_of_Beds" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

    <label for="Blood_Bank_Status" style="display: block; margin-bottom: 5px; font-weight: bold;">Blood Bank Status:</label>
    <input type="text" name="Blood_Bank_Status" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

    <label for="Number_of_Staff" style="display: block; margin-bottom: 5px; font-weight: bold;">Number of Staff:</label>
    <input type="number" name="Number_of_Staff" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

    <label for="Department_Count" style="display: block; margin-bottom: 5px; font-weight: bold;">Department Count:</label>
    <input type="number" name="Department_Count" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

    <label for="Emergency_Availability" style="display: block; margin-bottom: 5px; font-weight: bold;">Emergency Availability:</label>
    <input type="text" name="Emergency_Availability" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

    <input type="submit" name="submit" value="Add Hospital" style="width: 100%; padding: 12px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">

</form>
<?php
include 'db.php'; // Include the database connection

if(isset($_POST['submit'])){
    $Hospital_Name = $_POST['Hospital_Name'];
    $Location = $_POST['Location'];
    $Phone_Number = $_POST['Phone_Number'];
    $Email = $_POST['Email'];
    $Number_of_Beds = $_POST['Number_of_Beds'];
    $Blood_Bank_Status = $_POST['Blood_Bank_Status'];
    $Number_of_Staff = $_POST['Number_of_Staff'];
    $Department_Count = $_POST['Department_Count'];
    $Emergency_Availability = $_POST['Emergency_Availability'];

    // Insert data into the database
    $sql = "INSERT INTO Hospital (Hospital_Name, Location, Phone_Number, Email, Number_of_Beds, Blood_Bank_Status, Number_of_Staff, Department_Count, Emergency_Availability) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = array($Hospital_Name, $Location, $Phone_Number, $Email, $Number_of_Beds, $Blood_Bank_Status, $Number_of_Staff, $Department_Count, $Emergency_Availability);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if($stmt === false) {
        echo "<strong>Error in executing query:</strong><br>";
        foreach (sqlsrv_errors() as $error) {
            echo "SQLSTATE: " . $error['SQLSTATE'] . "<br>";
            echo "Code: " . $error['code'] . "<br>";
            echo "Message: " . $error['message'] . "<br>";
        }
    } else {
        echo "Hospital added successfully!";
    }
}
?>

</body>
</html>
