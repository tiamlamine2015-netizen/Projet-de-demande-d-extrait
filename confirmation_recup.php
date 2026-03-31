<?php
session_start();
$_SESSION['derniere_etape'] = 3;

// 1. Connexion à la base (au cas où tu as besoin de rafraîchir des infos)
$bdd = new mysqli("localhost", "root", "", "Extrait");

// 2. Récupération de l'email envoyé par suivi_recup.php
if (isset($_POST['user_email'])) {
    $_SESSION['email_recup'] = htmlspecialchars($_POST['user_email']);
}
$email_affiche = isset($_SESSION['email_recup']) ? $_SESSION['email_recup'] : "votre email";

// 3. Récupération des données de la personne (Table Others) stockées en session
if (!isset($_SESSION['recup_data'])) {
    header("Location: recuperation.php");
    exit();
}
$row = $_SESSION['recup_data']; 

// 4. --- GESTION DU CHRONO UNIQUE POUR LA RÉCUPÉRATION ---
if (!isset($_SESSION['fin_chrono_recup'])) {
    $_SESSION['fin_chrono_recup'] = time() + 120; // 120 secondes = 2 minutes
}

$temps_restant = $_SESSION['fin_chrono_recup'] - time();

// Si le temps est fini, on bloque à 0
if ($temps_restant < 0) { 
    $temps_restant = 0; 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récupération - Étape Finale</title>
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
            
            <div id="attente" style="text-align: center; padding: 30px;">
                <h2 style="color: #2c3e50;">Signature en cours : Mairie de <?php echo $row['mairie']; ?></h2>
                
                <div class="loader" style="margin: 20px auto;"></div>
                
                <p>Veuillez patienter pendant la validation officielle...</p>
                
                <h1 id="timer" style="color: #e67e22; font-size: 3rem;">
                    <?php 
                        echo sprintf("%02d:%02d", floor($temps_restant / 60), $temps_restant % 60); 
                    ?>
                </h1>
            </div>

            <div id="apercu-extrait" style="display: none;">
                <div class="text-center">
                    <h3>RÉPUBLIQUE DU SÉNÉGAL</h3>
                    <p>ETAT CIVIL - MAIRIE DE <?php echo strtoupper($row['mairie']); ?></p>
                    <hr>
                    <h2 style="color: #27ae60;">EXTRAIT D'ACTE DE NAISSANCE (COPIE)</h2>
                </div>

                <div class="extrait-document" style="text-align: left; padding: 20px; border: 1px solid #ddd; background: #f9f9f9;">
                    <p><b>Numéro de Référence :</b> <?php echo $row['identite_num']; ?></p>
                    <p><b>Nom Complet :</b> <?php echo strtoupper($row['nom_complet']); ?></p>
                    <p><b>Date de Naissance :</b> <?php echo $row['born']; ?></p>
                    <p><b>Lieu :</b> <?php echo $row['lieu']; ?></p>
                    <p><b>Sexe :</b> <?php echo $row['sexe']; ?></p>
                    <p><b>Prénoms du Père :</b> <?php echo $row['nom_pere']; ?></p>
                    <p><b>Prénoms de la Mère :</b> <?php echo $row['nom_mere']; ?></p>
                </div>

                <div class="alert-mail" style="margin-top: 20px; color: #2980b9;">
                    📧 <b>Message :</b> Votre extrait a été renvoyé avec succès à l'adresse <b><?php echo $email_affiche; ?></b>.
                </div>

                <div class="text-center" style="margin-top: 30px;">
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
    // 1. Récupération des données depuis PHP
    var secondes = <?php echo $temps_restant; ?>; 
    var display = document.querySelector('#timer');
    var divAttente = document.getElementById('attente');
    var divExtrait = document.getElementById('apercu-extrait');

    // 2. Fonction pour basculer les affichages
    function montrerExtrait() {
        divAttente.style.display = 'none';
        divExtrait.style.display = 'block';
    }

    // 3. Si le temps est déjà fini au chargement
    if (secondes <= 0) {
        montrerExtrait();
    } else {
        // 4. Lancement du compte à rebours
        var intervalle = setInterval(function () {
            secondes--; // On décrémente

            // Calcul minutes/secondes
            var m = Math.floor(secondes / 60);
            var s = secondes % 60;

            // Mise à jour de l'affichage
            display.textContent = (m < 10 ? "0" : "") + m + ":" + (s < 10 ? "0" : "") + s;

            // Quand on arrive à zéro
            if (secondes <= 0) {
                clearInterval(intervalle);
                montrerExtrait();
            }
        }, 1000);
    }
</script>

</body>
</html>