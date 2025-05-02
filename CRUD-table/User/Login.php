<!--  login op account -->
<?php
require_once "../Includes/db.php";
require_once "../Includes/Gebruiker-Class.php";

session_start();
$db = new DB();
$registreer = new Registreer($db);

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // XSS bescherming
        $gebruikernaam = htmlspecialchars($_POST["gebruikernaam"]);
        $wachtwoord = htmlspecialchars($_POST["wachtwoord"]);

        $userData = $registreer->loginGebruiker($gebruikernaam);
        if ($userData && password_verify($wachtwoord, $userData["wachtwoord"])) {
            $_SESSION["login_status"] = true;
            $_SESSION["gebruikerID"] = $userData["gebruikerID"]; 
            $_SESSION["gebruikernaam"] = $userData["gebruikernaam"];
          
            header("location: Taak.php");
        } else {
            echo "Ongeldige gebruikernaam of wachtwoord!";
            header("refresh:2; url=Login.php");
            exit();
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
    <title>login</title>
</head>
<body>
    <h1>Login</h1>

    <div class="login">
   <form method="post" action="login.php">
        <label for="gebruikernaam">gebruikernaam:</label>
        <input type="text" id="gebruikernaam" name="gebruikernaam" required>

        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required>

        <button type="submit">Inloggen</button><br>
        <a href="Registreer.php">Aanmelden</a><br>
    </form> 
</div>

</body>
</html>