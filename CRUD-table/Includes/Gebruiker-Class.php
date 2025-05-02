<?php
require "db.php";

class Registreer {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function registerGebruiker(string $voornaam, string $achternaam, string $gebruikernaam, string $email, string $wachtwoord) {
        $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $stmt = $this->pdo->run("INSERT INTO registreer (voornaam, achternaam, gebruikernaam, email, wachtwoord) VALUES (:voornaam, :achternaam, :gebruikernaam, :email, :wachtwoord)",
        [
            ':voornaam' => $voornaam,
            ':achternaam' => $achternaam,
            ':gebruikernaam' => $gebruikernaam,
            ':email' => $email,
            ':wachtwoord' => $hash
        ]);
    }

    public function loginGebruiker($gebruikernaam) {
        return $this->pdo->run("SELECT * FROM registreer WHERE gebruikernaam = :gebruikernaam",
        [':gebruikernaam' => $gebruikernaam])->fetch(PDO::FETCH_ASSOC);
    }

    public function getGebruikerById($gebruikerID) {
        return $this->pdo->run("SELECT * FROM registreer WHERE gebruikerID = :gebruikerID", 
        [':gebruikerID' => $gebruikerID])->fetch(PDO::FETCH_ASSOC);
    }

    // public function getEvenementenByGebruiker($gebruikerID) {
    //     return $this->pdo->run("SELECT * FROM evenement WHERE gebruikerID = :id", 
    //     [':id' => $gebruikerID])->fetchAll(PDO::FETCH_ASSOC);
    // }

}

?>


