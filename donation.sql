CREATE TABLE Donation (
    Donation_ID INT PRIMARY KEY IDENTITY(1,1),
    Donor_ID INT,
    Blood_Type_ID INT,
    Donation_Date DATE,
    Quantity INT,
    Expiration_Date DATE,
    Donation_Location VARCHAR(255),
    Donation_Status VARCHAR(50),
    Testing_Results VARCHAR(255),
    Storage_ID INT,
    
    -- Foreign Key References
    FOREIGN KEY (Donor_ID) REFERENCES Donor(Donor_ID),
    FOREIGN KEY (Blood_Type_ID) REFERENCES Blood_Type(Blood_Type_ID),
    FOREIGN KEY (Storage_ID) REFERENCES Blood_Storage(Storage_ID)
);
