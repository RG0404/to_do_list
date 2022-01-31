
<?php

session_start();

require_once('connect.php');

$sql = 'SELECT * FROM `tasks`';

$query = $db->prepare($sql);

$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="homepage.css">
    <title>Home</title>
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

    <div class="home-top">

        <div class="img"></div>

        <div class="home-top-content">Welcome, John Doe</div>

    </div>

    <div class="home-container">

        <div class="task-container">


            <div class="tasks-box">

                <div class="tasks-box-top">
                    <div class="task-container-title">Liste des tâches</div>
                    <a href="add.php">
                        <div class="btn-add">
                            <img src="./img/Icon ionic-ios-add.png" alt="">
                        </div>
                    </a>
                </div>

            </div>

            <div class="tasks-list">

                <?php
                    foreach($result as $tasks) {
                ?>

                    <div class="task-1-container">
                        <input type="checkbox" id="box-1">
                        <label for="box-1"><?= $tasks['task'] ?></label>
                        <div class="tool-box">
                            <a href="#"><img src="./img/icon-param.png" alt=""></a>
                            <a href="#"><img src="./img/icon-delete.png" alt=""></a>
                        </div>
                    </div>

                </div>
                <?php
                }
                ?>

        </div>

    </div>

</body>
</html>
