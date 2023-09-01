
    document.addEventListener("DOMContentLoaded", function () {
        const tagInput = document.getElementById("tag-input");
        const tagSuggestions = document.getElementById("tag-suggestions");
        const selectedTags = document.getElementById("selected-tags");
        let selectedTagCount = 0;

        // Initialize the 'tags' variable with tags retrieved from the database
        const tags = <?php echo $tagsJson; ?> ;

        // Event listener for the tag input field
        tagInput.addEventListener("input", function () {
            const searchValue = tagInput.value.toLowerCase();
            const matchingTags = tags.filter(tag => tag.toLowerCase().includes(searchValue));

            // Display matching tag suggestions
            tagSuggestions.innerHTML = "";
            matchingTags.forEach(tag => {
                const suggestion = document.createElement("div");
                suggestion.textContent = tag;
                suggestion.classList.add("tag-suggestion");
                suggestion.addEventListener("click", function () {
                    if (selectedTagCount < 5) {
                        const selectedTag = tag;
                        const tagLabel = createTagLabel(selectedTag);
                        selectedTags.appendChild(tagLabel);
                        selectedTagCount++;

                        // Add the selected tag to the 'tags' input field
                        const tagsInputField = document.getElementById("tag-input");
                        tagsInputField.value += (tagsInputField.value ? ',' : '') + selectedTag;
                    }
                });
                tagSuggestions.appendChild(suggestion);
            });
        });

        // Create a tag label with a remove button
        function createTagLabel(tagName) {
            const tagLabel = document.createElement("span");
            tagLabel.textContent = tagName;
            tagLabel.classList.add("badge", "bg-primary", "me-2");

            // Add a remove button
            const removeButton = document.createElement("button");
            removeButton.textContent = "X";
            removeButton.classList.add("btn", "btn-danger", "btn-sm", "ms-1");
            removeButton.addEventListener("click", function () {
                tagLabel.remove(); // Remove the tag label
                selectedTagCount--;
            });

            tagLabel.appendChild(removeButton);
            return tagLabel;
        }
    });

