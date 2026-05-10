CREATE TABLE Donor (
    Donor_ID INT PRIMARY KEY IDENTITY(1,1),
    Name VARCHAR(100) NOT NULL,
    Age INT NOT NULL,
    Gender VARCHAR(10),
    Address VARCHAR(255),
    Phone_Number VARCHAR(20),
    Email VARCHAR(100),
    Blood_Type_ID INT,
    Last_Donation_Date DATE,
    Health_Status VARCHAR(100),
    Number_of_Donations INT,

    -- Foreign Key Reference to Blood_Type table
    FOREIGN KEY (Blood_Type_ID) REFERENCES Blood_Type(Blood_Type_ID)
);
