CREATE TABLE Department (
    Department_ID INT PRIMARY KEY IDENTITY(1,1),
    Department_Name NVARCHAR(255) NOT NULL,
    Head_of_Department INT NULL,
    Phone_Number NVARCHAR(20) NULL,
    Email NVARCHAR(255) NULL,
    Hospital_ID INT NOT NULL,
    Number_of_Staff INT NULL,
    Number_of_Patients INT NULL,
    Services_Offered NVARCHAR(MAX) NULL,
    Operation_Hours NVARCHAR(255) NULL,
    FOREIGN KEY (Hospital_ID) REFERENCES Hospital(Hospital_ID),
    FOREIGN KEY (Head_of_Department) REFERENCES Medical_Staff(Medical_Staff_ID)
);
