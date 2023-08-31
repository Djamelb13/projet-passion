<?php include_once('../inc/head.php')?>
<div class="container">
        <h1>Ajouter un jeu</h1>
        <form enctype="multipart/form-data" method="post" action="../inc/traitement_jeu.php">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre du jeu</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description du jeu</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image (JPG ou PNG, max 20 Mo)</label>
                <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png" required>
            </div>
            <div class="mb-3">
                <label for="support" class="form-label">Support du jeu</label>
                <select class="form-select" id="support" name="support" required>
                    <option value="physique">Physique</option>
                    <option value="virtuel">Virtuel</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="plateforme" class="form-label">Console/Plateforme</label>
                <input type="text" class="form-control" id="plateforme" name="plateforme" required>
            </div>
            <div class="mb-3">
                <label for="etat" class="form-label">État</label>
                <select class="form-select" id="etat" name="etat" required>
                    <option value="neuf">Neuf</option>
                    <option value="casi-neuf">Casi neuf</option>
                    <!-- Ajoutez d'autres options d'état au besoin -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter le jeu</button>
        </form>
    </div>