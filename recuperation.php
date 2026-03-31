<?php
session_start();

// 1. Connexion (Vérifie bien les majuscules ici aussi)
$bdd = new mysqli("localhost", "root", "", "Extrait");

if ($bdd->connect_error) {
    die("La connexion a échoué : " . $bdd->connect_error);
}

$message_erreur = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Le TRIM enlève les espaces accidentels avant ou après le numéro
    $num_ref = trim(mysqli_real_escape_string($bdd, $_POST['identite_num']));

    // 2. Requête (On force l'encodage pour être sûr des caractères)
    $bdd->set_charset("utf8");
    
    // On cherche dans la table Others
    $sql = "SELECT * FROM Others WHERE identite_num = '$num_ref'";
    $resultat = $bdd->query($sql);

    // --- UTILISATION DE FOPEN / FWRITE ---
    $mon_fichier = @fopen("journal_acces.txt", "a+"); 

    if ($resultat && $resultat->num_rows > 0) {
        $user_data = $resultat->fetch_assoc();
        
        // On prépare les données pour les pages suivantes
        $_SESSION['recup_data'] = $user_data;
        $_SESSION['derniere_etape'] = 'recup_email'; 

        if ($mon_fichier) {
            $info = date("d-m-Y H:i:s") . " | OK | Num: " . $num_ref . "\n";
            fwrite($mon_fichier, $info);
            fclose($mon_fichier);
        }

        header("Location: suivi_recup.php");
        exit();
    } else {
        // Si ça rate, on affiche ce que PHP a réellement envoyé à MySQL pour comparer
        $message_erreur = "Le numéro [" . $num_ref . "] n'est pas reconnu dans la mairie de Sacré-Cœur.";
        
        if ($mon_fichier) {
            fputs($mon_fichier, date("d-m-Y H:i:s") . " | ERREUR | Num: " . $num_ref . "\n");
            fclose($mon_fichier);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="recuperation.css">
    <title>Récupération Express</title>
    
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

    <main style="text-align: center; margin-top: 50px; font-family: Arial;">
        <h1>Récupération d'Extrait</h1>
        
        <?php if($message_erreur != ""): ?>
            <p style="color: #e74c3c; background: #fadbd8; padding: 10px; display: inline-block; border-radius: 5px;">
                ⚠️ <?php echo $message_erreur; ?>
            </p>
        <?php endif; ?>

        <form method="POST" style="margin-top: 20px;">
            <p>Veuillez entrer votre numéro de référence :</p>
            <input type="text" name="identite_num" placeholder="Ex: 005432" required 
                   style="padding: 10px; border-radius: 5px; border: 1px solid #ccc;"> 
            <br><br>
            <input type="submit" value="Vérifier le numéro" 
                   style="padding: 10px 20px; background: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer;">
        </form>
    </main>

</body>
</html>