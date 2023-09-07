<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="text-center mb-4">Connexion</h2>
            <form action="../inc/traitement_connexion.php" method="POST">
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
