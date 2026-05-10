CREATE TABLE Hospital (
    Hospital_ID INT PRIMARY KEY IDENTITY(1,1),
    Hospital_Name VARCHAR(100),
    Location VARCHAR(255),
    Phone_Number VARCHAR(20),
    Email VARCHAR(100),
    Number_of_Beds INT,
    Blood_Bank_Status VARCHAR(50),
    Number_of_Staff INT,
    Department_Count INT,
    Emergency_Availability VARCHAR(50)
);
