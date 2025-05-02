<?php

class Takenlijst {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function insertTaak($taaknaam, $omschrijving, $status, $einddatum, $gebruikerID) {
        return $this->pdo->run(
            "INSERT INTO Takenlijst (taaknaam, omschrijving, status, einddatum, gebruikerID) 
            VALUES (:taaknaam, :omschrijving, :status, :einddatum, :gebruikerID)",
            [
                "taaknaam" => $taaknaam, 
                "omschrijving" => $omschrijving, 
                "status" => $status, 
                "einddatum" => $einddatum,
                "gebruikerID" => $gebruikerID,
            ]
        );
    }

    public function selectTaak() {
        return $this->pdo->run("SELECT * FROM Takenlijst")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTaakById($taakID) {
        return $this->pdo->run("SELECT * FROM Takenlijst WHERE taakID = :taakID", [':taakID' => $taakID])->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTaak($taakID, $taaknaam, $omschrijving, $status, $einddatum) {
        return $this->pdo->run(
            "UPDATE Takenlijst 
             SET taaknaam = :taaknaam, omschrijving = :omschrijving, status = :status, einddatum = :einddatum 
             WHERE taakID = :taakID",
            [
                "taakID" => $taakID,
                "taaknaam" => $taaknaam, 
                "omschrijving" => $omschrijving, 
                "status" => $status, 
                "einddatum" => $einddatum     
            ]
        );
    }        

    public function verwijderTaak($taakID) {
        return $this->pdo->run("DELETE FROM Takenlijst WHERE taakID = :taakID", [':taakID' => $taakID]);
    }

    public function selectTaakByGebruikerID($gebruikerID) {
        return $this->pdo->run(
            "SELECT * FROM Takenlijst WHERE gebruikerID = :gebruikerID",
            [':gebruikerID' => $gebruikerID]
        )->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

