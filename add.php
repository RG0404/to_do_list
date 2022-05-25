

<?php

session_start();

if($_POST) {
    if(isset($_POST['task']) && !empty($_POST['task'])) {
        require_once('connect.php');

        $task = strip_tags($_POST['task']);
        $priority = strip_tags($_POST['priority']);

        $sql = 'INSERT INTO `tasks` (`task`, `user_id`, `priority`) VALUES (?, ?, ?);';

        $query = $db->prepare($sql);

        $query->execute(array($task, $_SESSION['id'], $priority));

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
        <form class="form-add" method="post">
            <label for="task">Ajouter une nouvelle tâche :</label>
            <input class="input" type="text" id="task" name="task">
            <select class="input" name="priority" id="priority">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>

            <button class="btn">Ajouter</button>
        </form>
    </div>

</body>
</html>