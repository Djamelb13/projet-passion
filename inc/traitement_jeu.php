<?php
include_once('connexion.php');

// Récupération des données du formulaire
$titre = $_POST['titre'];
$description = $_POST['description'];
$support = $_POST['support'];
$plateforme = $_POST['plateforme'];
$etat = $_POST['etat'];
$date = date("Y-m-d");


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

$sqlJeu = "INSERT INTO jeu (game_title, game_desc, game_img, game_date)
VALUES ('$titre', '$description', '$targetFile', '$date')";

if ($connexion->query($sqlJeu) === TRUE) {
    // Succès pour l'insertion dans la table 'jeu'
    
    // Insérer dans la table 'virtuel' si le support est virtuel
    if ($support === 'virtuel') {
        $gameKeys = $_POST['game_keys']; // Supposons que vous ayez un champ pour les clés virtuelles
        $gameType = $_POST['game_type']; // Supposons que vous ayez un champ pour le type de jeu virtuel

        $sqlVirtuel = "INSERT INTO virtuel (game_title, game_keys, game_type)
        VALUES ('$titre', '$gameKeys', '$gameType')";

        if ($conn->query($sqlVirtuel) === FALSE) {
            echo "Erreur lors de l'insertion dans la table 'virtuel' : " . $conn->error;
        }
    }
    
    // Insérer dans la table 'physique' si le support est physique
    if ($support === 'physique') {
        $gameType = $_POST['game_type']; // Supposons que vous ayez un champ pour le type de jeu physique

        $sqlPhysique = "INSERT INTO physique (game_title, game_type)
        VALUES ('$titre', '$gameType')";

        if ($conn->query($sqlPhysique) === FALSE) {
            echo "Erreur lors de l'insertion dans la table 'physique' : " . $conn->error;
        }
    }
    
    // Insérer dans la table 'console' pour la plateforme
    $platform = $_POST['platform']; // Supposons que vous ayez un champ pour la plateforme

    $sqlConsole = "INSERT INTO console (game_title, platform)
    VALUES ('$titre', '$platform')";

    if ($conn->query($sqlConsole) === FALSE) {
        echo "Erreur lors de l'insertion dans la table 'console' : " . $conn->error;
    }
    
    // Insérer dans la table 'etat' pour l'état
    $condition = $_POST['condition']; // Supposons que vous ayez un champ pour la condition de jeu

    $sqlEtat = "INSERT INTO etat (game_title, condition)
    VALUES ('$titre', '$condition')";

    if ($conn->query($sqlEtat) === FALSE) {
        echo "Erreur lors de l'insertion dans la table 'etat' : " . $conn->error;
    }
    
    echo "Le jeu a été ajouté avec succès.";
} else {
    echo "Erreur lors de l'ajout du jeu : " . $connexion->error;
}

// Fermer la connexion à la base de données
$connexion->close();
?>
