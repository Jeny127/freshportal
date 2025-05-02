create database beheer;
use beheer;

create table Registreer(
    gebruikerID INT AUTO_INCREMENT,
    voornaam VARCHAR(255),
    achternaam VARCHAR(255),
    gebruikernaam VARCHAR (255),
    email VARCHAR(255),
    wachtwoord VARCHAR(255),
    telefoonnummer INT,
    geboortedatum DATE,
    PRIMARY KEY (gebruikerID)
);

create table Takenlijst(
    taakID  INT AUTO_INCREMENT,
    taaknaam varchar (255),
    omschrijving varchar (255),
    status ENUM('Niet gestart', 'In uitvoering', 'Afgerond') DEFAULT 'Niet gestart',
    einddatum date,
    primary key (taakID)
);
