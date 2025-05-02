<!-- overzicht van alle taken -->
<?php
session_start();
require_once "../Includes/db.php"; 
require_once "../Includes/Taken-CLass.php";
require_once "../Includes/Gebruiker-Class.php";

$db = new DB();
$takenlijst = new Takenlijst($db);
$registreer = new Registreer($db);

if (!isset($_SESSION["login_status"]) || $_SESSION["login_status"] !== true) {
    header("location: Login.php");
    exit();
}

if (!isset($_SESSION["gebruikerID"])) {

    die("Error: gebruikerID is niet ingesteld in de sessie.");
}

$gebruikerID = $_SESSION["gebruikerID"];

$gebruikerData = $registreer->getGebruikerById($gebruikerID);

$taakID = $_GET["taakID"] ?? null; 
$takenlijsten = $takenlijst->selectTaak($taakID);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>dashboard</title>
</head>
<body>
    
<a class="icon-link" href="log uit.php">log uit</a>

    <!-- <h1>Welkom, <?= htmlspecialchars($gebruikerData[" gebruikernaam"]); ?></h1> -->
    
    <h1>Takenlijst</h1>
    <a class="icon-link" href="Voeg-Taak.php">Voeg taak</a>

    <table class="table table-striped">
    <thead> 
        <tr>
            <th>id</th>
            <th>taaknaam</th>
            <th>omschrijving</th>
            <th>status</th>
            <th>eind-datum</th>
            <th colspan="2">actie</th>
        </tr>

        </thead>
        <tbody>

        <?php foreach ($takenlijsten as $takenlijst): ?> 
        <tr>
        <td><?php echo htmlspecialchars($takenlijst['taakID']); ?></td>
        <td><?php echo htmlspecialchars($takenlijst['taaknaam']); ?></td>
        <td><?php echo htmlspecialchars($takenlijst['omschrijving']); ?></td>
        <td><?php echo htmlspecialchars($takenlijst['status']); ?></td>
        <td><?php echo htmlspecialchars($takenlijst['einddatum']); ?></td>

            <td>
            <a href="Edit.php?ID=<?= htmlspecialchars($takenlijst['taakID']); ?>">Bewerken</a>  
            <a href="Delete.php?ID=<?= htmlspecialchars($takenlijst['taakID']); ?>" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');"> Verwijder</a>

        </tr>
<?php endforeach; ?>
  </tbody>

    </table>
</body>
</html>