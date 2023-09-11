<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('connexion.php');
print_r($_POST);

try {
    // Start a database transaction
    $connexion->beginTransaction();

    // Récupération des données du formulaire
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $support = $_POST['support'];
    $plateforme = $_POST['plateforme'];
    $etat = $_POST['etat'];
    $date = date("Y-m-d");
    $manual_tags = $_POST['manual_tags'];

    // Récupérez les tags sélectionnés depuis le champ caché
    $selectedTags = isset($_POST['tags']) ? $_POST['tags'] : [];
    $selectedTags = array_map('htmlspecialchars', $selectedTags); // Échapper les balises HTML

    // Assurez-vous que $selectedTags est un tableau valide
    if (!is_array($selectedTags)) {
        $selectedTags = [];
    }

    // Ajoutez les tags manuels s'ils sont renseignés
    if (!empty($manual_tags)) {
        $manualTagsArray = explode(',', $manual_tags);
        $manualTagsArray = array_map('trim', $manualTagsArray);
        $manualTagsArray = array_map('htmlspecialchars', $manualTagsArray); // Échapper les balises HTML

        // Fusionnez les tags manuels avec les tags sélectionnés
        $selectedTags = array_merge($selectedTags, $manualTagsArray);
    }

    // Traitement de l'image téléchargée
    $targetDir = "../uploads/imgj/"; // Répertoire où vous souhaitez enregistrer les images
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);

    // Vérification de la taille de l'image
    if ($_FILES["image"]["size"] > 20000000) {
        echo "L'image est trop volumineuse. Veuillez choisir une image de moins de 20 Mo.";
        exit();
    }

    // Vérification du format de l'image
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo "Seuls les fichiers JPG et PNG sont autorisés.";
        exit();
    }

    // Déplacer l'image vers le répertoire de destination
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "L'image a été téléchargée avec succès.";
    } else {
        echo "Erreur lors de l'envoi de l'image.";
        exit();
    }

    // Insérer le jeu dans la table 'jeu'
    $sqlJeu = "INSERT INTO jeu (game_id, game_title, game_desc, game_img, game_date, comm_id)
    VALUES (NULL, :titre, :description, :targetFile, :date, NULL)";

    $insertJeuQuery = $connexion->prepare($sqlJeu);
    $insertJeuQuery->bindParam(':titre', $titre, PDO::PARAM_STR);
    $insertJeuQuery->bindParam(':description', $description, PDO::PARAM_STR);
    $insertJeuQuery->bindParam(':targetFile', $targetFile, PDO::PARAM_STR);
    $insertJeuQuery->bindParam(':date', $date, PDO::PARAM_STR);

    if ($insertJeuQuery->execute()) {
        // Get the last inserted game_id
        $jeuId = $connexion->lastInsertId();

        // Insérer dans la table 'virtuel' si le support est virtuel
        if ($support === 'virtuel') {
            $gameKeys = $_POST['cles_cd'];

            // Concaténez les clés CD en une seule chaîne séparée par des virgules
            $cdKeysString = implode(', ', $gameKeys);

            // Insérez la chaîne de clés CD dans la table 'virtuel' avec le game_id généré
            $sqlClesCd = "INSERT INTO virtuel (game_title, game_keys, game_type, game_id) VALUES (:gametitle, :cd_keys, 'virtuel', :jeuId)";
            $insertClesCdQuery = $connexion->prepare($sqlClesCd);
            $insertClesCdQuery->bindParam(':gametitle', $titre, PDO::PARAM_STR); // Utilisez le titre du jeu
            $insertClesCdQuery->bindParam(':cd_keys', $cdKeysString, PDO::PARAM_STR);
            $insertClesCdQuery->bindParam(':jeuId', $jeuId, PDO::PARAM_INT); // Utilisez le game_id obtenu précédemment

            if ($insertClesCdQuery->execute()) {
                echo "Clés CD insérées avec succès : " . $cdKeysString;
            } else {
                echo "Erreur lors de l'insertion des clés CD : " . $insertClesCdQuery->errorInfo()[2];
            }
        }
        // Insérer dans la table 'physique' si le support est physique
        if ($support === 'physique') {
            $gameType = $_POST['support']; // Supposons que vous ayez un champ pour le type de jeu physique

            // Récupérer le game_id du jeu ajouté précédemment dans la table 'jeu'
            $sqlGetGameId = "SELECT game_id FROM jeu WHERE game_title = :gametitle";
            $getGameIdQuery = $connexion->prepare($sqlGetGameId);
            $getGameIdQuery->bindParam(':gametitle', $titre, PDO::PARAM_STR);
            $getGameIdQuery->execute();

            if ($getGameIdQuery->rowCount() > 0) {
                $row = $getGameIdQuery->fetch(PDO::FETCH_ASSOC);
                $gameId = $row['game_id'];

                // Insérer le jeu physique avec le game_id lié
                $sqlPhysique = "INSERT INTO physique (game_title, game_type, game_id) VALUES (:gametitle, :gameType, :gameId)";
                $insertPhysiqueQuery = $connexion->prepare($sqlPhysique);
                $insertPhysiqueQuery->bindParam(':gametitle', $titre, PDO::PARAM_STR);
                $insertPhysiqueQuery->bindParam(':gameType', $gameType, PDO::PARAM_STR);
                $insertPhysiqueQuery->bindParam(':gameId', $gameId, PDO::PARAM_INT);

                if ($insertPhysiqueQuery->execute()) {
                    echo "Le jeu physique a été ajouté avec succès.";
                } else {
                    echo "Erreur lors de l'insertion dans la table 'physique' : " . $insertPhysiqueQuery->errorInfo()[2];
                }
            } else {
                echo "Erreur : Le jeu correspondant n'a pas été trouvé dans la table 'jeu'.";
            }
        }

        // Insérer dans la table 'console' pour la plateforme
        $plateforme = $_POST['plateforme']; // Supposons que vous ayez un champ pour la plateforme

        $sqlConsole = "INSERT INTO console (game_title, platform)
        VALUES (:gametitle, :plateforme)";

        $insertConsoleQuery = $connexion->prepare($sqlConsole);
        $insertConsoleQuery->bindParam(':gametitle', $titre, PDO::PARAM_STR);
        $insertConsoleQuery->bindParam(':plateforme', $plateforme, PDO::PARAM_STR);

        if ($insertConsoleQuery->execute()) {
            echo "Le jeu a été ajouté à la plateforme avec succès.";
        } else {
            echo "Erreur lors de l'insertion dans la table 'console' : " . $insertConsoleQuery->errorInfo()[2];
        }

        // Insérer dans la table 'etat' pour l'état
        $sqlEtat = "INSERT INTO etat (game_title, game_condition)
        VALUES (:gametitle, :etat)";

        $insertEtatQuery = $connexion->prepare($sqlEtat);
        $insertEtatQuery->bindParam(':gametitle', $titre, PDO::PARAM_STR);
        $insertEtatQuery->bindParam(':etat', $etat, PDO::PARAM_STR);

        if ($insertEtatQuery->execute()) {
            echo "L'état du jeu a été ajouté avec succès.";
        } else {
            echo "Erreur lors de l'insertion dans la table 'etat' : " . $insertEtatQuery->errorInfo()[2];
        }

        // Lier les tags au jeu
        foreach ($selectedTags  as $tag) {
            // Vérifiez si le tag existe déjà dans la table des tags
            $query = $connexion->prepare("SELECT tag_id FROM tags WHERE tag_name = :tag_name");
            $query->bindParam(':tag_name', $tag, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() > 0) {
                // Le tag existe déjà, récupérez son ID
                $row = $query->fetch(PDO::FETCH_ASSOC);
                $tagId = $row['tag_id'];
            } else {
                // Le tag n'existe pas encore, insérez-le et récupérez son ID
                $insertTagQuery = $connexion->prepare("INSERT INTO tags (tag_id, tag_name) VALUES (NULL, :tag_name)");
                $insertTagQuery->bindParam(':tag_name', $tag, PDO::PARAM_STR);

                if ($insertTagQuery->execute()) {
                    $tagId = $connexion->lastInsertId();
                } else {
                    echo "Erreur lors de l'insertion du tag dans la table 'tags' : " . $insertTagQuery->errorInfo()[2];
                    continue; // Passez au tag suivant en cas d'erreur
                }
            }

            // Utilisez $jeuId pour lier le jeu au tag dans la table associative
            $linkTagQuery = $connexion->prepare("INSERT INTO gametags (game_id, tag_id) VALUES (:game_id, :tag_id)");
            $linkTagQuery->bindParam(':game_id', $jeuId, PDO::PARAM_INT);
            $linkTagQuery->bindParam(':tag_id', $tagId, PDO::PARAM_INT);

            if ($linkTagQuery->execute()) {
                echo "Le lien entre le jeu et le tag a été établi avec succès.";
            } else {
                echo "Erreur lors de la liaison du jeu au tag : " . $linkTagQuery->errorInfo()[2];
            }
        }

        // Ajouter le jeu à la collection de l'utilisateur dans la table 'compose'
        try {
            // Récupérer le nom de l'utilisateur à partir de la session ou des données POST
            $userName = $_SESSION['user_name']; // Assurez-vous d'avoir une session utilisateur en place

            // Récupérer le nom de la collection de l'utilisateur
            $sqlGetCollName = "SELECT coll_name FROM possede WHERE user_name = :username";
            $getCollNameQuery = $connexion->prepare($sqlGetCollName);
            $getCollNameQuery->bindParam(':username', $userName, PDO::PARAM_STR);
            $getCollNameQuery->execute();

            if ($getCollNameQuery->rowCount() > 0) {
                $row = $getCollNameQuery->fetch(PDO::FETCH_ASSOC);
                $collName = $row['coll_name'];

                // ...
                
                // Insérer dans la table 'compose' avec le nom de la collection de l'utilisateur
                $sqlCompose = "INSERT INTO compose (game_title, coll_name, coll_date_add)
                VALUES (:gametitle, :collname, :date)";
        
                $insertComposeQuery = $connexion->prepare($sqlCompose);
                $insertComposeQuery->bindParam(':gametitle', $titre, PDO::PARAM_STR);
                $insertComposeQuery->bindParam(':collname', $collName, PDO::PARAM_STR);
                $insertComposeQuery->bindParam(':date', $date, PDO::PARAM_STR);
        
                if ($insertComposeQuery->execute()) {
                    echo "Le jeu a été ajouté à la collection avec succès.";
                } else {
                    echo "Erreur lors de l'insertion dans la table 'compose' : " . $insertComposeQuery->errorInfo()[2];
                }

                // ...
            } else {
                echo "Aucune collection trouvée pour l'utilisateur.";
            }
        } catch (PDOException $e) {
            // Roll back the transaction on error
            $connexion->rollBack();
            echo "Une erreur s'est produite : " . $e->getMessage();
        }

        // Commit the transaction
        $connexion->commit();

        echo "Le jeu a été ajouté avec succès.";
    }
} catch (PDOException $e) {
    // Roll back the transaction on error
    $connexion->rollBack();
    echo "Une erreur s'est produite : " . $e->getMessage();
}

// Fermer la connexion à la base de données
$connexion = null;
header('Location: /');
exit;
?>
