
<?php
require_once('connect.php');
 
if(isset($_POST['forminscription'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $email = htmlspecialchars($_POST['email']);
   $mdp = sha1($_POST['password']);
   $mdp2 = sha1($_POST['password2']);
   if(!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['password2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
  
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $db->prepare("SELECT * FROM membres WHERE email = ?");
               $reqmail->execute(array($email));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $db->prepare("INSERT INTO membres(pseudo, email, password) VALUES(?, ?, ?)");
                     $r = $insertmbr->execute(array($pseudo, $email, $mdp));
                     if ($r) {
                        $erreur = "Votre compte a bien été créé !";
                     }
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }

      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}

require_once('close.php');

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="register.css">
    <title>S'inscrire</title>
</head>
<body>
    
    <div class="ui-elements">

        <div class="ui-top-elements">
            <div class="ui-time">9:42</div>
            <div class="ui-infos">
                <img class="icon-network" src="./img/icon-network.png" alt="network icon">
                <img class="icon-wifi" src="./img/icon-wifi.png" alt="wifi icon">
                <img class="icon-battery" src="./img/icon-battery.png" alt="battery icon">
            </div>
        </div>

        <div class="ui-bar"></div>

    </div>

    <div class="form-header">
        <div class="form-title">Bienvenue à bord!</div>
        <div class="form-subtitle">Laissez nous vous aider à organiser vos tâches</div>
    </div>

    <div class="form-container" style="z-index: 100;">

        <form method="POST">

            <input class="input" id="pseudo" name="pseudo" type="text" placeholder="Votre nom">
            <input class="input" id="email" name="email" type="email" placeholder="Votre email">
            <input class="input" id="password" name="password" type="password" placeholder="Votre password">
            <input class="input" id="password2" name="password2" type="password" placeholder="Confirmez votre password">
            <?= !empty($erreur) ? "<div class='alert'>$erreur</div>" : "" ?>
            <input class="btn" type="submit" name="forminscription" value="S'inscrire">

        </form>

    </div>

    <div class="form-footer" style="z-index: 100;">  
        <div class="form-footer-content">Vous possédez déjà un compte ?</div>
        <a class="connect" href="connexion.php">Se connecter</a>
    </div>

</body>
</html>