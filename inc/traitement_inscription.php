<?php
// Inclure le fichier de connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php'); 

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $user_name = $_POST["user_name"];
    $user_mail = $_POST["user_mail"];
    $user_nickname = $_POST["user_nickname"];
    $user_pwd = $_POST["user_pwd"];
    $user_prenom = $_POST["user_prenom"];
    $user_birthdate = $_POST["user_birthdate"];
    $user_description = $_POST["user_description"];
    $user_picture = $_POST["user_picture"];

    // Préparer la requête SQL pour l'insertion
    $sql = "INSERT INTO utilisateur (user_name, user_mail, user_nickname, user_pwd, user_prenom, user_birthdate, user_description, user_picture) 
            VALUES (:user_name, :user_mail, :user_nickname, :user_pwd, :user_prenom, :user_birthdate, :user_description, :user_picture)";

    // Préparer la requête SQL avec PDO
    $stmt = $connexion->prepare($sql);

    // Lier les valeurs en utilisant bindValue
    $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->bindValue(':user_mail', $user_mail, PDO::PARAM_STR);
    $stmt->bindValue(':user_nickname', $user_nickname, PDO::PARAM_STR);
    $stmt->bindValue(':user_pwd', $user_pwd, PDO::PARAM_STR);
    $stmt->bindValue(':user_prenom', $user_prenom, PDO::PARAM_STR);
    $stmt->bindValue(':user_birthdate', $user_birthdate, PDO::PARAM_STR);
    $stmt->bindValue(':user_description', $user_description, PDO::PARAM_STR);
    $stmt->bindValue(':user_picture', $user_picture, PDO::PARAM_INT);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur lors de l'inscription : " . $stmt->errorInfo()[2]; // Pour obtenir l'erreur précise
    }

    // Fermer la connexion
    $stmt->closeCursor(); // Pour certains systèmes de base de données, utilisez closeCursor() au lieu de close()
    $connexion = null;
}
?>
