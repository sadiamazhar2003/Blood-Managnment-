CREATE TABLE Blood_Storage (
    Storage_ID INT PRIMARY KEY IDENTITY(1,1),
    Blood_Type_ID INT,
    Storage_Location VARCHAR(255),
    Storage_Capacity INT,
    Current_Stock INT,
    Storage_Temperature VARCHAR(50),
    Storage_Facility_Type VARCHAR(100),
    Maintenance_Date DATE,
    Shelf_Life_Days INT,
    Equipment_ID INT,
    
    -- Foreign Key References
    FOREIGN KEY (Blood_Type_ID) REFERENCES Blood_Type(Blood_Type_ID),
    FOREIGN KEY (Equipment_ID) REFERENCES Equipment(Equipment_ID)
);
