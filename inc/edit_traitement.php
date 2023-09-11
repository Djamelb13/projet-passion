<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Démarrez une transaction
        $connexion->beginTransaction();

        // Récupérez les nouvelles données du jeu à partir du formulaire
        $newGameTitle = $_POST['titre'];
        $newGameDescription = $_POST['description'];

        // Validez les données au besoin

        // Mettez à jour le champ 'game_title' dans la table 'jeu'
        $sqlUpdateJeu = "UPDATE jeu SET game_title = :new_title, game_desc = :new_description WHERE game_title = :edit_game_id";
        $queryUpdateJeu = $connexion->prepare($sqlUpdateJeu);
        $queryUpdateJeu->bindParam(':new_title', $newGameTitle, PDO::PARAM_STR);
        $queryUpdateJeu->bindParam(':new_description', $newGameDescription, PDO::PARAM_STR);
        $queryUpdateJeu->bindParam(':edit_game_id', $gameTitle, PDO::PARAM_STR); // Utilisez l'ancien titre du jeu comme identifiant

        if ($queryUpdateJeu->execute()) {
            // Mettez à jour la table 'propose_une_vente'
            $sqlUpdatePropose = "UPDATE propose_une_vente SET game_title = :new_title WHERE game_title = :edit_game_id";
            $queryUpdatePropose = $connexion->prepare($sqlUpdatePropose);
            $queryUpdatePropose->bindParam(':new_title', $newGameTitle, PDO::PARAM_STR);
            $queryUpdatePropose->bindParam(':edit_game_id', $gameTitle, PDO::PARAM_STR);

            if ($queryUpdatePropose->execute()) {
                // Mettez à jour la table 'compose'
                $sqlUpdateCompose = "UPDATE compose SET game_title = :new_title WHERE game_title = :edit_game_id";
                $queryUpdateCompose = $connexion->prepare($sqlUpdateCompose);
                $queryUpdateCompose->bindParam(':new_title', $newGameTitle, PDO::PARAM_STR);
                $queryUpdateCompose->bindParam(':edit_game_id', $gameTitle, PDO::PARAM_STR);

                if ($queryUpdateCompose->execute()) {
                    // Mettez à jour la table 'etat'
                    $sqlUpdateEtat = "UPDATE etat SET game_title = :new_title WHERE game_title = :edit_game_id";
                    $queryUpdateEtat = $connexion->prepare($sqlUpdateEtat);
                    $queryUpdateEtat->bindParam(':new_title', $newGameTitle, PDO::PARAM_STR);
                    $queryUpdateEtat->bindParam(':edit_game_id', $gameTitle, PDO::PARAM_STR);

                    if ($queryUpdateEtat->execute()) {
                        // Mettez à jour la table 'console'
                        $sqlUpdateConsole = "UPDATE console SET game_title = :new_title WHERE game_title = :edit_game_id";
                        $queryUpdateConsole = $connexion->prepare($sqlUpdateConsole);
                        $queryUpdateConsole->bindParam(':new_title', $newGameTitle, PDO::PARAM_STR);
                        $queryUpdateConsole->bindParam(':edit_game_id', $gameTitle, PDO::PARAM_STR);

                        if ($queryUpdateConsole->execute()) {
                            // Si toutes les mises à jour réussissent, validez la transaction
                            $connexion->commit();

                            // Redirigez l'utilisateur vers une page de confirmation
                            header('Location: /inc/edit_traitement.php');
                            exit;
                        } else {
                            // En cas d'erreur lors de la mise à jour de 'console'
                            echo "Erreur lors de la mise à jour de 'console' : " . $queryUpdateConsole->errorInfo()[2];
                        }
                    } else {
                        // En cas d'erreur lors de la mise à jour de 'etat'
                        echo "Erreur lors de la mise à jour de 'etat' : " . $queryUpdateEtat->errorInfo()[2];
                    }
                } else {
                    // En cas d'erreur lors de la mise à jour de 'compose'
                    echo "Erreur lors de la mise à jour de 'compose' : " . $queryUpdateCompose->errorInfo()[2];
                }
            } else {
                // En cas d'erreur lors de la mise à jour de 'propose_une_vente'
                echo "Erreur lors de la mise à jour de 'propose_une_vente' : " . $queryUpdatePropose->errorInfo()[2];
            }
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
}
?>
