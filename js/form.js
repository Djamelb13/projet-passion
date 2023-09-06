document.addEventListener("DOMContentLoaded", function () {
  toggleClesCdField();
  const limitMessage = document.getElementById("limit_message");
  const manualTagsInput = document.getElementById("manual_tags");
  const addTagBtn = document.getElementById("add_tag_btn");
  const selectedTagsList = document.getElementById("selected_tags");
  const selectedTagsInput = document.getElementById("selected_tags_input");
  const tagOptions = document.querySelectorAll(".tag-option");

  // Tableau pour stocker les tags sélectionnés
  const selectedTags = JSON.parse(selectedTagsInput.value || "[]");

  // Fonction pour mettre à jour la liste des tags sélectionnés
  function updateSelectedTagsList() {
    selectedTagsList.innerHTML = "";
    selectedTags.forEach((tag) => {
      const tagItem = document.createElement("li");
      tagItem.innerHTML = `${tag} <button type="button" class="btn btn-danger btn-sm" onclick="removeTag('${tag}')">Supprimer</button>`;
      selectedTagsList.appendChild(tagItem);
    });
  }

  // Fonction pour ajouter un tag
  function addTag(tag) {
    if (selectedTags.length < 5) {
      selectedTags.push(tag);
      updateSelectedTagsList();
      updateSelectedTagsInput();
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
      updateSelectedTagsList();
      updateSelectedTagsInput();
    }
  }

  // Écouteur d'événement pour le bouton "Ajouter"
  addTagBtn.addEventListener("click", function () {
    const manualTag = manualTagsInput.value.trim();
    if (manualTag !== "" && !selectedTags.includes(manualTag)) {
      addTag(manualTag);
    }
  });

  // Écouteurs d'événement pour les options de tags existants
  tagOptions.forEach(function (option) {
    option.addEventListener("click", function () {
      const tag = option.value;
      if (!selectedTags.includes(tag)) {
        addTag(tag);
      }
    });
  });

  // Supprimer un tag lorsque l'utilisateur clique sur le bouton "Supprimer"
  window.removeTag = function (tag) {
    removeTag(tag);
  };

  // Mettre à jour la valeur initiale du champ caché au chargement de la page
  updateSelectedTagsList();
  updateSelectedTagsInput();
});

// Fonction pour mettre à jour la valeur du champ caché avec les tags sélectionnés
function updateSelectedTagsInput() {
  const selectedTagsList = document.getElementById("selected_tags");
  const selectedTagsInput = document.getElementById("selected_tags_input");
  const selectedTags = Array.from(selectedTagsList.children).map((tag) => tag.textContent.split(" ")[0]);
  selectedTagsInput.value = JSON.stringify(selectedTags);
}

// Sélectionnez le bouton "Ajouter" des clés CD virtuelles
const addClesCdBtn = document.getElementById("add_cles_cd_btn");

// Écouteur d'événement pour le bouton "Ajouter" des clés CD virtuelles
addClesCdBtn.addEventListener("click", function () {
  const clesCdFields = document.getElementById("cles_cd_fields");
  const newClesCdField = document.createElement("input");
  newClesCdField.type = "text";
  newClesCdField.className = "form-control";
  newClesCdField.name = "cles_cd[]";
  newClesCdField.required = true;
  clesCdFields.appendChild(newClesCdField);
});

// À l'intérieur de votre script JavaScript, modifiez la fonction toggleClesCdField() comme suit :
function toggleClesCdField() {
  var supportField = document.getElementById("support");
  var clesCdVirtuelField = document.getElementById("cles_cd_virtuel");

  if (supportField.value === "virtuel") {
    clesCdVirtuelField.style.display = "block";
  } else {
    clesCdVirtuelField.style.display = "none";
  }
}
