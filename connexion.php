
<?php
session_start();
 
require_once ('connect.php');
 
if(isset($_POST['formconnexion'])) {
   $emailconnect = htmlspecialchars($_POST['emailconnect']);
   $mdpconnect = sha1($_POST['passwordconnect']);
   if(!empty($emailconnect) AND !empty($mdpconnect)) {
      $requser = $db->prepare("SELECT * FROM membres WHERE email = ? AND password = ?");
      $userexist = $requser->execute(array($emailconnect, $mdpconnect));
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['ID'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['email'] = $userinfo['email'];
         header("Location: homepage.php?id=".$_SESSION['id']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
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
    <link rel="stylesheet" href="connexion.css">
    <title>Connexion</title>
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

    <div class="container" style="z-index: 100;">

        <div class="title">Welcome Back!</div>

        <img src="./img/img-connexion.png" alt="Illustration">

        <div class="form-container">

            <form method="POST">
    
                <input class="input" type="text" name="emailconnect" placeholder="Votre email">
                <input class="input" type="password" name="passwordconnect" placeholder="Votre password">
                <?= !empty($erreur) ? "<div class='alert'>$erreur</div>" : "" ?>
                <input class="btn" type="submit" name="formconnexion" value="Se Connecter">
    
            </form>

            <div class="form-footer">
                <div class="form-footer-content">Vous n'avez pas de compte ?</div>
                <a href="register.php" class="form-footer-a">S'inscrire</a>
            </div>
    
        </div>

    </div>

</body>
</html>