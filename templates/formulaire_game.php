<?php include_once('../inc/head.php'); ?>

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
            <select class="form-select" id="support" name="support" required>
                <option value="physique">Physique</option>
                <option value="virtuel">Virtuel</option>
            </select>
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
                <?php echo'courcou';
                // Connexion à la base de données (à personnaliser avec vos paramètres)
                include('../inc/connexion.php');

                // Requête pour récupérer les tags depuis la base de données
                $query = $connexion->query('SELECT tag_id, tag_name FROM tags');
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $tagName = htmlspecialchars($row['tag_name']);
                    echo '<option value="' . $tagName . '">' . $tagName . '</option>';
                }
                ?>
            </select>
        </div>
        <div id="tags-selectionnes"></div>
        

        JavaScript pour gérer la sélection de tags 
        <script>
    const selectTags = document.getElementById('tags');
const tagsSelectionnes = document.getElementById('tags-selectionnes');
const maxTags = 5;

selectTags.addEventListener('change', updateTagsSelection);

function updateTagsSelection() {
    const selectedTags = Array.from(selectTags.selectedOptions).map(option => option.value);

    if (selectedTags.length > maxTags) {
        alert('Vous ne pouvez pas sélectionner plus de ' + maxTags + ' tags.');
        // Désélectionnez les tags excédentaires
        selectedTags.splice(maxTags);
        updateSelectOptions(selectedTags);
    }

    // Affichez les tags sélectionnés
    renderSelectedTags(selectedTags);
}

function renderSelectedTags(selectedTags) {
    tagsSelectionnes.innerHTML = ''; // Effacez le contenu précédent

    selectedTags.forEach(tag => {
        const tagElement = document.createElement('span');
        tagElement.textContent = tag;

        const removeButton = document.createElement('button');
        removeButton.textContent = 'Supprimer';
        removeButton.addEventListener('click', () => removeTag(tag));

        const tagContainer = document.createElement('div');
        tagContainer.appendChild(tagElement);
        tagContainer.appendChild(removeButton);

        tagsSelectionnes.appendChild(tagContainer);
    });
}

function removeTag(tag) {
    const selectedOptions = Array.from(selectTags.selectedOptions);
    const indexToRemove = selectedOptions.findIndex(option => option.value === tag);

    if (indexToRemove !== -1) {
        selectedOptions.splice(indexToRemove, 1);
        const selectedTags = selectedOptions.map(option => option.value);
        updateSelectOptions(selectedTags);
        renderSelectedTags(selectedTags);
    }
}

function updateSelectOptions(selectedTags) {
    const allOptions = selectTags.options;
    for (let i = 0; i < allOptions.length; i++) {
        const option = allOptions[i];
        option.disabled = selectedTags.includes(option.value) && selectedTags.length >= maxTags;
    }
}

</script>



        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Ajouter le jeu</button>
    </form>
</div>
