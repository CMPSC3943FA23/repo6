// SAVE EDIT IN localStorage
        document.querySelector("#editForm").addEventListener("submit", function(e) {e.preventDefault();
    
            const id = document.querySelector("#editItemId").value;
            const newName = document.querySelector("#editItemName").value;
            const newDescription = document.querySelector("#editItemDescription").value;

            // Update localStorage
            const items = JSON.parse(localStorage.getItem("hobbyItems"));
            const item = items.find(item => item.id === id);
            item.name = newName;
            item.description = newDescription;
            localStorage.setItem("hobbyItems", JSON.stringify(items));

            // Update displayed item
            const card = document.querySelector(`[data-id="${id}"]`);
            card.querySelector(".card-title").textContent = newName;
            card.querySelector(".card-text").textContent = newDescription;

            $('#editModal').modal('hide');
        });
