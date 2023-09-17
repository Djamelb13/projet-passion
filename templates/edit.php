<?php
// Inclure votre fichier de connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php');
var_dump($_POST);
// echo $_POST['game_id'];
echo  $_SESSION['game_idjeu'];
// Vérifiez si un identifiant de jeu à éditer est passé en paramètre GET
if (isset($_SESSION['game_idjeu'])) {
    $editGameId = $_SESSION['game_idjeu'];

    // Requête SQL pour récupérer toutes les informations du jeu
    // $sql = "
    // SELECT j.*, console.platform, e.game_condition, p.game_type, puv.sell_price
    // FROM jeu j
    // LEFT JOIN console ON j.game_id = console.game_id
    // LEFT JOIN etat e ON j.game_id = e.game_id
    // LEFT JOIN physique p ON j.game_id = p.game_id
    // LEFT JOIN propose_une_vente puv ON j.game_id = puv.game_id
    // WHERE j.game_id = :edit_game_id
    // ";

    $sql = "
    SELECT j.*, console.platform, e.game_condition, 
        CASE
            WHEN p.game_type = 'physique' THEN 'physique'
            WHEN v.game_type = 'virtuel' THEN 'virtuel'
            ELSE NULL
        END AS game_type,
        v.game_keys,  -- Ajout de la colonne game_keys
        puv.sell_price
    FROM jeu j
    LEFT JOIN console ON j.game_id = console.game_id
    LEFT JOIN etat e ON j.game_id = e.game_id
    LEFT JOIN physique p ON j.game_id = p.game_id
    LEFT JOIN virtuel v ON j.game_id = v.game_id
    LEFT JOIN propose_une_vente puv ON j.game_id = puv.game_id
    WHERE j.game_id = :edit_game_id
    ";

    $query = $connexion->prepare($sql);
    $query->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
    $query->execute();
    $gameData = $query->fetch(PDO::FETCH_ASSOC);
    var_dump($gameData);

    // Vérifiez si le jeu a été trouvé
    if ($gameData) {
        // Affichez le formulaire d'édition avec les champs pré-remplis
?>
        <div class="container">
            <h1>Édition de Jeu</h1>
            <!-- Le formulaire d'édition avec les champs pré-remplis -->
            <form enctype="multipart/form-data" method="post" action="../inc/test2.php">
            <input type="hidden" id="gameIdInput" name="game_id" value="<?= htmlspecialchars($gameData['game_id']) ?>">
                <div class="form-group">
                    <label for="game_title">Titre du Jeu</label>
                    <input type="text" class="form-control" id="game_title" name="game_title" value="<?= htmlspecialchars($gameData['game_title']) ?>">
                </div>
                <div class="form-group">
                    <label for="game_desc">Description du Jeu</label>
                    <textarea class="form-control" id="game_desc" name="game_desc"><?= htmlspecialchars($gameData['game_desc']) ?></textarea>
                </div>
                <div class="form-group">
    <label for="game_img">Image du Jeu</label>
    <img src="<?= htmlspecialchars($gameData['game_img']) ?>" alt="Aperçu de l'image" id="game_img_preview" style="max-width: 200px;">
    <input type="file" class="form-control" id="game_img" name="game_img">
</div>

                <div class="form-group">
                    <label for="platform">Plateforme du Jeu</label>
                    <input type="text" class="form-control" id="platform" name="platform" value="<?= htmlspecialchars($gameData['platform']) ?>">
                </div>
                <div class="form-group">
                    <label for="etat_name">État du Jeu</label>
                    <input type="text" class="form-control" id="etat_name" name="etat_name" value="<?= htmlspecialchars($gameData['game_condition']) ?>">
                </div>
                <div class="form-group">
    <label for="game_type">Type de Jeu</label>
    <select class="form-control" id="game_type" name="game_type">
        <option value="physique" <?= ($gameData['game_type'] == 'physique') ? 'selected' : '' ?>>Physique</option>
        <option value="virtuel" <?= ($gameData['game_type'] == 'virtuel') ? 'selected' : '' ?>>Virtuel</option>
    </select>
</div>
<div class="form-group game-keys-field">
    <label for="game_keys">Clés du Jeu (séparées par des virgules)</label>
    <input type="text" class="form-control" id="game_keys" name="game_keys" value="<?= isset($gameData['game_keys']) ? htmlspecialchars($gameData['game_keys']) : '' ?>">
</div>


                <div class="form-group">
                    <label for="sell_price">Prix de Vente</label>
                    <input type="text" class="form-control" id="sell_price" name="sell_price" value="<?= ($gameData['game_keys'] == 'null') ? '0' : (isset($gameData['sell_price']) ? htmlspecialchars($gameData['sell_price']) : '') ?>">


                </div>
                <!-- Ajoutez d'autres champs de formulaire pour les informations supplémentaires du jeu ici -->

                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </form>
        </div>
<?php
    } else {
        // Le jeu n'a pas été trouvé, affichez un message d'erreur ou redirigez l'utilisateur
        echo "Le jeu à éditer n'a pas été trouvé.";
    }
} else {
    // Aucun identifiant de jeu à éditer n'a été fourni, affichez un message d'erreur ou redirigez l'utilisateur
    echo "Identifiant de jeu à éditer manquant.";
}
?>
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluez jQuery avant Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
    // Ciblez le champ des clés par sa classe
    var gameKeysField = $(".game-keys-field");

    // Ciblez le sélecteur du type de jeu
    var gameTypeSelect = $("#game_type");

    // Gérez l'affichage/masquage du champ des clés en fonction du type de jeu sélectionné
    gameTypeSelect.change(function() {
        if (gameTypeSelect.val() === "virtuel") {
            gameKeysField.show(); // Affiche le champ des clés pour les jeux virtuels
        } else {
            gameKeysField.hide(); // Masque le champ des clés pour les jeux physiques
        }
    });

    // Assurez-vous que l'état initial de la page est correctement géré
    gameTypeSelect.trigger("change");
});
</script>

