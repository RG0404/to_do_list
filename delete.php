
<?php

session_start();



if(isset($_GET['id']) && !empty($_GET['id'])) {
    
    require_once('connect.php');
    
    $id = strip_tags($_GET['id']);    //permet de retirer les balises html

    $sql = 'SELECT * FROM `tasks` WHERE `id` = :id;';

    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $produit = $query->fetch();

    if(!$produit) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: homepage.php');
        die();
    }

    $id = strip_tags($_GET['id']);    //permet de retirer les balises html

    $sql = 'DELETE FROM `tasks` WHERE `id` = :id;';

    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $_SESSION['message'] = "Le produit a été supprimé";
        header('Location: homepage.php');

}

else {
    $_SESSION['erreur'] = "Url invalide";
    header('Location: homepage.php');
}

?>

