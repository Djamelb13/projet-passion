<?php include_once('../inc/head.php'); ?>

<body>
    <div class="container wh">
        <h1>Ajouter un jeu</h1>
        <form enctype="multipart/form-data" method="post" action="../inc/traitement_jeu.php">
            <!-- Title Field -->
            <div class="mb-3">
                <label for="titre" class="form-label">Titre du jeu</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>

            <!-- Description Field -->
            <div class="mb-3">
                <label for="description" class="form-label">Description du jeu</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>

            <!-- Image Upload Field -->
            <div class="mb-3">
                <label for="image" class="form-label">Image (JPG ou PNG, max 20 Mo)</label>
                <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png" required>
            </div>

            <!-- Support Type Field -->
<div class="mb-3">
    <label for="support" class="form-label">Support du jeu</label>
    <select class="form-select" id="support" name="support" required onchange="toggleClesCdField()">
        <option value="physique">Physique</option>
        <option value="virtuel">Virtuel</option>
    </select>
</div>
           <!-- Champ Clés CD Virtuel -->
<div class="mb-3" id="cles_cd_virtuel" style="display: none;">
    <label for="cles_cd" class="form-label">Clés CD Virtuel</label>
    <div id="cles_cd_fields">
        <input type="text" class="form-control" name="cles_cd[]" required>
    </div>
    <button type="button" id="add_cles_cd_btn" class="btn btn-primary">Ajouter</button>
</div>

            <!-- Platform Field -->
            <div class="mb-3">
                <label for="plateforme" class="form-label">Console/Plateforme</label>
                <input type="text" class="form-control" id="plateforme" name="plateforme" required>
            </div>

            <!-- Condition Field -->
            <div class="mb-3">
                <label for="etat" class="form-label">État</label>
                <select class="form-select" id="etat" name="etat" required>
                    <option value="neuf">Neuf</option>
                    <option value="casi-neuf">Casi neuf</option>
                    <!-- Add more condition options if needed -->
                </select>
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tags existants</label>
                <select class="form-select" id="tags" name="tags[]" multiple>
                    <?php
                    // Connexion à la base de données (à personnaliser avec vos paramètres)
                    include('../inc/connexion.php');

                    // Requête pour récupérer les tags depuis la base de données
                    $query = $connexion->query('SELECT tag_id, tag_name FROM tags');
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $tagName = htmlspecialchars($row['tag_name']);
                        echo '<option class="tag-option" value="' . $tagName . '">' . $tagName . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="manual_tags" class="form-label">Tags Manuels</label>
                <input type="text" class="form-control" id="manual_tags">
                <button type="button" id="add_tag_btn" class="btn btn-primary">Ajouter</button>
            </div>

            <!-- Selected Tags List -->
            <div class="mb-3">
                <label for="selected_tags" class="form-label">Tags Sélectionnés</label>
                <ul id="selected_tags"></ul>
            </div>
            <div id="limit_message" class="text-danger"></div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Ajouter le jeu</button>
        </form>
    </div>

    <script src="../js/form.js">

    </script>