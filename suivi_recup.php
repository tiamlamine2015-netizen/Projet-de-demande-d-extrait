<?php
session_start();

// Sécurité : Si on n'a pas de données de récupération, on renvoie au début
if (!isset($_SESSION['recup_data'])) {
    header("Location: recuperation.php");
    exit();
}

$personne = $_SESSION['recup_data'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="recuperation.css">
    <title>Envoi de l'extrait</title>
</head>
<body>
    <header class="head">
        <div class="logo-container">
            <img src="logo.png" alt="lion logo" class="logo-img">
            <h2 class="title">SEN_EXTRAIT_EXPRESS</h2>
        </div>
        <nav class="links">
            <a href="accueil.php">Accueil</a>
            <a href="location.php">Suivi</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <main style="text-align: center; margin-top: 50px;">
        <h2 style="color: #27ae60;">Dossier trouvé !</h2>
        <p>Extrait de : <b><?php echo strtoupper($personne['nom_complet']); ?></b></p>
        
        <form action="confirmation_recup.php" method="POST" style="margin-top: 20px;">
            <p>Entrez l'adresse email pour la réception :</p>
            <input type="email" name="user_email" placeholder="votre@email.com" required 
                   style="padding: 10px; width: 250px; border-radius: 5px; border: 1px solid #ccc;">
            <br><br>
            <input type="submit" value="Confirmer et Générer" 
                   style="padding: 10px 20px; background: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer;">
        </form>
    </main>
</body>
</html>