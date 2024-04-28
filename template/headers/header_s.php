<?php
session_start();
include("database/DBController.php");
$DBController = new DBController();
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="/assets/style/style.css">
    <title>home</title>
</head>

<body>
    <section id="Header">
        <a href="#"><img src="/assets/image/logo.svg" width="100px" height="90px"></a>

        <div>
            <?php
            $id = $_SESSION['id'];
            $query = mysqli_query($DBController->con, "SELECT * FROM user WHERE id = '$id'");
            while ($result = mysqli_fetch_assoc($query)) {
                $res_nom = $result['nom'];
                $res_prenom = $result['prenom'];
                $res_email = $result['email'];
                $res_password = $result['password'];
            }
            ?>
            <ul id="navbar">
                <li><a href="home.php">Home</a></li>
                <li><a class="active" href="store.php">Store</a></li>
                <li><a href="devis.php">Devis</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li id="lg-cart"><a href="cart.php"><i class="las la-shopping-bag"></i></a></li>
                <li><a href="change.php"><i class="las la-sync"></i></a></li>
                <li><a href="logout.php"><i class="las la-sign-out-alt"></i></a></li>
                <li><a href=""><i class="las la-user-alt"></i></a><b><?php echo $res_nom . ' ' . $res_prenom; ?></b></li>
                <a href="#" id="close"><i class="las la-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.html"><i class="las la-shopping-bag"></i></a>
            <i id="bar" class="las la-bars"></i>
        </div>
    </section>