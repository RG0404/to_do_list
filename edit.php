
<?php

session_start();

require_once('connect.php');

if($_POST) {
    if(isset($_POST['ID']) && !empty($_POST['ID'])
    && isset($_POST['task']) && !empty($_POST['task'])) {

        $id = strip_tags($_POST['ID']);
        $task = strip_tags($_POST['task']);        

        $sql = 'UPDATE `tasks` SET `task`=:task WHERE `ID`=:ID;';

        $query = $db->prepare($sql);

        $query->bindValue(':ID', $id, PDO::PARAM_INT);
        $query->bindValue(':task', $task, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Tâche modifiée avec succès";
            
        header('Location: homepage.php');
    }
    else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }

}

if(isset($_GET['id']) && !empty($_GET['id'])) {
    
    $id = strip_tags($_GET['id']);    //permet de retirer les balises html

    $sql = "SELECT * FROM `tasks` WHERE `id` = $id";

    $query = $db->prepare($sql);

    $query->execute();

    $tasks = $query->fetch();

    if(!$tasks) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: homepage.php');
    }
}

else {
    $_SESSION['erreur'] = "Url invalide";
    header('Location: homepage.php');
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
    <title>Modifier une tâche</title>
</head>
<body>

    <?php
        if(!empty($_SESSION['erreur'])) {
           echo '<div class="alert">'. $_SESSION['erreur'].' </div>';
            $_SESSION['erreur'] = "";
        }
    ?>
   
    <form method="post">
        <label for="produit">Tâche</label>
        <input class="input" type="textarea" id="task" name="task" value="<?= $tasks['task'] ?>">

        <input type="hidden" value="<?= $tasks['ID'] ?>" name="ID">

        <button class="btn">Modifier</button>
    </form>

</body>
</html>