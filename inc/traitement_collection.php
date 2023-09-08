<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php');

$coll_name = "LA COLLECTION";
$coll_desc = "une super collection";
$coll_keywords = "mot,cle,collection";
$coll_rate = "1";



$sql = "START TRANSACTION; 
INSERT INTO usercollection (coll_name, coll_desc, coll_keywords, coll_rate) 
VALUES (:coll_name, :coll_desc, :coll_keywords, :coll_rate);
INSERT INTO `possede` (`coll_name`, `date_modif`, `date_creation`, `user_name`) VALUES ('LA COLLECTION', '2023-09-01', '2023-09-07', 'djamel');
INSERT INTO `compose` (`game_title`, `coll_name`, `coll_date_add`) VALUES ('Grand theft auto : 4', 'LA COLLECTION', '2023-09-06');
COMMIT; ";

$stmt = $connexion->prepare($sql);

    // Lier les valeurs en utilisant bindValue
    $stmt->bindValue(':coll_name', $coll_name, PDO::PARAM_STR);
    $stmt->bindValue(':coll_desc', $coll_desc, PDO::PARAM_STR);
    $stmt->bindValue(':coll_keywords', $coll_keywords, PDO::PARAM_STR);
    $stmt->bindValue(':coll_rate', $coll_rate, PDO::PARAM_STR);

    $stmt->execute();

    // Vérifier si l'utilisateur existe dans la base de données
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
       echo "insertion reussi";
    } else {
        // L'authentification a échoué
        echo "insertion echoue";
    }
?>
