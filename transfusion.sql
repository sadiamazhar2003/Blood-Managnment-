CREATE TABLE Transfusion (
    Transfusion_ID INT PRIMARY KEY IDENTITY(1,1),
    Recipient_ID INT,
    Donation_ID INT,
    Transfusion_Date DATE,
    Medical_Staff_ID INT,
    Quantity INT,
    Transfusion_Location VARCHAR(255),
    Reaction_Status VARCHAR(100),
    Follow_Up_Date DATE,
    Success_Status VARCHAR(50),
    
    -- Foreign Key References
    FOREIGN KEY (Recipient_ID) REFERENCES Recipient(Recipient_ID),
    FOREIGN KEY (Donation_ID) REFERENCES Donation(Donation_ID),
    FOREIGN KEY (Medical_Staff_ID) REFERENCES Medical_Staff(Medical_Staff_ID)
);
