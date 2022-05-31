
<?php

session_start();

require_once('connect.php');

$currentId = $_SESSION['id'];


if (isset($_POST['formName'])) {
    
    if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
      
        $pseudo = strip_tags($_POST['pseudo']);        

        $sql = "UPDATE `membres` SET `pseudo`=:pseudo WHERE `ID`= '". $currentId ."'";

        $query = $db->prepare($sql);

        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Tâche modifiée avec succès";

        $_SESSION['pseudo'] = $pseudo;
            
        header('Location: homepage.php');
    }
    else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
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
    <link rel="stylesheet" href="edit.css">
    <title>Modifier votre nom</title>
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

    <?php
        if(!empty($_SESSION['erreur'])) {
           echo '<div class="alert">'. $_SESSION['erreur'].' </div>';
            $_SESSION['erreur'] = "";
        }
    ?>
   
    <div class="form-container" style="z-index: 100;">
        <form method="post" action="name.php" class="form-edit">
            <label for="produit">Modifier le nom</label>

            <input class="input" type="text" id="pseudo" name="pseudo" value="<?= $_SESSION['pseudo'] ?>">

            <input type="submit" value="Changer" name="formName" class="btn">
        </form>
    </div>

</body>
</html>