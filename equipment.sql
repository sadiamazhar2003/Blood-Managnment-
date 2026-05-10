CREATE TABLE Equipment (
    Equipment_ID INT PRIMARY KEY IDENTITY(1,1),
    Equipment_Name VARCHAR(100) NOT NULL,
    Equipment_Type VARCHAR(50),
    Maintenance_Schedule VARCHAR(100),
    Installation_Date DATE,
    Warranty_Period INT, -- In months or years depending on your requirement
    Manufacturer_Details VARCHAR(255),
    Department_ID INT,
    Assigned_Staff_ID INT,
    Status VARCHAR(50),

    -- Foreign Key Reference to Department table
    FOREIGN KEY (Department_ID) REFERENCES Department(Department_ID),

    -- Foreign Key Reference to Medical_Staff table
    FOREIGN KEY (Assigned_Staff_ID) REFERENCES Medical_Staff(Medical_Staff_ID)
);
