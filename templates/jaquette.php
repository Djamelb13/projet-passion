

<?php
    // Inclure le fichier de connexion à la base de données
    include_once($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php');
    if (!$connexion) {
        echo "Erreur de connexion à la base de données.";
        exit();
    }
    // Requête SQL pour récupérer les données des jeux
    $sql = "SELECT jeu.game_title, jeu.game_desc, jeu.game_img, jeu.game_date, jeu.comm_id, GROUP_CONCAT(tags.tag_name SEPARATOR ', ') AS game_tags, propose_une_vente.sell_price
            FROM jeu
            LEFT JOIN gametags ON jeu.game_id = gametags.game_id
            LEFT JOIN tags ON gametags.tag_id = tags.tag_id
            LEFT JOIN propose_une_vente ON jeu.game_title = propose_une_vente.game_title
            GROUP BY jeu.game_title";

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
