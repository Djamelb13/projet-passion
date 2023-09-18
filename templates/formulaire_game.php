
    <div class="modal-body">
        <div class="container-fluid wh">
            <form enctype="multipart/form-data" method="post" action="../inc/traitement_jeu.php">
                <div class="row">
                    <!-- Première colonne (XL) -->
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre du jeu</label>
                            <input type="text" class="form-control" id="titre" name="titre" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description du jeu</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags existants</label>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="tagsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sélectionnez des tags
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="tagsDropdown">
                                
                                    <?php
                                    try {
                                        // Connexion à la base de données (à personnaliser avec vos paramètres)
                                        include($_SERVER['DOCUMENT_ROOT'] .'/inc/connexion.php'); 
                                    
                                        // Requête pour récupérer les tags depuis la base de données
                                        $query = $connexion->query('SELECT tag_id, tag_name FROM tags');
                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            $tagName = htmlspecialchars($row['tag_name']);
                                            echo '<li><label class="dropdown-item">';
                                            echo '<input type="checkbox" name="tags[]" value="' . $tagName . '"> ' . $tagName;
                                            echo '</label></li>';
                                        }
                                        $connexion = null;
                                    } catch (PDOException $e) {
                                        // Gestion des erreurs de base de données
                                        echo 'Erreur de base de données : ' . $e->getMessage();
                                    }
                                    $connexion = null;
                                    ?>
                                    
                                </ul>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image (JPG ou PNG, max 20 Mo)</label>
                            <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png" required>
                        </div>
                    </div>

                    <!-- Deuxième colonne (XL) -->
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label for="support" class="form-label">Support du jeu</label>
                            <select class="form-select" id="support" name="support" onchange="toggleClesCdField()">
                                <option value="physique">Physique</option>
                                <option value="virtuel">Virtuel</option>
                            </select>
                        </div>

                        <div class="mb-3" id="cles_cd_virtuel" style="display: none;">
                            <label for="cles_cd" class="form-label">Clés CD Virtuel</label>
                            <div id="cles_cd_fields">
                                <input type="text" class="form-control" name="cles_cd[]" >
                            </div>
                            <button type="button" id="add_cles_cd_btn" class="btn btn-primary">Ajouter</button>
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
                                <!-- Add more condition options if needed -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="manual_tags" class="form-label">Tags Manuels</label>
                            <input type="text" class="form-control" id="manual_tags" name="manual_tags">
                        </div>
                    </div>
                </div>

                <!-- Ajoutez ici les autres champs communs aux deux colonnes -->

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Ajouter le jeu</button>
            </form>
        </div>
    </div>


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
<!-- <script src="../js/form.js"> -->

</script>