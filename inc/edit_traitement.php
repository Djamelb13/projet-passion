<?php
session_start();
// error_reporting(E_ALL);
ini_set('display_errors', 1);
print_r($_POST);
var_dump($_POST);
include($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "OOOH";
    try {
        echo "ca marche";
        // Démarrez une transaction
        $connexion->beginTransaction();

        // Récupérez les nouvelles données du jeu à partir du formulaire
        $newGameTitle = $_POST['titre'];
        $newGameDescription = $_POST['description'];
        $gameId = 3;// Nouvellement ajouté pour identifier le jeu

        // Validez les données au besoin

        // Mettez à jour le champ 'game_title' dans la table 'jeu' avec 'game_id' comme identifiant
        $sqlUpdateJeu = "UPDATE jeu SET game_title = :new_title, game_desc = :new_description WHERE game_id = :game_id";
        $queryUpdateJeu = $connexion->prepare($sqlUpdateJeu);
        $queryUpdateJeu->bindParam(':new_title', $newGameTitle, PDO::PARAM_STR);
        $queryUpdateJeu->bindParam(':new_description', $newGameDescription, PDO::PARAM_STR);
        $queryUpdateJeu->bindParam(':game_id', $gameId, PDO::PARAM_INT); // Utilisez 'game_id' comme identifiant

        if ($queryUpdateJeu->execute()) {
            // Si toutes les mises à jour réussissent, validez la transaction
            $connexion->commit();

            // Redirigez l'utilisateur vers une page de confirmation
            // header('Location: /inc/edit_traitement.php');
            exit;
        } else {
            // En cas d'erreur lors de la mise à jour du jeu principal
            echo "Erreur lors de la mise à jour du jeu : " . $queryUpdateJeu->errorInfo()[2];
        }
    } catch (PDOException $e) {
        // Si une erreur survient, annulez la transaction et affichez un message d'erreur
        $connexion->rollBack();
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
} else {
    // Si le formulaire n'a pas été soumis par POST, redirigez l'utilisateur vers une autre page ou affichez un message d'erreur
    echo "Requête invalide.";
    echo 'Titre posté : ' . $_POST['titre'];
    print_r($_POST);
}
?>
