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

    <div class="container">

        <div class="title">Welcome Back!</div>

        <img src="./img/img-connexion.png" alt="Illustration">

        <div class="form-container">

            <form action="POST">
    
                <input class="input" type="text" placeholder="Votre email">
                <input class="input" type="text" placeholder="Votre password">
                <input class="btn" type="submit" value="Se Connecter">
    
            </form>

            <div class="form-footer">
                <div class="form-footer-content">Vous n'avez pas de compte ?</div>
                <a href="register.html" class="form-footer-a">S'inscrire</a>
            </div>
    
        </div>

    </div>

</body>
</html>