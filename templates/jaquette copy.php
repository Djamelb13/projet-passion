<div class="container">
<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php');

$user_name = $_SESSION['user_name']; // Remplacez par le nom d'utilisateur souhaité
$query = "SELECT ucoll.coll_name, comp.game_title, jeu.game_img, jeu.game_desc, propose_une_vente.sell_price, GROUP_CONCAT(tags.tag_name SEPARATOR ', ') AS game_tags
          FROM possede p
          JOIN usercollection ucoll ON p.coll_name = ucoll.coll_name
          JOIN compose comp ON ucoll.coll_name = comp.coll_name
          JOIN jeu ON comp.game_title = jeu.game_title
          LEFT JOIN gametags ON jeu.game_id = gametags.game_id
          LEFT JOIN tags ON gametags.tag_id = tags.tag_id
          LEFT JOIN propose_une_vente ON jeu.game_title = propose_une_vente.game_title
          WHERE p.user_name = :user_name
          GROUP BY ucoll.coll_name, comp.game_title, jeu.game_img, jeu.game_desc, propose_une_vente.sell_price";

$stmt = $connexion->prepare($query);
$stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
$stmt->execute();

$collections = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $coll_name = $row['coll_name'];
    $game_title = $row['game_title'];
    $game_img = $row['game_img'];
    $game_desc = $row['game_desc'];
    $sell_price = $row['sell_price'];
    $game_tags = $row['game_tags'];
    
    echo '<div class="card bg-transparent">';
    echo '<img src="../img/' . $game_img . '" alt="' . $game_title . '" class="game-image">';
    echo '<h2 class="game-title">' . $game_title . '</h2>';
    echo '<p class="price">Prix : ' . $sell_price . ' €</p>';
    echo '<div class="tags">';
    $tags = explode(', ', $game_tags);
    foreach ($tags as $tag) {
        echo '<span class="tag">' . $tag . '</span>';
    }
    echo '</div>';
    echo '</div>';
}

if (empty($collections)) {
    echo "Aucun résultat trouvé.";
}

$connexion = null;
?>
</div>