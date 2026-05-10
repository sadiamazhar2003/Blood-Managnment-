CREATE TABLE Blood_Type (
    Blood_Type_ID INT PRIMARY KEY IDENTITY(1,1),
    Blood_Group NVARCHAR(5) NOT NULL,
    Rh_Factor NVARCHAR(5) NOT NULL,
    Description NVARCHAR(255),
    Compatible_Blood_Types NVARCHAR(255),
    Storage_Requirements NVARCHAR(255),
    Maximum_Storage_Duration INT,
    Average_Donation_Volume FLOAT,
    Plasma_Compatibility NVARCHAR(255),
    Platelet_Compatibility NVARCHAR(255)
);
