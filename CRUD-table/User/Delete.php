<!-- verwijder taak -->
<?php
require_once "../Includes/db.php";
require_once "../Includes/Taken-class.php";

$db = new DB();
$takenlijst = new Takenlijst($db);

try {
    if (isset($_GET["ID"]) && is_numeric($_GET["ID"])) {
        $taakID = intval($_GET["ID"]);
        $takenlijst->verwijderTaak($taakID);
        header("Location: Taak.php");  // Pas aan naar waar je wilt redirecten
        exit();
    } else {
        echo "Ongeldige taak ID opgegeven.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
