CREATE TABLE Recipient (
    Recipient_ID INT PRIMARY KEY IDENTITY(1,1),
    Name VARCHAR(100) NOT NULL,
    Age INT,
    Gender VARCHAR(10),
    Address VARCHAR(255),
    Phone_Number VARCHAR(15),
    Email VARCHAR(100),
    Blood_Type_ID INT,
    Medical_Condition VARCHAR(255),
    Hospital_ID INT,
    Number_of_Transfusions INT,

    -- Foreign Key References
    FOREIGN KEY (Blood_Type_ID) REFERENCES Blood_Type(Blood_Type_ID),
    FOREIGN KEY (Hospital_ID) REFERENCES Hospital(Hospital_ID)
);
