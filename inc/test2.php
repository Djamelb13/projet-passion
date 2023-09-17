<!-- var_dump($_POST);
$_GET['game_id'] = 7; -->

<?php
// Inclure votre fichier de connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php');
$_GET['game_id'] = 7;
var_dump($_POST);

// Démarrez une transaction
$connexion->beginTransaction();

try {
    // Vérifiez si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérez les données du formulaire
        $game_title = $_POST['game_title'];
        $game_desc = $_POST['game_desc'];
        $platform = $_POST['platform'];
        $etat_name = $_POST['etat_name'];
        $game_type = $_POST['game_type'];
        $sell_price = $_POST['sell_price'];
        $game_keys = $_POST['game_keys'];

        // L'identifiant du jeu à mettre à jour
        $editGameId = $_POST['game_id'];

        // Gérez la mise à jour de l'image si un nouveau fichier a été téléchargé
        if ($_FILES['game_img']['size'] > 0) {
            // Traitez et stockez le nouveau fichier d'image ici
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '../uploads/';
            $uploadFile = $uploadDir . basename($_FILES['game_img']['name']);

            if (move_uploaded_file($_FILES['game_img']['tmp_name'], $uploadFile)) {
                // Mettez à jour la colonne game_img dans la base de données avec le nouveau chemin
                $newImagePath = '../uploads/' . basename($_FILES['game_img']['name']);

                $sqlUpdateJeu = "
                UPDATE jeu
                SET game_title = :game_title,
                    game_desc = :game_desc,
                    game_img = :game_img
                WHERE game_id = :edit_game_id
                ";

                $queryUpdateJeu = $connexion->prepare($sqlUpdateJeu);
                $queryUpdateJeu->bindParam(':game_title', $game_title, PDO::PARAM_STR);
                $queryUpdateJeu->bindParam(':game_desc', $game_desc, PDO::PARAM_STR);
                $queryUpdateJeu->bindParam(':game_img', $newImagePath, PDO::PARAM_STR);
                $queryUpdateJeu->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
                $queryUpdateJeu->execute();
            } else {
                echo "Une erreur s'est produite lors du téléchargement de l'image.";
            }
        } else {
            // Si aucun nouveau fichier d'image a été téléchargé, conservez l'ancien chemin de l'image
            $sqlGetOldImagePath = "
            SELECT game_img
            FROM jeu
            WHERE game_id = :edit_game_id
            ";

            $queryGetOldImagePath = $connexion->prepare($sqlGetOldImagePath);
            $queryGetOldImagePath->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
            $queryGetOldImagePath->execute();
            $oldImagePath = $queryGetOldImagePath->fetch(PDO::FETCH_ASSOC)['game_img'];

            $sqlUpdateJeu = "
            UPDATE jeu
            SET game_title = :game_title,
                game_desc = :game_desc,
                game_img = :game_img
            WHERE game_id = :edit_game_id
            ";

            $queryUpdateJeu = $connexion->prepare($sqlUpdateJeu);
            $queryUpdateJeu->bindParam(':game_title', $game_title, PDO::PARAM_STR);
            $queryUpdateJeu->bindParam(':game_desc', $game_desc, PDO::PARAM_STR);
            $queryUpdateJeu->bindParam(':game_img', $oldImagePath, PDO::PARAM_STR);
            $queryUpdateJeu->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
            $queryUpdateJeu->execute();
        }

        // Requête SQL pour mettre à jour la plateforme dans la table "console"
        $sqlUpdateConsole = "
        UPDATE console
        SET platform = :platform
        WHERE game_id = :edit_game_id
        ";

        $queryUpdateConsole = $connexion->prepare($sqlUpdateConsole);
        $queryUpdateConsole->bindParam(':platform', $platform, PDO::PARAM_STR);
        $queryUpdateConsole->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
        $queryUpdateConsole->execute();

        // Requête SQL pour mettre à jour l'état du jeu dans la table "etat"
        $sqlUpdateEtat = "
        UPDATE etat
        SET game_condition = :etat_name
        WHERE game_id = :edit_game_id
        ";

        $queryUpdateEtat = $connexion->prepare($sqlUpdateEtat);
        $queryUpdateEtat->bindParam(':etat_name', $etat_name, PDO::PARAM_STR);
        $queryUpdateEtat->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
        $queryUpdateEtat->execute();

        // Requête SQL pour mettre à jour le type de jeu dans les tables "physique" et "virtuel"
        if ($game_type === 'physique') {
            // Vérifiez si le jeu est déjà dans la table "virtuel", le cas échéant, supprimez-le
            $sqlCheckVirtuel = "
            SELECT game_id
            FROM virtuel
            WHERE game_id = :edit_game_id
            ";

            $queryCheckVirtuel = $connexion->prepare($sqlCheckVirtuel);
            $queryCheckVirtuel->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
            $queryCheckVirtuel->execute();

            if ($queryCheckVirtuel->rowCount() > 0) {
                // Le jeu est déjà dans la table "virtuel", supprimez-le
                $sqlDeleteVirtuel = "
                DELETE FROM virtuel
                WHERE game_id = :edit_game_id
                ";

                $queryDeleteVirtuel = $connexion->prepare($sqlDeleteVirtuel);
                $queryDeleteVirtuel->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
                $queryDeleteVirtuel->execute();
                echo "jeu virtuel supprimé";
            }

            // Ajoutez le jeu à la table "physique"
            $sqlInsertPhysique = "
            INSERT INTO physique (game_id, game_type)
            VALUES (:edit_game_id, :game_type)
            ";

            $queryInsertPhysique = $connexion->prepare($sqlInsertPhysique);
            $queryInsertPhysique->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
            $queryInsertPhysique->bindParam(':game_type', $game_type, PDO::PARAM_STR);
            $queryInsertPhysique->execute();
            echo "jeu ajouté en physique";
        } elseif ($game_type === 'virtuel') {
            // Vérifiez si le jeu est déjà dans la table "physique", le cas échéant, supprimez-le
            $sqlCheckPhysique = "
            SELECT game_id
            FROM physique
            WHERE game_id = :edit_game_id
            ";

            $queryCheckPhysique = $connexion->prepare($sqlCheckPhysique);
            $queryCheckPhysique->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
            $queryCheckPhysique->execute();

            if ($queryCheckPhysique->rowCount() > 0) {
                // Le jeu est déjà dans la table "physique", supprimez-le
                $sqlDeletePhysique = "
                DELETE FROM physique
                WHERE game_id = :edit_game_id
                ";

                $queryDeletePhysique = $connexion->prepare($sqlDeletePhysique);
                $queryDeletePhysique->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
                $queryDeletePhysique->execute();
                echo "jeu physique supprimé";
            }

            // Ajoutez le jeu à la table "virtuel"
            $sqlInsertVirtuel = "
            INSERT INTO virtuel (game_id, game_type, game_keys)
            VALUES (:edit_game_id, :game_type, :game_keys)
            ";

            $queryInsertVirtuel = $connexion->prepare($sqlInsertVirtuel);
            $queryInsertVirtuel->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
            $queryInsertVirtuel->bindParam(':game_type', $game_type, PDO::PARAM_STR);
            $queryInsertVirtuel->bindParam(':game_keys', $game_keys, PDO::PARAM_STR);
            $queryInsertVirtuel->execute();
            echo "jeu ajouté en virtuel";
        }

        // Requête SQL pour mettre à jour le prix de vente dans la table "propose_une_vente"
        $sqlUpdatePrixVente = "
        UPDATE propose_une_vente
        SET sell_price = :sell_price
        WHERE game_id = :edit_game_id
        ";

        $queryUpdatePrixVente = $connexion->prepare($sqlUpdatePrixVente);
        $queryUpdatePrixVente->bindParam(':sell_price', $sell_price, PDO::PARAM_STR);
        $queryUpdatePrixVente->bindParam(':edit_game_id', $editGameId, PDO::PARAM_INT);
        $queryUpdatePrixVente->execute();

        // Validez la transaction si toutes les mises à jour ont réussi
        $connexion->commit();

        echo "Bravo ! Les informations du jeu ont été mises à jour avec succès.";

    } else {
        // Le formulaire n'a pas été soumis, affichez un message d'erreur ou redirigez l'utilisateur
        echo "Le formulaire n'a pas été soumis.";
    }
} catch (PDOException $e) {
    // En cas d'erreur, annulez la transaction
    $connexion->rollBack();
    echo "Une erreur s'est produite lors de la mise à jour du jeu : " . $e->getMessage();
}
?>

<script>
$(document).ready(function () {
    $('.btn-edit').click(function () {
        // Lorsque le bouton "Editer" est cliqué
        var gameId = $(this).data('game-id'); // Récupérez l'ID du jeu depuis l'attribut data-game-id

        // Mettez à jour le champ ID du formulaire avec l'ID du jeu
        $('#gameIdInput').val(gameId);
    });
});
</script>