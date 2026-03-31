<?php
session_start();
// Sur la page 1, tu mets 1. Sur la page 2, tu mets 2, etc.
$_SESSION['derniere_etape'] = 2;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="suivi.css">
    <title>Sen_extrait_express</title>
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
    <main class="form-container">

       <h1>Validation en cours</h1>
        <div class="list">
            <div class="num">1. Informations</div>
            <div class="num action">2. Validation mairie</div>
            <div class="num">3. Confirmation</div>
        </div>
    </main>
    <div class="container">

         <h1 class="first">Merci ! Enregistrement réussi.</h1>

         <p>Les informations du nouveau-né ont été bien reçues par nos services.</p>

         <div class="div">
         <h3>Dernière étape de validation</h3>
         <p>Veuillez saisir l'adresse email où vous souhaitez recevoir l'extrait PDF :</p>

         <form action="confirmation.php" method="POST">
         <input type="email" name="user_email" class="input-mail"
         placeholder="votre@email.com" required>

         <br><br>

         <button type="submit" class="btn-valider">
         Terminer et Valider la demande
         </button>
         </form>
         </div>

         <p class="last">
         <small>Votre extrait sera généré automatiquement après cette étape.</small>
         </p>
</div>


</body>
</html>

