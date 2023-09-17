<div class="container">
    <?php
    include($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php');

    $user_name = $_SESSION['user_name']; // Remplacez par le nom d'utilisateur souhaité
    $query = "SELECT ucoll.coll_name, jeu.game_id, jeu.game_title, jeu.game_img, jeu.game_desc, 
                     GROUP_CONCAT(tags.tag_name SEPARATOR ', ') AS game_tags, puv.sell_price
              FROM possede p
              JOIN usercollection ucoll ON p.coll_name = ucoll.coll_name
              JOIN compose comp ON ucoll.coll_name = comp.coll_name
              JOIN jeu ON comp.game_id = jeu.game_id
              LEFT JOIN gametags ON jeu.game_id = gametags.game_id
              LEFT JOIN tags ON gametags.tag_id = tags.tag_id
              LEFT JOIN propose_une_vente puv ON jeu.game_id = puv.game_id
              WHERE p.user_name = :user_name
              GROUP BY ucoll.coll_name, jeu.game_id, jeu.game_title, jeu.game_img, jeu.game_desc, puv.sell_price";

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->execute();
    $collections = $stmt->fetchAll();

    if (!empty($collections)) {
        foreach ($collections as $key => $value) {
            $_SESSION['game_idjeu'] = $value['game_id'];
            echo '<div class="card bg-transparent">';
            echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
            echo '<input type="hidden" name="game_id" value="' . $value['game_id'] . '">';
            // echo '<h1>' . $value['game_id'] . '</h1>';
            echo '<button type="button" class="edit-button btn-secondary btn-edit btn btnedition" data-bs-toggle="modal" data-bs-target="#editGameModal' . $value['game_id'] . '">Editer</button>';
            echo '</form>';
            echo '<img src="../img/' . $value['game_img'] . '" alt="' . $value['game_title'] . '" class="game-image">';
            echo '<h2 class="game-title">' . $value['game_title'] . '</h2>';
            if (empty($value['sell_price'])) {
                echo '<p class="price">Prix : -- </p>';
            } else {
                echo '<p class="price">Prix : ' . $value['sell_price'] . ' €</p>';
            }
            echo '<div class="tags">';
            $tags = explode(', ', $value['game_tags']);
            foreach ($tags as $tag) {
                echo '<span class="tag">' . $tag . '</span>';
            }
            echo '</div>';
            echo '</div>';

            // Fenêtre modale Bootstrap pour chaque jeu
            echo '<div class="modal fade" id="editGameModal' . $value['game_id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-xl">';
            echo '<div class="modal-content bgcf">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Edit le jeu ' . $value['game_title'] . '</h5>';
            echo '<button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<input type="hidden" id="gameIdInput' . $value['game_id'] . '" name="game_id" value="' . $value['game_id'] . '">';
            include($_SERVER['DOCUMENT_ROOT'] .'/templates/edit.php');
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>';
            // Ajoutez le bouton "Enregistrer" ici
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Aucun résultat trouvé.";
    }

    $connexion = null;
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.edit-button').click(function () {
            // Lorsque le bouton "Éditer" est cliqué
            var gameId = $(this).closest('form').find('input[name="game_id"]').val();
            $('#gameIdInput' + gameId).val(gameId); // Pré-remplissez le champ du formulaire
        });
    });
</script>