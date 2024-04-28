<?php 
session_start();

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION['valid'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit; // Arrêter l'exécution du script après la redirection
}

// Vérifier si le formulaire de déconnexion a été soumis
if(isset($_POST['confirm_logout'])) {
    // Détruire la session
    session_destroy();
    // Rediriger vers la page de création de compte
    header("Location: signup.php");
    exit; // Arrêter l'exécution du script après la redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/style.css">
    <title>Logout</title>
</head>
<body>
    <div class="message">
        <p>Êtes-vous sûr de vouloir vous déconnecter ?</p>
            <a href="signup.php" class="btn">Oui</a>
    </div>
</body>
</html>
