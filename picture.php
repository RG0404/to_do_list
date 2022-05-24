<?php

session_start();


if (isset($_POST['submitPicture'])) {
    require_once('connect.php');

    $tmpName = $_FILES['picture']['tmp_name'];
    $nameFile = $_FILES['picture']['name'];
    $size = $_FILES['picture']['size'];
    $error = $_FILES['picture']['error'];

    $session_id = $_SESSION['id'];

    move_uploaded_file($tmpName, 'img/'.$nameFile);

    $sql = "UPDATE `membres` SET `picture` = '". $nameFile ."' WHERE `ID` = '". $session_id ."'";

    $query = $db->prepare($sql);

    $query->execute();

    $_SESSION['picture'] = $nameFile;

    $_SESSION['message'] = "Photo changée avec succès";

    require_once('close.php');

    header('Location: homepage.php');
} else {
    $_SESSION['erreur'] = "";
}



?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="picture.css">
    <title>Photo de profil</title>
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
    if (!empty($_SESSION['erreur'])) {
        echo '<div class="alert">' . $_SESSION['erreur'] . ' </div>';
        $_SESSION['erreur'] = "";
    }
    ?>

    <div class="form-container" style="z-index: 100;">
        <form class="form-add" action="picture.php" method="POST" enctype="multipart/form-data">
            <label for="picture">Changer de photo</label>
            <input class="input" type="file" id="picture" name="picture">

            <input class="btn" type="submit" name="submitPicture">
        </form>
    </div>

</body>

</html>