<?php
try {
    $connexion = new PDO(
        'mysql:host=localhost;dbname=bdd;charset=utf8',
        'root',
        ''
    );
    echo 'C\'est trop facile le code &#128512; ';
    
} catch(PDOException $e) {
    echo "C'est pas facile le code &#128546;" . $e->getMessage();
}

$sql = "SELECT jeu.game_title, jeu.game_desc, jeu.game_img, jeu.game_date, jeu.comm_id, GROUP_CONCAT(tags.tag_name SEPARATOR ', ') AS game_tags, propose_une_vente.sell_price
            FROM jeu
            LEFT JOIN gametags ON jeu.game_id = gametags.game_id
            LEFT JOIN tags ON gametags.tag_id = tags.tag_id
            LEFT JOIN propose_une_vente ON jeu.game_title = propose_une_vente.game_title
            GROUP BY jeu.game_title";


$result = $connexion->query($sql);

// Vérifier s'il y a des résultats
if ($result) {
    // Utilisez rowCount() pour obtenir le nombre de lignes
    $num_rows = $result->rowCount();
    
    if ($num_rows > 0) {
        // Parcourir les résultats
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Afficher les données dans une carte pour chaque ligne
            echo "<div class='card'>";
            echo "<h2>" . $row["game_title"] . "</h2>";
            echo "<p>Prix : " . $row["sell_price"] . "</p>";
            echo "<p>Tags : " . $row["game_tags"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "Aucun résultat trouvé.";
    }
} else {
    // Gérer les erreurs de requête
    echo "Erreur de requête : " . $connexion->errorInfo()[2];
}
?>
