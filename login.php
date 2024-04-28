<?php
session_start();
include("database/DBController.php");
$DBController = new DBController();

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($DBController->con, $_POST['email']);
    $password = mysqli_real_escape_string($DBController->con, $_POST['password']);

    $result = mysqli_query($DBController->con, "SELECT * FROM user WHERE email = '$email' AND password ='$password'") or die("error");
    $row = mysqli_fetch_assoc($result);

    if(is_array($row) && !empty($row)){
        $_SESSION['valid'] = $row['email'];
        $_SESSION['nom'] = $row['nom'];
        $_SESSION['prenom'] = $row['prenom'];
        $_SESSION['id'] = $row['id'];
        header("Location: home.php");
        exit;
    } else {
        echo "<div class='message'><p>Erreur de connexion.</p></div><br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/style.css">
    <title>Connexion</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Connexion</header>
            <form action="" method="post">
                <div class="field-input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="field-input">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="field">
                    <input type="submit" name="submit" value="Se connecter" class="btn">
                </div>
                <div class="link">
                    Première visite? <a href="signup.php">Créer un compte</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
