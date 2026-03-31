<?php
session_start();

// On regarde quelle est la dernière étape enregistrée
$etape = isset($_SESSION['derniere_etape']) ? $_SESSION['derniere_etape'] : 1;

if ($etape == 3) {
    // Si l'utilisateur a déjà atteint le chrono, on l'envoie à la confirmation
    header("Location: confirmation.php");
    exit();
} elseif ($etape == 2) {
    // S'il s'est arrêté au mail, on l'envoie à suivi.php
    header("Location: suivi.php");
    exit();
} else {
    // Sinon, retour au début
    header("Location: accueil.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma Position - SEN_EXTRAIT_EXPRESS</title>
    <link rel="stylesheet" href="location.css">
   
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

    <div class="main-wrapper">
        <div class="status-box">
            <h2>Où en est ma demande ?</h2>
            
            <?php 
            $etape = isset($_SESSION['derniere_etape']) ? $_SESSION['derniere_etape'] : 0; 
            ?>

            <div style="margin: 30px 0;">
                <div class="step-circle <?php echo ($etape >= 1) ? 'completed' : ''; ?>">1</div>
                <div class="step-circle <?php echo ($etape == 2) ? 'active' : (($etape > 2) ? 'completed' : ''); ?>">2</div>
                <div class="step-circle <?php echo ($etape == 3) ? 'active' : ''; ?>">3</div>
            </div>

            <div class="message-position">
                <?php if($etape == 1): ?>
                    <p>📍 Vous avez rempli les <b>informations du bébé</b>.<br>Étape suivante : Validation Mairie.</p>
                    <a href="suivi.php" class="btn-resume">Continuer l'étape 2</a>

                <?php elseif($etape == 2): ?>
                    <p>📍 Vous êtes à la <b>Validation Mairie</b> (Saisie de l'email).<br>Nous attendons votre confirmation.</p>
                    <a href="suivi.php" class="btn-resume">Retourner au formulaire email</a>

                <?php elseif($etape == 3): ?>
                    <p>📍 <b>Félicitations !</b> Votre extrait est en cours de génération ou déjà prêt.</p>
                    <a href="confirmation.php" class="btn-resume">Voir mon extrait</a>

                <?php else: ?>
                    <p>Aucune demande en cours pour le moment.</p>
                    <a href="accueil.php" class="btn-resume">Commencer une déclaration</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>