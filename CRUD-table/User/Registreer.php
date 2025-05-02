<!-- maak een account -->
<?php
require_once "../Includes/db.php";
require_once "../Includes/Gebruiker-Class.php";

$db = new DB();
$registreer = new Registreer($db);


try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // XSS bescherming
        $voornaam = htmlspecialchars($_POST["voornaam"]);
        $achternaam = htmlspecialchars($_POST["achternaam"]);
        $gebruikernaam = htmlspecialchars($_POST["gebruikernaam"]);
        $email = htmlspecialchars($_POST["email"]);
        $wachtwoord = htmlspecialchars($_POST["wachtwoord"]);


        $registreer->registerGebruiker($voornaam, $achternaam, $gebruikernaam, $email, $wachtwoord);
        echo "Registratie gelukt!";
        header("refresh:2; url=Login.php");
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
    <title>registreer</title>
</head>
<body>

    <div class="registratie">
    <h2>Aanmelden</h2>
    <form method="post" action="Registreer.php">
        <label for="voornaam">Voornaam:</label>
        <input type="text" id="voornaam" name="voornaam" required>
        
        <label for="achternaam">Achternaam:</label>
        <input type="text" id="achternaam" name="achternaam" required>

        <label for="gebruikernaam">Gebruikernaam:</label>
        <input type="text" id="gebruikernaam" name="gebruikernaam" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required>

        <button type="submit">Registreer</button><br>
        <a href="login.php">Login</a><br>
    </form>
</div>

</body>
</html>