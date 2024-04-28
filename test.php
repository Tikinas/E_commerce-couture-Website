<?php
/*include("database/DBController.php");
$DBController = new DBController();*/

// Vérifie si la méthode de requête est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie si le formulaire a été soumis
    if (isset($_POST['submit'])) {
        // Récupère l'email à partir de la session
        $email = $_SESSION['valid'];
        
        // Récupère les données du formulaire
        $description = $_POST['description'];
        $type = $_POST['type'];
        $tissu = $_POST['tissu'];
        $taille = $_POST['taille'];
        $services = $_POST['services'];
        $price = 0;
        
        // Calcule le prix en fonction du service choisi
        switch ($services) {
            case 'ourlet':
                $price = 20;
                break;
            case 'retouches':
                $price = 30;
                break;
            case 'ourlet+retouches':
                $price = 50;
                break;
        }
        
        // Insère les données dans la base de données
        $insert_query = mysqli_query($DBController->con, "INSERT INTO devis(description, type, fabric, size, services, price, email, created_at)  VALUES ('$description', '$type', '$tissu', '$taille', '$services', '$price', '$email',NOW())");
        
        // Vérifie si l'insertion a réussi
        if ($insert_query) {
            // Envoie le devis par e-mail
            $to = $email; // Remplacez par l'adresse e-mail à laquelle vous souhaitez envoyer le devis
            $subject = "Nouveau devis personnalisé";
            $message = "Description: $description \n";
            $message .= "Type de vêtement: $type \n";
            $message .= "Tissu: $tissu \n";
            $message .= "Taille: $taille \n";
            $message .= "Services: $services \n";
            $message .= "Prix: $price € \n";
            $headers = "From: tikinasaboud@email.com"; // Remplacez par votre adresse e-mail
            
            // Envoi de l'e-mail
            if (mail($to, $subject, $message, $headers)) {
                echo "L'e-mail a été envoyé avec succès.";
            } else {
                echo "Erreur lors de l'envoi de l'e-mail.";
            }
            
            // Stocke les données du devis dans la session
            $_SESSION['devis'] = array(
                'description' => $description,
                'type' => $type,
                'tissu' => $tissu,
                'taille' => $taille,
                'services' => $services,
                'price' => $price
            );
            
            // Redirige vers la même page pour éviter la soumission multiple du formulaire
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Echec de l'insertion";
        }
    } else {
        echo "Echec du soumission du formulaire";
    }
}
?>


<section id="devis">
    <div class="box">
        <h2>Formulaire de Devis Personnalisé</h2>
        <form id="devisForm" method="post" action="">
            <div class="field-input">
                <label for="nom">Description:</label> <br>
                <textarea name="description" id="description" required rows="4"> </textarea>
            </div>
            <div class="field-input">
                <label for="type">Type de vêtement:</label><br>
                <select id="type" name="type" required>
                    <option value="">Choisir...</option>
                    <option value="Chemise">Chemise</option>
                    <option value="Pantalon">Pantalon</option>
                    <option value="Robe">Robe</option>
                    <option value="Jupe">Jupe</option>
                </select>
            </div>
            <div class="field-input">
                <label for="fabric">Tissu:</label><br>
                <input type="text" id="tissu" name="tissu" required><br>
            </div>
            <div class="field-input">
                <label for="taille">Taille:</label><br>
                <select id="taille" name="taille" required>
                    <option value="">Choisir...</option>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                </select><br>
            </div>
            <div class="field-input">
                <label for="services">Services:</label><br>
                <select id="services" name="services" required>
                    <option value="">Choisir...</option>
                    <option value="ourlet">Ourlet (20€)</option>
                    <option value="retouches">Retouches (30€)</option>
                    <option value="ourlet+retouches">Ourlet + Retouches (50€)</option>
                </select><br>
            </div>
            <div class="field-input">
                <input type="hidden" id="price" name="price" value="0"> <!-- Prix sera calculé côté client -->
            </div>
            <div class="field">
                <input type="submit" name="submit" value="Obtenir un devis" class="btn">
            </div>
        </form>
    </div>
</section>
<?php
if (isset($_SESSION['devis'])) {
    // Affiche le récapitulatif du devis
    echo "<section id='recapitulatif'>";
    echo "<div class='box'>";
    echo "<h2>Récapitulatif du Devis</h2>";
    
    // Récupère les données du devis depuis la session
    $devis = $_SESSION['devis'];
    
    // Affiche les détails du devis
    echo "<p>Description: " . $devis['description'] . "</p>";
    echo "<p>Type de vêtement: " . $devis['type'] . "</p>";
    echo "<p>Tissu: " . $devis['tissu'] . "</p>";
    echo "<p>Taille: " . $devis['taille'] . "</p>";
    echo "<p>Services: " . $devis['services'] . "</p>";
    echo "<p>Prix: " . $devis['price'] . " €</p>";
    
    echo "</div>";
    echo "</section>";
    
    // Supprime les données de devis de la session pour éviter qu'elles ne soient affichées à nouveau lors du rafraîchissement de la page
    unset($_SESSION['devis']);
}
?>