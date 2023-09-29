CREATE TABLE LoanApplication(
	ApplicationID int AUTO_INCREMENT PRIMARY KEY,
    ClientID int NOT null,
    LoanDate date not null,
   	LoanType varchar(50) not null,
    LoanAmount decimal(9,2) not null,
    ReleaseTo varchar(50) not null,
    ApplicationDate date not null
;)

CREATE TABLE LoanAccountInquiry(
    InquiryID int AUTO_INCREMENT PRIMARY KEY,
    ClientID int NOT null,
    SendInquiryTo varchar(80) NOT null,
    Recipient varchar(100) NOT null,
    Remarks varchar(255),
    InquiryDate date not null,
    InquiryStatus varchar(100) DEFAULT 'Pending'
);