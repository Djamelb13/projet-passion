<?php session_start();
 include($_SERVER['DOCUMENT_ROOT'] .'/inc/head.php'); 
include($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php');

$user_name = $_SESSION['user_name']; // Remplacez par le nom d'utilisateur souhaité
$query = "SELECT ucoll.coll_name, comp.game_title 
          FROM possede p
          JOIN usercollection ucoll ON p.coll_name = ucoll.coll_name
          JOIN compose comp ON ucoll.coll_name = comp.coll_name
          WHERE p.user_name = :user_name";

$stmt = $connexion->prepare($query);
$stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
$stmt->execute();

$collections = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $coll_name = $row['coll_name'];
    $game_title = $row['game_title'];
    
    // Stockez les jeux dans un tableau associatif par collection
    if (!isset($collections[$coll_name])) {
        $collections[$coll_name] = [];
    }
    
    $collections[$coll_name][] = $game_title;
}

// Affichez les jeux par collection avec un message personnalisé
foreach ($collections as $coll_name => $games) {
    $games_list = implode(', ', $games);
    echo "Bonjour $user_name, dans votre collection \"$coll_name\" vous possédez : $games_list.<br>";
}
?>

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

<?php
    // Inclure le fichier de connexion à la base de données
    include($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php');
    if (!$connexion) {
        echo "Erreur de connexion à la base de données.";
        exit();
    }
    // Requête SQL pour récupérer les données des jeux
    // $sql = "SELECT jeu.game_title, GROUP_CONCAT(jeu.game_desc) AS game_desc, jeu.game_img, jeu.game_date, jeu.comm_id, GROUP_CONCAT(tags.tag_name SEPARATOR ', ') AS game_tags, propose_une_vente.sell_price
    //     FROM jeu
    //     LEFT JOIN gametags ON jeu.game_id = gametags.game_id
    //     LEFT JOIN tags ON gametags.tag_id = tags.tag_id
    //     LEFT JOIN propose_une_vente ON jeu.game_title = propose_une_vente.game_title
    //     GROUP BY jeu.game_title, jeu.game_img, jeu.game_date, jeu.comm_id, propose_une_vente.sell_price";
//     $user_name = $_SESSION['user_name'];
//     $sql = "SELECT jeu.game_title, GROUP_CONCAT(jeu.game_desc) AS game_desc, jeu.game_img, jeu.game_date, jeu.comm_id, GROUP_CONCAT(tags.tag_name SEPARATOR ', ') AS game_tags, usercollection.coll_name
//     FROM usercollection
//     INNER JOIN compose ON usercollection.coll_id = compose.coll_id
//     INNER JOIN jeu ON compose.game_id = jeu.game_id
//     LEFT JOIN gametags ON jeu.game_id = gametags.game_id
//     LEFT JOIN tags ON gametags.tag_id = tags.tag_id
//     WHERE usercollection.user_name = :user_name
//     GROUP BY jeu.game_title, jeu.game_img, jeu.game_date, jeu.comm_id, usercollection.coll_name";

// $result = $connexion->prepare($sql);
// $result->bindParam(':user_name', $user_name, PDO::PARAM_STR);
// $result->execute();

    // $result = $connexion->query($sql);
$sql = "SELECT jeu.game_title, jeu.game_desc, jeu.game_img, jeu.game_date, jeu.comm_id, GROUP_CONCAT(tags.tag_name SEPARATOR ', ') AS game_tags, propose_une_vente.sell_price
        FROM jeu
        LEFT JOIN gametags ON jeu.game_id = gametags.game_id
        LEFT JOIN tags ON gametags.tag_id = tags.tag_id
        LEFT JOIN propose_une_vente ON jeu.game_title = propose_une_vente.game_title
        GROUP BY jeu.game_title, jeu.game_desc, jeu.game_img, jeu.game_date, jeu.comm_id, propose_une_vente.sell_price";
$result = $connexion->query($sql);


?>
<div class="container">
<?php
    if ($result) {
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="card bg-transparent ">';
                echo '<img src="../img/' . $row["game_img"] . '" alt="' . $row["game_title"] . '" class="game-image">';
                echo '<h2 class="game-title">' . $row["game_title"] . '</h2>';
                echo '<p class="price">Prix : ' . $row["sell_price"] . ' €</p>';
                echo '<div class="tags">';
                $tags = explode(', ', $row["game_tags"]);
                foreach ($tags as $tag) {
                    echo '<span class="tag">' . $tag . '</span>';
                }
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Aucun résultat trouvé.";
        }
    } else {
        echo "Erreur de requête : " . $connexion->errorInfo()[2];
    }
    $connexion = null;
    ?>
</div>





