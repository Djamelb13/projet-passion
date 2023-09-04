document.addEventListener("DOMContentLoaded", function() {
    const limitMessage = document.getElementById("limit_message");
    const manualTagsInput = document.getElementById("manual_tags");
    const addTagBtn = document.getElementById("add_tag_btn");
    const selectedTagsList = document.getElementById("selected_tags");
    const tagOptions = document.querySelectorAll(".tag-option");

    // Tableau pour stocker les tags sélectionnés
    const selectedTags = [];

    // Fonction pour ajouter un tag
    function addTag(tag) {
        if (selectedTags.length < 5) { // Vérification du nombre maximum de tags
            selectedTags.push(tag);
            const tagItem = document.createElement("li");
            tagItem.innerHTML = `${tag} <button type="button" class="btn btn-danger btn-sm" onclick="removeTag('${tag}')">Supprimer</button>`;
            selectedTagsList.appendChild(tagItem);
            manualTagsInput.value = "";
            // Effacer le message de limite si le nombre de tags est inférieur à 5
            if (selectedTags.length < 5) {
                limitMessage.textContent = "";
            }
        } else {
            // Afficher le message de limite sous la liste des tags
            limitMessage.textContent = "Vous avez atteint la limite de 5 tags.";
        }
    }
    // Fonction pour supprimer un tag
    function removeTag(tag) {
        const index = selectedTags.indexOf(tag);
        if (index !== -1) {
            selectedTags.splice(index, 1);
            selectedTagsList.removeChild(selectedTagsList.childNodes[index]);
        }
    }

    // Écouteur d'événement pour le bouton "Ajouter"
    addTagBtn.addEventListener("click", function() {
        const manualTag = manualTagsInput.value.trim();
        if (manualTag !== "" && !selectedTags.includes(manualTag)) {
            addTag(manualTag);
        }
    });

    // Écouteurs d'événement pour les options de tags existants
    tagOptions.forEach(function(option) {
        option.addEventListener("click", function() {
            const tag = option.value;
            if (!selectedTags.includes(tag)) {
                addTag(tag);
            }
        });
    });

    // Fonction pour supprimer un tag lorsqu'on clique sur le bouton "Supprimer"
    window.removeTag = function(tag) {
        removeTag(tag);
    };
});

var clesCdCounter = 1; // Compteur pour les champs Clés CD

function toggleClesCdField() {
    var supportSelect = document.getElementById("support");
    var clesCdField = document.getElementById("cles_cd_virtuel");

    if (supportSelect.value === "virtuel") {
        clesCdField.style.display = "block"; // Affiche le champ
    } else {
        clesCdField.style.display = "none"; // Masque le champ
    }
}

document.getElementById("add_cles_cd_btn").addEventListener("click", function () {
    addClesCdField();
});
// Fonction pour ajouter un champ Clés CD supplémentaire
function addClesCdField() {
    var clesCdFields = document.getElementById("cles_cd_fields");
    var newField = document.createElement("input");
    newField.type = "text";
    newField.className = "form-control";
    newField.name = "cles_cd[]";
    newField.required = true;
    clesCdCounter++;
    newField.placeholder = "Clé CD " + clesCdCounter;
    clesCdFields.appendChild(newField);
}