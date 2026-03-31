<?php
session_start();
$_SESSION['derniere_etape'] = 3;

// Sauvegarde de l'email en session dès qu'il arrive (pour ne plus le perdre)
if (isset($_POST['user_email'])) {
    $_SESSION['user_email'] = htmlspecialchars($_POST['user_email']);
}
$email_saisi = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "votre email";

// --- GESTION DU TEMPS RÉEL ---
if (!isset($_SESSION['fin_chrono'])) {
    $_SESSION['fin_chrono'] = time() + 120; // Fixe la fin à +2min
}

$temps_restant = $_SESSION['fin_chrono'] - time();

if ($temps_restant <= 0) { 
    $temps_restant = 0; 
}
// -----------------------------

$bdd = new mysqli("localhost", "root", "", "Extrait");
$sql = "SELECT * FROM retrait ORDER BY ID DESC LIMIT 1";
$resultat = $bdd->query($sql);
$row = $resultat->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Traitement de l'Extrait - Étape 3</title>
    <link rel="stylesheet" href="confirmation.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
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
    <div class="card">
        
        <div id="attente">
            <h2 style="color: #2c3e50;">Signature en cours à la Mairie de <?php echo $row['mairie']; ?></h2>
            <div class="loader"></div>
            <p>Veuillez patienter pendant la validation officielle...</p>
            <h1 id="timer" style="color: #e67e22;">
               <?php 
                $m = floor($temps_restant / 60);
                $s = $temps_restant % 60;
                echo sprintf("%02d:%02d", $m, $s);
             ?>
           </h1>
        </div>

        <div id="apercu-extrait">
            <div class="text-center">
                <h3>RÉPUBLIQUE DU SÉNÉGAL</h3>
                <p>ETAT CIVIL - MAIRIE DE <?php echo strtoupper($row['mairie']); ?></p>
                <hr>
                <h2>EXTRAIT D'ACTE DE NAISSANCE</h2>
            </div>

            <div class="extrait-document">
                <p><b>Nom Complet :</b> <?php echo strtoupper($row['nom_complet']); ?></p>
                <p><b>Date de Naissance :</b> <?php echo $row['date_naissance']; ?></p>
                <p><b>Sexe :</b> <?php echo $row['sexe']; ?></p>
                <p><b>Localité :</b> <?php echo $row['localite']; ?></p>
                <p><b>Prénoms du Père :</b> <?php echo $row['nom_pere']; ?></p>
                <p><b>Prénoms de la Mère :</b> <?php echo $row['nom_mere']; ?></p>
            </div>

            <div class="alert-mail">
                📧 <b>Message :</b> Votre extrait a été envoyé avec succès à l'adresse <b><?php echo $email_saisi; ?></b>.
            </div>

            <div class="text-center">
                <button class="btn-download" onclick="telechargerPDF()">
                        📥 Télécharger l'extrait PDF
                   </button>
                <br><br>
                
            </div>
        </div>

    </div>
</div>

<script>
    function telechargerPDF() {
    // 1. On cible l'élément à transformer en PDF
    const element = document.getElementById('apercu-extrait');
    
    // 2. On cache temporairement le bouton de téléchargement pour qu'il n'apparaisse pas sur le PDF
    const bouton = document.querySelector('.btn-download');
    bouton.style.visibility = 'hidden';

    // 3. Configuration de la génération
    const options = {
        margin:       1,
        filename:     'Extrait_Naissance_<?php echo $row["identite_num"]; ?>.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 }, // Meilleure qualité
        jsPDF:        { unit: 'cm', format: 'a4', orientation: 'portrait' }
    };

    // 4. Lancement du téléchargement réel
    html2pdf().set(options).from(element).save().then(() => {
        // 5. On réaffiche le bouton après le téléchargement
        bouton.style.visibility = 'visible';
    });
}
    // On récupère le temps restant calculé par PHP
    var secondes = <?php echo $temps_restant; ?>; 
    var display = document.querySelector('#timer');
    
    // Si le temps est déjà fini quand on revient sur la page
    if (secondes <= 0) {
        document.getElementById('attente').style.display = 'none';
        document.getElementById('apercu-extrait').style.display = 'block';
    } else {
        var chrono = setInterval(function () {
            var min = Math.floor(secondes / 60);
            var sec = secondes % 60;
            display.textContent = (min < 10 ? "0" : "") + min + ":" + (sec < 10 ? "0" : "") + sec;

            if (--secondes < 0) {
                clearInterval(chrono);
                document.getElementById('attente').style.display = 'none';
                document.getElementById('apercu-extrait').style.display = 'block';
            }
        }, 1000);
    }
</script>

</body>
</html>