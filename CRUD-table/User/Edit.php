<!--  bewerk je taak -->
<?php
require_once "../includes/db.php";
require_once "../includes/Taken-Class.php";
require_once "../Includes/Gebruiker-Class.php";


$taakID = isset($_GET["ID"]) ? intval($_GET["ID"]) : null;

if (!$taakID) {
    die("Geen geldig evenement-ID opgegeven.");
}

$db = new DB();
$takenlijst = new Takenlijst($db);

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // XSS bescherming en invoer validatie

        $taaknaam = htmlspecialchars($_POST["taaknaam"]);
        $omschrijving = htmlspecialchars($_POST["omschrijving"]);
        $status = htmlspecialchars($_POST["status"]);
        $einddatum = htmlspecialchars($_POST["einddatum"]);
        
        if ($takenlijst->updateTaak($taakID, $taaknaam, $omschrijving, $status, $einddatum)) {
            echo "taak succesvol bijgewerkt!";
            header("refresh:1; url= Taak.php");
            exit();
        } else {
            echo "Fout bij het bijwerken van het taak.";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Plan je event</title>
</head>
<body>
    <header>
        <nav>
            <!-- Navigatie-items kunnen hier worden toegevoegd -->
        </nav>
    </header>
    
    <main>
        <h2>Update je event</h2>

        <form method="post" enctype="multipart/form-data">
            <label for="taaknaam">Taaknaam:</label>
            <input type="text" id="taaknaam" name="taaknaam" placeholder="taaknaam" required><br>
            
            <label for="omschrijving">Omschrijving:</label>
            <textarea id="omschrijving" name="omschrijving" placeholder="Omschrijving" required></textarea><br>
            
            <label for="status" class="form-label">Status:</label>
        <select id="status" name="status" class="form-select" required>
            <option value="Niet gestart">Niet gestart</option>
            <option value="In uitvoering">In uitvoering</option>
            <option value="Voltooid">Voltooid</option>
        </select>

            <label for="einddatum">Eind-datum:</label>
            <input type="date" id="einddatum" name="einddatum" placeholder="einddatum" required><br>

            
            
            <button type="submit">bijgewerkt</button>
        </form>
    </main>
    
    <footer>
        <!-- Footer inhoud kan hier worden toegevoegd -->
    </footer>
</body>
</html>
