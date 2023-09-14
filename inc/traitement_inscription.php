<?php
// Inclure le fichier de connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'] . '/inc/connexion.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et nettoyer les données du formulaire
    $user_name = filter_input(INPUT_POST, "user_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $user_mail = filter_input(INPUT_POST, "user_mail", FILTER_SANITIZE_EMAIL);
    $user_nickname = filter_input(INPUT_POST, "user_nickname", FILTER_SANITIZE_SPECIAL_CHARS);
    $user_pwd = $_POST["user_pwd"]; // Nous allons hacher le mot de passe
    $user_prenom = filter_input(INPUT_POST, "user_prenom", FILTER_SANITIZE_SPECIAL_CHARS);
    $user_birthdate = $_POST["user_birthdate"];
    $user_description = filter_input(INPUT_POST, "user_description", FILTER_SANITIZE_SPECIAL_CHARS);
    $user_picture = intval($_POST["user_picture"]); // S'assurer que c'est un entier (0 ou 1)

    // Vérifier que les données sont valides
    if (empty($user_name) || empty($user_mail) || empty($user_nickname) || empty($user_pwd) || empty($user_prenom) || empty($user_birthdate)) {
        echo "Tous les champs obligatoires doivent être remplis.";
    } else {
        // Hacher le mot de passe
        $hashed_password = password_hash($user_pwd, PASSWORD_DEFAULT);

        // Définir des valeurs par défaut pour les champs de collection
        $collectionname = "Collection de " . $user_name;
        $coll_desc = "Insérez ici votre description";
        $coll_keywords = "Mots clés de votre collection";
        $coll_rate = 1;

        // Préparer la requête SQL pour l'insertion
        $sql = "START TRANSACTION;
            INSERT INTO utilisateur (user_name, user_mail, user_nickname, user_pwd, user_prenom, user_birthdate, user_description, user_picture)
            VALUES (:user_name, :user_mail, :user_nickname, :user_pwd, :user_prenom, :user_birthdate, :user_description, :user_picture);
            
            INSERT INTO usercollection (coll_name, coll_desc, coll_keywords, coll_rate)
            VALUES (:coll_name, :coll_desc, :coll_keywords, :coll_rate);
            
            INSERT INTO possede (coll_name, date_modif, date_creation, user_name)
            VALUES (:coll_name, NOW(), NOW(), :user_name);
            
            COMMIT;";

        // Préparer la requête SQL avec PDO
        $stmt = $connexion->prepare($sql);

        // Lier les valeurs en utilisant bindValue
        $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->bindValue(':user_mail', $user_mail, PDO::PARAM_STR);
        $stmt->bindValue(':user_nickname', $user_nickname, PDO::PARAM_STR);
        $stmt->bindValue(':user_pwd', $hashed_password, PDO::PARAM_STR);
        $stmt->bindValue(':user_prenom', $user_prenom, PDO::PARAM_STR);
        $stmt->bindValue(':user_birthdate', $user_birthdate, PDO::PARAM_STR);
        $stmt->bindValue(':user_description', $user_description, PDO::PARAM_STR);
        $stmt->bindValue(':user_picture', $user_picture, PDO::PARAM_INT);
        $stmt->bindValue(':coll_name', $collectionname, PDO::PARAM_STR);
        $stmt->bindValue(':coll_desc', $coll_desc, PDO::PARAM_STR);
        $stmt->bindValue(':coll_keywords', $coll_keywords, PDO::PARAM_STR);
        $stmt->bindValue(':coll_rate', $coll_rate, PDO::PARAM_INT);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Inscription réussie !";
        } else {
            echo "Erreur lors de l'inscription : " . $stmt->errorInfo()[2];
        }

        // Fermer la connexion
        $stmt->closeCursor();
        $connexion = null;
    }
}
