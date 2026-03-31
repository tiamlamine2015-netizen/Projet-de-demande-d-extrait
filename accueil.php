<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="accueil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

    <main class="all-container">
        <div class="section">
            <h1 class="title-2">Vos demarches d'etat civile,<br> simple et gratuites</h1>
            <div class="container-a">
                <a href="declaration.php" class="btn btn-premier">Déclarer un nouveau-né</a>
                <a href="recuperation.php" class="btn btn-second">Récupérer un extrait</a>
            </div>
        </div>
    </main>

    <footer class="footer-container">
        <div class="all-footer">
            <ol class="ord-list">
                <li>
                    <div class="icon">
                        <i class="fa-solid fa-address-card"></i>
                        <span class="text">Remplir le formulaire en ligne</span>
                    </div>
                </li>
                <li>
                    <div class="icon">
                        <i class="fa-solid fa-landmark"></i>
                        <span class="text">Validation par la mairie</span>
                    </div>
                </li>
                <li>
                    <div class="icon">
                        <i class="fa-regular fa-file-pdf"></i>
                        <span class="text">Recevoir le PDF par email</span>
                    </div>
                </li>
            </ol>
        </div>
    </footer>


</body>
</html>