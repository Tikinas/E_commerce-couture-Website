<?php
session_start();
include("database/DBController.php");

$DBController = new DBController();

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification si l'email existe déjà
    $verify_query = mysqli_query($DBController->con, "SELECT email FROM user WHERE email = '$email'");
    if (mysqli_num_rows($verify_query) != 0) {
        echo "<div class='message'>
                    <p>Cet email est déjà utilisé, veuillez en choisir un autre.</p>
                  </div><br>";
    } else {
        // Insérer le nouvel utilisateur dans la base de données
        $insert_query = mysqli_query($DBController->con, "INSERT INTO user(nom, prenom, email, password) VALUES ('$nom', '$prenom', '$email', '$password')");
        if ($insert_query) {
            echo "<div class='message'>
                        <p>Compte créé avec succès.</p>
                      </div><br>";
            echo "<a href='login.php'><button class='btn'>Connectez-vous maintenant</button></a>";
        } else {
            echo "Erreur lors de la création du compte.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/style.css">
    <title>Inscription</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Inscription</header>
            <form action="" method="post">
                <div class="field-input">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" required>
                </div>
                <div class="field-input">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" id="prenom" required>
                </div>
                <div class="field-input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="field-input">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="field">
                    <input type="submit" name="submit" value="S'inscrire" class="btn">
                </div>
                <div class="link">
                    Déjà membre ? <a href="login.php">Connectez-vous</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
