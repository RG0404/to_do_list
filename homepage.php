
<?php

session_start();

if(!isset($_SESSION['id'])) {
    header("Location: index.html");
    
}

require_once('connect.php');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
    $getid = intval($_GET['id']);
    $requser = $db->prepare('SELECT * FROM membres WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
}

$sql = 'SELECT * FROM `tasks` WHERE user_id = ? ORDER BY priority DESC';

$query = $db->prepare($sql);

$query->execute(array($_SESSION['id']));

$result = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['action']) && $_GET['action'] == 'changeTask') {
    if (isset($_GET['id'])) {
        $id_task = $_GET['id'];
        $sql = "UPDATE `tasks` SET `done` = !done WHERE ID = $id_task";

        $query = $db->prepare($sql);
        $query->execute();
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
    <link rel="stylesheet" href="homepage.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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

        <div class="ui-bar" style="z-index: 101;"></div>

    </div>

    <div class="home-top" style="z-index: 100;">

        <a href="picture.php"><div class="img" style="background: url('img/<?= $_SESSION['picture'] ?>'); background-size: cover;"></div></a>

        <div class="home-top-content">Welcome, <?= $_SESSION['pseudo'] ?></div>

    </div>

    <div class="home-container" style="z-index: 100;">

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

                    <div class="task-1-container task-<?= $tasks['ID']?>-container">
                        <input type="checkbox" id="box-<?= $tasks['ID']?>" <?= $tasks['done'] == 1 ? 'checked' : '' ?>>
                        <label for="box-<?= $tasks['ID']?>" onclick="checked(<?= $tasks['ID'] ?>)"><?= $tasks['task'] ?></label>
                        
                        <div class="tool-box">
                            <a href="edit.php?id=<?= $tasks['ID'] ?>"><img src="./img/icon-param.png" alt=""></a>
                            <a href="delete.php?id=<?= $tasks['ID'] ?>"><img src="./img/icon-delete.png" alt=""></a>
                        </div>
                        <div class="priority <?php if($tasks['priority'] == 0) { ?> priority-0 <?php } elseif($tasks['priority'] == 1) { ?> priority-1 <?php } elseif($tasks['priority'] == 2) { ?> priority-2 <?php } elseif($tasks['priority'] == 3) { ?> priority-3 <?php } ?>"></div>
                    </div>

                
                <?php
                }
                ?>

            </div>

        </div>

        <div class="disconnect-box">
            <a class="disconnect-btn" href="disconnect.php">Se déconnecter</a>
        </div>

    </div>
    <script>
        function checked(id_task) {
            $.ajax({
                url: 'homepage.php',
                type: 'get',
                data: {
                    action: 'changeTask',
                    id: id_task 
                },
                success: function(response){
                }
            });
        }
    </script>
</body>
</html>


