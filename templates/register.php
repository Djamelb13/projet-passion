<?php include($_SERVER['DOCUMENT_ROOT'] .'/inc/head.php'); ?>

<div class="container">
    <form action="../inc/traitement_inscription.php" method="POST" class="mt-4">
        <div class="mb-3">
            <label for="user_name" class="form-label">Nom d'utilisateur :</label>
            <input type="text" name="user_name" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="user_mail" class="form-label">Adresse e-mail :</label>
            <input type="email" name="user_mail" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="user_nickname" class="form-label">Pseudo :</label>
            <input type="text" name="user_nickname" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="user_pwd" class="form-label">Mot de passe :</label>
            <input type="password" name="user_pwd" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="user_prenom" class="form-label">Prénom :</label>
            <input type="text" name="user_prenom" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="user_birthdate" class="form-label">Date de naissance :</label>
            <input type="date" name="user_birthdate" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="user_description" class="form-label">Description :</label>
            <textarea name="user_description" class="form-control"></textarea>
        </div>
        
        <div class="mb-3">
            <label for="user_picture" class="form-label">Image (1 pour une image, 0 sinon) :</label>
            <input type="number" name="user_picture" class="form-control" min="0" max="1" required>
        </div>
        
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>
