<?php
session_start();
// Sur la page 1, tu mets 1. Sur la page 2, tu mets 2, etc.
$_SESSION['derniere_etape'] = 2;
?>
<?php

$nom = "";
$err_nom = "";

$born = "";
$err_born = "";

$lieu = "";
$err_lieu = "";

$sexe = "";
$err_sexe = "";

$father_name = "";
$err_father = "";

$mother_name = "";
$err_mother = "";

$mairie = "";
$err_mairie = "";

$message = "";

    if(isset($_POST['send'])){
        $nom = $_POST['nom'];
        $born = $_POST['born'];
        $lieu = $_POST['lieu'];
        $sexe = $_POST['sexe'];
        $father_name = $_POST['father_name'];
        $mother_name = $_POST['mother_name'];
        $mairie = $_POST['mairie'];

        
        if($nom && $born && $lieu && $sexe && $father_name && $mother_name && $mairie){
          $connection = mysqli_connect("localhost", "root", "", "Extrait");
        $sql = "INSERT INTO retrait(nom_complet,date_naissance,localite,sexe,nom_pere,nom_mere,mairie) VALUES(?,?,?,?,?,?,?)";
        $both = mysqli_prepare($connection, $sql);
        if($both){
            mysqli_stmt_bind_param($both,"sssssss", $nom,$born,$lieu,$sexe,$father_name,$mother_name,$mairie);
            mysqli_stmt_execute($both);
            $message = "<p style='color: green;'>Enregistrement avec succes!</p>";
            echo "<script>
                 setTimeout(function(){
                 window.location.href ='suivi.php';
                 },2000);
            </script>
            ";
        }
        else{
            $message = "<p style='color:red;'>Erreur de connexion.</p>";
        }
        }
        
        if(empty($nom)){
            $err_nom = "<p style='color:red;'>veuillez remplir le nom complet*</p>";
        }
        if(empty($born)){
            $err_born = "<p style='color:red;'>veuillez donner votre date de naissance*</p>";
        }
        if(empty($lieu)){
            $err_lieu = "<p style='color:red;'>veuillez donner votre lieu de naissance*</p>";
        }
        if(empty($sexe)){
            $err_sexe = "<p style='color:red;'>veuillez donner le sexe*</p>";
        }
        if(empty($father_name)){
            $err_father = "<p style='color:red;'>veuillez donner le nom du pere*</p>";
        }
        if(empty($mother_name)){
            $err_mother = "<p style='color:red;'>veuillez donner le nom de la mere*</p>";
        }
        if(empty($mairie)){
            $err_mairie = "<p style='color:red;'>veuillez faire un choix*</p>";
        }
        

        
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="declaration.css">
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

       <h1>Formulaire de Déclaration de Nouveau-né</h1>
        <div class="list">
            <div class="num action">1. Informations</div>
            <div class="num">2. Validation mairie</div>
            <div class="num">3. Confirmation</div>
        </div>
     <form method="POST" class="declaration-form">
        
       <div class="input-group">
              <h4>Nom complet de l'enfant</h4>
              <input type="text" name="nom" value="<?= $nom ?>">

              <p><?= $err_nom ?></p>

        </div>


        <div class="input-group">
              <h4>Date de naissance</h4>
              <input type="date" name="born" value="<?= $born ?>">
              <p><?= $err_born ?></p>
        </div>

        <div class="input-group">
              <h4>Lieu de naissance(Localite)</h4>
              <input type="text" name="lieu" value="<?= $lieu ?>">
              <p><?= $err_lieu ?></p>
        </div>

        <div class="input-group">
              <h4>Sexe de l'enfant </h4>
              <select name="sexe" value="<?= $sexe ?>">
            <option value="" disabled select>--selectionner un sexe--</option>
            <option value="masculin">Masculin</option>
            <option value="feminin">Feminin</option>
              </select>
              <p><?= $err_sexe ?></p>
        </div>

        <div class="input-group">
              <h4>Nom du Pere</h4>
              <input type="text" name="father_name" value="<?= $father_name ?>">
              <p><?= $err_father ?></p>
        </div>
        <div class="input-group">
              <h4>Nom de la mere</h4>
              <input type="text" name="mother_name" value="<?= $mother_name ?>">
              <p><?= $err_mother ?></p>
        </div>


        <div class="input-group">
              <h4>Commune/Mairie de déclaration</h4>
              <select name="mairie" value="<?= $mairie?>">
            <option value="" disabled select>--Uniquement les habitants de sacre-coeur--</option>
            <option value="sacre-coeur">Maire Sacre-coeur</option>
              </select>
              <p><?= $err_mairie ?></p>
        </div>

        <input type="submit" value="Soumettre la déclaration" name="send" class="submit-btn">

     </form>
     <p><?= $message ?></p>
  </main>
</body>
</html>