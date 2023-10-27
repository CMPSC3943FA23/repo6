// EDIT BUTTON
        document.querySelector("#itemsContainer").addEventListener("click", function(e) {
            if (e.target.classList.contains('editItemBtn')) {
                const card = e.target.closest('.card');
                const itemId = card.getAttribute('data-id');
                const name = card.querySelector(".card-title").textContent;
                const description = card.querySelector(".card-text").textContent;

                document.querySelector("#editItemId").value = itemId;
                document.querySelector("#editItemName").value = name;
                document.querySelector("#editItemDescription").value = description;

                $('#editModal').modal('show');
            }
        });
