<?php
// Démarrez la session au début de votre script
session_start();

// Inclure le fichier de connexion à la base de données
include($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php'); 

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
$user_name = $_POST["user_name"];
$user_pwd = $_POST["user_pwd"];
print_r($_POST);

// Préparer la requête SQL pour vérifier les informations de connexion
$sql = "SELECT * FROM utilisateur WHERE user_name = :user_name";

// Préparer la requête SQL avec PDO
$stmt = $connexion->prepare($sql);
print_r($stmt);

// Lier les valeurs en utilisant bindValue
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);

// Exécuter la requête
$stmt->execute();

// Récupérer l'utilisateur de la base de données
$user = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($user);

// Vérifier si l'utilisateur existe dans la base de données et vérifier le mot de passe
if ($user && password_verify($user_pwd, $user['user_pwd'])) {
    // L'utilisateur est connecté avec succès
    // Vous pouvez stocker des informations de session ou rediriger l'utilisateur vers une page sécurisée.
    $_SESSION['utilisateurConnecte'] = true;
    $_SESSION['user_name'] = $user['user_name'];
    $_SESSION['user_id'] = $user['user_id']; // Stockez l'ID de l'utilisateur dans la session par exemple
    header("Location: ../index.php"); // Rediriger vers une page sécurisée
} else {
    // L'authentification a échoué
    print_r($_POST);
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}

// Fermer la connexion
$stmt->closeCursor();
$connexion = null;

}
?>
