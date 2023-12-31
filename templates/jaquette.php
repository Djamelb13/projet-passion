<div class="container">
<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php');


$user_name = $_SESSION['user_name']; // Remplacez par le nom d'utilisateur souhaité
$query = "SELECT ucoll.coll_name, comp.game_id, jeu.game_img, jeu.game_desc, GROUP_CONCAT(tags.tag_name SEPARATOR ', ') AS game_tags
          FROM possede p
          JOIN usercollection ucoll ON p.coll_name = ucoll.coll_name
          JOIN compose comp ON ucoll.coll_name = comp.coll_name
          JOIN jeu ON comp.game_id = jeu.game_id
          LEFT JOIN gametags ON jeu.game_id = gametags.game_id
          LEFT JOIN tags ON gametags.tag_id = tags.tag_id
          
          WHERE p.user_name = :user_name
          GROUP BY ucoll.coll_name, comp.game_id, jeu.game_img, jeu.game_desc";

$stmt = $connexion->prepare($query);
$stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
$stmt->execute();

$collections = $stmt -> fetchAll();

if(!empty($collections)){
foreach ($collections as $key => $value) {
    echo '<div class="card bg-transparent">';
    echo '<img src="../img/' . $value['game_img'] . '" alt="' . $value['game_id'] . '" class="game-image">';
    echo '<h2 class="game-title">' . $value['game_id'] . '</h2>';
    if (empty($value['sell_price'])) {
        echo '<p class="price">Prix : -- </p>';
    }else {echo '<p class="price">Prix : 22 € €</p>';}
    // echo '<p class="price">Prix : ' . $value['sell_price'] . ' €</p>';
    echo '<div class="tags">';
    $tags = explode(', ', $value['game_tags']);
    foreach ($tags as $tag) {
        echo '<span class="tag">' . $tag . '</span>';
    }
    echo '</div>';
    echo '</div>';
}
}
else { echo "Aucun résultat trouvé.";}


$connexion = null;
?>
</div>