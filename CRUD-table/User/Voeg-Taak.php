<!-- voeg taak toe -->

<?php
session_start();
require_once "../Includes/db.php";
require_once "../Includes/Taken-Class.php";
require_once "../Includes/Gebruiker-Class.php";

$db = new DB();
$registreer = new Registreer($db);
$takenlijst = new Takenlijst($db);

$success = false;


try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // XSS bescherming en invoer validatie
        $taaknaam = htmlspecialchars($_POST["taaknaam"]);
        $omschrijving = htmlspecialchars($_POST["omschrijving"]);
        $status = htmlspecialchars($_POST["status"]);
        $einddatum = htmlspecialchars($_POST["einddatum"]);


        if ($takenlijst->insertTaak($taaknaam, $omschrijving, $status, $einddatum, $_SESSION['gebruikerID'])) {
            header("Location: Taak.php");
            exit(); // Zorg ervoor dat het script hier stopt
        } else {
            echo "Fout bij het toevoegen van de taak!";
            header("refresh:2; url=Taak.php"); // Optionele fallback redirect
        }
        

        }
    
} catch (Exception $e) {
    echo $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <title>voeg taak</title>
</head>
<body>
    <h1>Voeg Taak</h1>
    
    <form method="post" enctype="multipart/form-data">
            <label for="taaknaam">Taaknaam:</label>
            <input type="text" id="taaknaam" name="taaknaam" placeholder="taaknaam" required><br>
            
            <label for="omschrijving">Omschrijving:</label>
            <input type="omschrijving" name="omschrijving" placeholder="Omschrijving" required></input><br>
            
            <label for="status" class="form-label">Status:</label>
        <select id="status" name="status" class="form-select" required>
            <option value="Niet gestart">Niet gestart</option>
            <option value="In uitvoering">In uitvoering</option>
            <option value="Voltooid">Voltooid</option>
        </select>

            <label for="einddatum">Eind-datum:</label>
            <input type="date" id="einddatum" name="einddatum" placeholder="einddatum" required><br>

            
            <button type="submit">Toevoegen</button>
        </form>

</body>
</html>