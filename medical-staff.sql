CREATE TABLE Medical_Staff (
    Medical_Staff_ID INT PRIMARY KEY IDENTITY(1,1),
    Name NVARCHAR(100) NOT NULL,
    Position NVARCHAR(100) NOT NULL,
    Phone_Number NVARCHAR(15),
    Email NVARCHAR(100),
    Department NVARCHAR(100),
    License_Number NVARCHAR(50),
    Years_of_Experience INT,
    Assigned_Hospital INT NOT NULL,
    Specialization NVARCHAR(100),
    Shift_Timings NVARCHAR(50),
    FOREIGN KEY (Assigned_Hospital) REFERENCES Hospital(Hospital_ID)
);
