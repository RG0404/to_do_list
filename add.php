

<?php

session_start();

if($_POST) {
    if(isset($_POST['task']) && !empty($_POST['task'])) {
        require_once('connect.php');

        $task = strip_tags($_POST['task']);

        $sql = 'INSERT INTO `tasks` (`task`) VALUES (:task);';

        $query = $db->prepare($sql);

        $query->bindValue(':task', $task, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Tâche ajoutée avec succès";
        
        require_once('close.php');
        
        header('Location: homepage.php');
    }
    else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }

}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add.css">
    <title>Ajouter une tâche</title>
</head>
<body>

    <?php
        if(!empty($_SESSION['erreur'])) {
           echo '<div class="alert">'. $_SESSION['erreur'].' </div>';
            $_SESSION['erreur'] = "";
        }
    ?>
   
    <form method="post">
        <label for="task">Tâche</label>
        <input class="input" type="text" id="task" name="task">

        <button class="btn">Ajouter</button>
    </form>

</body>
</html>