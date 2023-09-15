<?php
// session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once($_SERVER['DOCUMENT_ROOT'].'/inc/connexion.php');
$game = "MUCK";
echo $game;

// Vérifiez si un identifiant de jeu à éditer est passé en paramètre GET
if (isset($game)) {
    $game = "Starcraft : II";
    $editGameId = $game;
    echo $game;

    // Récupérez les données du jeu à éditer à partir de la base de données
    $sql = "SELECT * FROM jeu WHERE  game_title = :edit_game_id";
    $query = $connexion->prepare($sql);
    $query->bindParam(':edit_game_id', $editGameId, PDO::PARAM_STR);
    var_dump($query);
    var_dump($editGameId);
    $query->execute();
    $gameData = $query->fetch(PDO::FETCH_ASSOC);
    var_dump($gameData);

    if (!$gameData) {
        // Le jeu n'a pas été trouvé, affichez un message d'erreur ou redirigez l'utilisateur
        echo "Le jeu à éditer n'a pas été trouvé.";
        exit;
    }
} else {
    // Aucun identifiant de jeu à éditer n'a été fourni, affichez un message d'erreur ou redirigez l'utilisateur
    echo "Identifiant de jeu à éditer manquant.";
    exit;
}

echo $editGameId;
echo $game;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Édition de Jeu</title>
    <!-- Mettez ici les liens CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Édition de Jeu</h1>
        <!-- Le formulaire d'édition avec les champs pré-remplis -->
        <form enctype="multipart/form-data" method="post" action="../inc/edit_traitement.php">
            <div class="form-group">
                <label for="titre">Titre du Jeu</label>
                <input type="text" class="form-control" id="titre" name="titre" value="<?= htmlspecialchars($gameData['game_title']) ?>">
            </div>
            <div class="form-group">
                <label for="description">Description du Jeu</label>
                <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($gameData['game_desc']) ?></textarea>
            </div>
            <!-- Autres champs de formulaire pour les autres données du jeu -->
            <!-- Ajoutez d'autres champs ici avec les données du jeu pré-remplies -->

            <!-- Bouton de soumission du formulaire -->
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="text-center mb-4">Connexion</h2>
            <form action="../inc/edit_traitement.php" method="POST">
                <div class="mb-3">
                    <label for="user_name" class="form-label">Nom d'utilisateur :</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" required>
                </div>
                <div class="mb-3">
                    <label for="user_pwd" class="form-label">Mot de passe :</label>
                    <input type="password" class="form-control" id="user_pwd" name="user_pwd" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Mettez ici les scripts Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
