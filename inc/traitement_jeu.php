<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('connexion.php');

// Récupération des données du formulaire
$titre = $_POST['titre'];
$description = $_POST['description'];
$support = $_POST['support'];
$plateforme = $_POST['plateforme'];
$etat = $_POST['etat'];
$date = date("Y-m-d");
$tags = $_POST['tags'];

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
VALUES (NULL, '$titre', '$description', '$targetFile', '$date', NULL)";
echo $sqlJeu;

if ($connexion->query($sqlJeu) == TRUE) {
    echo "COUCOU";
    // Succès pour l'insertion dans la table 'jeu'
    $jeuId = $connexion->lastInsertId();
    echo $jeuId;

    // Insérer dans la table 'virtuel' si le support est virtuel
    if ($support === 'virtuel') {
        $gameKeys = $_POST['cles_cd'];
        $gametitle = $_POST['titre'];
    
        foreach ($gameKeys as $key) {
            // Insérez chaque clé CD dans la table 'virtuel'
            $sqlClesCd = "INSERT INTO virtuel (game_title, game_keys, game_type) VALUES (:gametitle, :cles_cd, 'virtuel')";
            $insertClesCdQuery = $connexion->prepare($sqlClesCd);
            $insertClesCdQuery->bindParam(':gametitle', $gametitle, PDO::PARAM_STR);
            $insertClesCdQuery->bindParam(':cles_cd', $key, PDO::PARAM_STR);
        
            if ($insertClesCdQuery->execute()) {
                echo "Clé CD insérée avec succès : $key";
            } else {
                echo "Erreur lors de l'insertion de la clé CD : " . $insertClesCdQuery->errorInfo()[2];
            }
        }
    }

    // Insérer dans la table 'physique' si le support est physique
    if ($support === 'physique') {
        $gameType = $_POST['game_type']; // Supposons que vous ayez un champ pour le type de jeu physique

        $sqlPhysique = "INSERT INTO physique (game_title, game_type)
        VALUES ('$titre', '$gameType')";

        if ($connexion->query($sqlPhysique) === FALSE) {
            $errorInfo = $connexion->errorInfo();
            echo "Erreur lors de l'insertion dans la table 'physique' : " . $connexion->errorInfo()[2];
        }
    }

    // Insérer dans la table 'console' pour la plateforme
    $platform = $_POST['platform']; // Supposons que vous ayez un champ pour la plateforme

    $sqlConsole = "INSERT INTO console (game_title, platform)
    VALUES ('$titre', '$platform')";

    if ($connexion->query($sqlConsole) === FALSE) {
        $errorInfo = $connexion->errorInfo();
        echo "Erreur lors de l'insertion dans la table 'console' : " . $connexion->errorInfo()[2];
    }

    // Insérer dans la table 'etat' pour l'état
    $etat = $_POST['etat']; // Supposons que vous ayez un champ pour la condition de jeu

    $sqlEtat = "INSERT INTO etat (game_title, condition)
    VALUES ('$titre', '$etat')";

    if ($connexion->query($sqlEtat) === FALSE) {
        $errorInfo = $connexion->errorInfo();
        echo "Erreur lors de l'insertion dans la table 'etat' : " . $connexion->errorInfo()[2];
    }

    // Lier les tags au jeu
    foreach ($tags as $tag) {
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
            $insertTagQuery = $connexion->prepare("INSERT INTO tags (tag_name) VALUES (:tag_name)");
            $insertTagQuery->bindParam(':tag_name', $tag, PDO::PARAM_STR);

            if ($insertTagQuery->execute()) {
                $tagId = $connexion->lastInsertId();
            } else {
                echo "Erreur lors de l'insertion du tag dans la table 'tags' : " . $insertTagQuery->errorInfo()[2];
                continue; // Passez au tag suivant en cas d'erreur
            }
        }
echo "on est la";
        // Utilisez $jeuId pour lier le jeu au tag dans la table associative
        $linkTagQuery = $connexion->prepare("INSERT INTO gametags (game_id, tag_id) VALUES (:game_id, :tag_id)");
        $linkTagQuery->bindParam(':game_id', $jeuId, PDO::PARAM_INT);
        $linkTagQuery->bindParam(':tag_id', $tagId, PDO::PARAM_INT);

        if ($linkTagQuery->execute()) {
            $lastGameId = $connexion->lastInsertId('game_id'); // Récupérer la dernière valeur insérée pour game_id
            $lastTagId = $connexion->lastInsertId('tag_id');   // Récupérer la dernière valeur insérée pour tag_id
            echo "Le lien entre le jeu et le tag a été établi avec succès. game_id = $lastGameId, tag_id = $lastTagId";
        } else {
            echo "Erreur lors de la liaison du jeu au tag : " . $linkTagQuery->errorInfo()[2];
        }
    }

    echo "Le jeu a été ajouté avec succès.";
} else {
    echo "Erreur lors de l'ajout du jeu : " . $connexion->errorInfo()[2];
    var_dump($connexion->errorInfo()[2]);
    echo "Le code dans la branche else est exécuté.";
}

// Fermer la connexion à la base de données
$connexion = null;
