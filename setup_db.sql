CREATE TABLE AirCrafts(
AcID INT Primary Key,
AcNumber Varchar(32) NOT NULL,
Capacity INT NOT NULL,
MfdBy Varchar(128) NOT NULL,
MfdOn Datetime NOT NULL,
Airline Varchar(15) NOT NULL
);
CREATE TABLE Route(
RtID INT,
Airport Varchar(32) NOT NULL,
Destination Varchar(32) NOT NULL,
RouteCode Varchar(16) NOT NULL UNIQUE,
PRIMARY KEY (RtID)
);
CREATE TABLE AirFare(
AfID INT,
Route INT,
Fare INT,
PRIMARY KEY (AfID),
CONSTRAINT fk_Route FOREIGN KEY (Route) REFERENCES
Route(RtID)
);

CREATE TABLE Flight_Schedule(
FIID INT,
FlightDate DATE,
Departure TIME,
Arrival TIME,
AirCraft INT,
NetFare INT,
Remaining int(11),
PRIMARY KEY (FlID),
CONSTRAINT fk_AirCraft FOREIGN KEY (AirCraft) REFERENCES
AirCrafts(AcID),
CONSTRAINT fk_NetFare FOREIGN KEY (NetFare) REFERENCES
AirFare(AfID)
);
CREATE TABLE Charges(
ChID INT PRIMARY KEY,
Title Varchar(32),
Amount INT,
Description Varchar (255)
);
CREATE TABLE Contact_Details(
CnID INT PRIMARY KEY,
Email Varchar (40) NOT NULL,
Tel Varchar (16),
Addr Varchar (64)
);
CREATE TABLE Passengers(
PsID INT PRIMARY KEY,
Name Varchar (32) NOT NULL,
Age INT NOT NULL,
Nationality Varchar(16) NOT NULL,
Contacts INT NOT NULL,
CONSTRAINT fk_Contacts FOREIGN KEY (Contacts) REFERENCES
Contact_Details(CnID)
);
CREATE TABLE Transactions(
TsID INT PRIMARY KEY,
BookingDate DATETIME,
DepartureDate DATETIME,
Passenger INT,
Flight INT,
Type INT,
Charges INT,
CONSTRAINT fk_Passenger FOREIGN KEY (Passenger) REFERENCES
Passengers(PsID),
CONSTRAINT fk_Flight FOREIGN KEY (Flight) REFERENCES
Flight_Schedule(FlID),
CONSTRAINT fk_Charges FOREIGN KEY (Charges) REFERENCES
Charges(ChID)
);



